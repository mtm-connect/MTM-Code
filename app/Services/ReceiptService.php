<?php

namespace App\Services;

use App\Models\Receipt;
use App\Models\Orders;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ReceiptService
{
    public function generate(Orders $order, array $money): Receipt
    {
        Log::info('ReceiptService: generate() called', [
            'order_id' => $order->id,
            'money' => $money,
        ]);

        // Idempotent: return existing receipt if it exists
        $existing = Receipt::where('order_id', $order->id)->first();
        if ($existing) {
            Log::info('ReceiptService: existing receipt found', ['receipt_id' => $existing->id]);
            return $existing;
        }

        // 1) Create the DB row FIRST (so we can see it even if PDF fails)
        $receipt = Receipt::create([
            'order_id'       => $order->id,
            'receipt_number' => $this->nextNumber($order),
            'currency'       => $money['currency'] ?? 'GBP',
            'amount'         => (int) ($money['amount'] ?? 0),
            'tax_amount'     => (int) ($money['tax_amount'] ?? 0),
            'pdf_path'       => null,
        ]);

        Log::info('ReceiptService: receipt row created', [
            'receipt_id' => $receipt->id,
            'receipt_number' => $receipt->receipt_number,
        ]);

        // 2) Try to render + save the PDF, but DO NOT fail the whole op if it breaks
        try {
         // NEW: use your existing email Blade
$pdf = Pdf::loadView('receipts.pdf', [
    'order'   => $order,
    'receipt' => $receipt,
    'user'    => $order->user,
])->setPaper('a4');


            $path = "receipts/{$receipt->receipt_number}.pdf";
            Storage::disk('public')->put($path, $pdf->output());
            $receipt->update(['pdf_path' => $path]);

            Log::info('ReceiptService: PDF saved', ['path' => $path]);
        } catch (\Throwable $e) {
            Log::error('ReceiptService: PDF generation failed', [
                'receipt_id' => $receipt->id,
                'error' => $e->getMessage(),
            ]);
            // We still return the receipt row even if PDF failed.
        }

        return $receipt;
    }

    protected function nextNumber(Orders $order): string
    {
        $prefix = 'REC-'.now()->format('Y').'-'.($order->order_number ?? $order->id);
        do {
            $number = $prefix.'-'.strtoupper(Str::random(4));
        } while (Receipt::where('receipt_number', $number)->exists());
        return $number;
    }
}

