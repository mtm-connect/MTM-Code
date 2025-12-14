<?php

namespace App\Jobs;

use App\Models\Orders;
use App\Models\OrderOverview;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\FactoryOrderZipMailable;
use Barryvdh\DomPDF\Facade\Pdf;
use ZipArchive;

class GenerateAndEmailOrderZip implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $orderId;

    /** Give heavy PDF work enough time. */
    public $timeout   = 600;   // seconds
    public $tries     = 1;     // avoid multiple heavy retries
    public $uniqueFor = 900;   // keep unique a bit longer than timeout

    public function uniqueId(): string
    {
        return (string) $this->orderId;
    }

    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
        $this->onQueue('orders');
    }

    public function handle(): void
    {
        // Headroom for dompdf and zipping
        @ini_set('memory_limit', '1024M');
        @set_time_limit(600);

        Log::info('GenerateAndEmailOrderZip: RUN', ['order_id' => $this->orderId]);

        $order = Orders::findOrFail($this->orderId);

        // NOTE: your 'local' disk is configured to root at storage/app/private
        // so we do NOT prefix "private/" here.
        $disk    = Storage::disk('local');
        $baseDir = "orders/{$order->id}";
        $pdfDir  = "{$baseDir}/pdfs";
        $zipRel  = "{$baseDir}/order_{$order->order_number}.zip";

        // Fresh run each time -> simple "replace/resent" behavior
        $disk->delete($zipRel);
        $disk->deleteDirectory($pdfDir);
        $disk->makeDirectory($pdfDir);
        $disk->put("{$baseDir}/_started.txt", now()->toDateTimeString()." started\n");

        Log::info('Zip base paths', [
            'disk_root' => $disk->path(''),
            'base_abs'  => $disk->path($baseDir),
            'zip_abs'   => $disk->path($zipRel),
        ]);

        // Pull all items + measurement relation
        $overviews = OrderOverview::with(['measurement'])
            ->where('order_id', $order->id)
            ->get();

        $typeMap = [
            'jacket'      => ['fk' => 'jackets_id',      'class' => \App\Models\Jacket::class,     'view' => 'pdf.items.jacket'],
            'two_piece'   => ['fk' => 'two_pieces_id',   'class' => \App\Models\TwoPiece::class,   'view' => 'pdf.items.two_piece'],
            'three_piece' => ['fk' => 'three_pieces_id', 'class' => \App\Models\ThreePiece::class, 'view' => 'pdf.items.three_piece'],
            'waistcoat'   => ['fk' => 'waistcoat_id',    'class' => \App\Models\Waistcoat::class,  'view' => 'pdf.items.waistcoat'],
            'shirt'       => ['fk' => 'shirts_id',       'class' => \App\Models\Shirt::class,      'view' => 'pdf.items.shirt'],
        ];

        $madeAnyPdf = false;

        foreach ($overviews as $idx => $ov) {
            try {
                // Detect type + FK (explicit fallback to alt two_piece column)
                [$type, $fkCol] = $this->detectType($ov, $typeMap);

                $concrete = $this->fetchConcreteItem($ov, $type, $fkCol, $typeMap) ?: (object)[];

                $view = $this->firstExistingView([
                    $typeMap[$type]['view'] ?? null,
                    'pdf.items.item_generic',
                ]);

                // Provide the selected_* variable each PDF expects
                $extra = match ($type) {
                    'jacket'      => ['selectedjacket'      => $concrete],
                    'two_piece'   => ['selected_twopiece'   => $concrete],
                    'three_piece' => ['selected_threepiece' => $concrete],
                    'waistcoat'   => ['selected_waistcoat'  => $concrete],
                    'shirt'       => ['selected_shirt'      => $concrete],
                    default       => [],
                };

                Log::info('PDF render start', [
                    'order_id'    => $order->id,
                    'overview_id' => $ov->id,
                    'type'        => $type,
                    'fkCol'       => $fkCol,
                    'view'        => $view,
                    'has_item'    => $concrete && !empty((array)$concrete),
                    'item_number' => $concrete->item_number ?? null,
                ]);

                // Build the PDF
                $pdf = Pdf::setOptions([
                        'defaultFont'          => 'DejaVu Sans',
                        'dpi'                  => 96,
                        'isHtml5ParserEnabled' => true,
                        'isRemoteEnabled'      => true,
                    ])
                    ->loadView($view, array_merge([
                        'order'       => $order,
                        'item'        => $concrete,
                        'measurement' => $ov->measurement
                            ?? (\App\Models\Measurements::class ? \App\Models\Measurements::find($ov->measurement_id) : null),
                        'overview'    => $ov,
                        'type'        => $type,
                    ], $extra))
                    ->setPaper('a4');

                // Deterministic prefix + timestamp (dir is wiped each run)
                $label    = $concrete->item_number ?? $ov->id;
                $stamp    = now()->format('Ymd_His');
                $filename = sprintf('%s/%02d_%s_%s_%s.pdf', $pdfDir, $idx + 1, $type, $label, $stamp);

                $disk->put($filename, $pdf->output());
                $madeAnyPdf = true;

                // Free dompdf memory before next item
                unset($pdf);
                gc_collect_cycles();

            } catch (\Throwable $e) {
                Log::error('PDF render failed', [
                    'order_id'    => $order->id,
                    'overview_id' => $ov->id,
                    'message'     => $e->getMessage(),
                ]);
                $disk->put("{$baseDir}/_error_{$ov->id}.txt", $e->getMessage()."\n".$e->getTraceAsString());
            }
        }

        // Verify we produced files this run
        $files = $disk->files($pdfDir);
        Log::info('PDF generation summary', [
            'order_id' => $order->id,
            'count'    => count($files),
            'files'    => array_map('basename', $files),
        ]);

        if (!$madeAnyPdf || empty($files)) {
            throw new \RuntimeException("No PDFs were generated for order {$order->order_number}");
        }

        // Build ZIP (overwrite any previous)
        $zipAbs = $disk->path($zipRel);
        $disk->makeDirectory($baseDir);

        $zip = new ZipArchive;
        if ($zip->open($zipAbs, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new \RuntimeException('Could not create ZIP at: '.$zipAbs);
        }
        foreach ($files as $file) {
            $zip->addFile($disk->path($file), basename($file));
        }
        $zip->close();

        // Ensure ZIP exists before sending (we still keep it for the portal)
        if (!file_exists($zipAbs)) {
            Log::error('ZIP file missing, aborting email send', [
                'order_id' => $order->id,
                'zip_abs'  => $zipAbs,
            ]);
            throw new \RuntimeException("ZIP not found at $zipAbs");
        }

        Log::info('Sending factory email (NO ATTACHMENT)', [
            'order_id' => $order->id,
            'zip_abs'  => $zipAbs,
        ]);

        try {
            // Always send link-only; mailable ignores zip path now
            Mail::to('matthewwenlock787@gmail.com')
                ->cc('admin@mtm-connect.co.uk')
                ->send(new FactoryOrderZipMailable($order, null));

            Log::info('Factory email sent (NO ATTACHMENT)', [
                'order_id' => $order->id,
            ]);

        } catch (\Throwable $e) {
            Log::error('Factory email failed', [
                'order_id' => $order->id,
                'message'  => $e->getMessage(),
                'trace'    => $e->getTraceAsString(),
            ]);
            // If you want the job to be marked as failed on mail errors, uncomment:
            // throw $e;
        }

        // Clean PDFs but keep the ZIP
        $disk->deleteDirectory($pdfDir);
        $disk->put("{$baseDir}/_done.txt", now()->toDateTimeString()." complete\nZIP: {$zipRel}\nABS: {$zipAbs}\n");
    }

    /** Explicit + early two_piece recognition (supports legacy column). */
    private function detectType(OrderOverview $ov, array $typeMap): array
    {
        // direct FK matches first (jackets_id, waistcoat_id, etc.)
        foreach ($typeMap as $type => $meta) {
            $fk = $meta['fk'] ?? null;
            if ($fk && isset($ov->{$fk}) && !is_null($ov->{$fk})) {
                return [$type, $fk];
            }
        }

        // legacy/alt column for two_piece
        if (!is_null($ov->two_piece_id ?? null)) {
            return ['two_piece', 'two_piece_id'];
        }

        // last resort: string type
        $fallbackType = $ov->type ? strtolower(str_replace(' ', '_', $ov->type)) : 'item';
        return [$fallbackType, null];
    }

    /** Fetch the concrete model instance for the overview row. */
    private function fetchConcreteItem(OrderOverview $ov, string $type, ?string $fkCol, array $typeMap)
    {
        if (method_exists($ov, $rel = $this->relationNameFor($type)) && $ov->{$rel}) {
            return $ov->{$rel};
        }

        // primary FK lookup (e.g., jackets_id, waistcoat_id)
        if ($fkCol && isset($typeMap[$type]['class']) && ($id = $ov->{$fkCol})) {
            $cls = $typeMap[$type]['class'];
            return $cls::find($id);
        }

        // explicit alt FK for two_piece
        if ($type === 'two_piece' && isset($typeMap[$type]['class']) && ($id = ($ov->two_piece_id ?? null))) {
            $cls = $typeMap[$type]['class'];
            return $cls::find($id);
        }

        return null;
    }

    /** Map the logical type to the Eloquent relation on OrderOverview. */
    private function relationNameFor(string $type): string
    {
        return match ($type) {
            'jacket'      => 'jacket',
            'two_piece'   => 'twoPiece',
            'three_piece' => 'threePiece',
            'waistcoat'   => 'waistcoat',
            'shirt'       => 'shirt',
            default       => 'item_model',
        };
    }

    /** First existing Blade view from a list, fallback to a generic view. */
    private function firstExistingView(array $candidates): string
    {
        foreach ($candidates as $v) {
            if ($v && view()->exists($v)) return $v;
        }
        return 'pdf.items.item_generic';
    }
}
