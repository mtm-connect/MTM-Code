<?php

namespace App\Jobs;

use App\Models\Orders;
use App\Mail\FactoryOrderZipMailable;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use ZipArchive;
use PDF; // from barryvdh/laravel-dompdf

class GenerateAndEmailOrderZip implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $orderId;

    public function __construct(int $orderId)
    {
        $this->orderId = $orderId;
    }

    public function handle(): void
    {
        /** @var Orders $order */
        $order = Orders::with([
            'orderOverviews.measurement', // if relationship exists
        ])->findOrFail($this->orderId);

        // Working directories
        $baseDir = "orders/{$order->id}";
        $pdfDir  = "$baseDir/pdfs";
        Storage::makeDirectory($pdfDir);

        // Generate one PDF per item
        foreach ($order->orderOverviews as $idx => $item) {
            $pdf = PDF::loadView('pdf.item', [
                'order' => $order,
                'item'  => $item,
            ])->setPaper('a4');

            $filename = sprintf('%s/item_%02d_%s.pdf', $pdfDir, $idx + 1, $item->item_number ?: $item->id);
            Storage::put($filename, $pdf->output());
        }

        // Zip them
        $zipPath   = "$baseDir/order_{$order->order_number}.zip";
        $absolute  = Storage::path($zipPath);
        $zip = new ZipArchive;
        if ($zip->open($absolute, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $files = Storage::files($pdfDir);
            foreach ($files as $file) {
                $zip->addFile(Storage::path($file), basename($file));
            }
            $zip->close();
        } else {
            throw new \RuntimeException('Could not create ZIP file');
        }

        // Email factory with ZIP
        $factoryEmail = config('factory.email', env('FACTORY_EMAIL'));
        if (!$factoryEmail) {
            // avoid sending to nowhere
            throw new \RuntimeException('Factory email is not configured.');
        }

        Mail::to($factoryEmail)->send(new FactoryOrderZipMailable($order, $zipPath));

        // (Optional) Cleanup PDFs, keep ZIP
        Storage::deleteDirectory($pdfDir);
    }
}
