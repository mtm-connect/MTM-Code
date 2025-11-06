<?php

namespace App\Mail;

use App\Models\Receipt;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ReceiptMailable extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Receipt $receipt) {}

    public function build()
    {
        $order = $this->receipt->order;
        $pdf   = Storage::disk('public')->path($this->receipt->pdf_path);

        return $this->subject('Your receipt '.$this->receipt->receipt_number)
            ->view('emails.receipts.basic', [
                'order'   => $order,
                'receipt' => $this->receipt,
            ])
            ->attach($pdf, [
                'as'   => $this->receipt->receipt_number.'.pdf',
                'mime' => 'application/pdf',
            ]);
    }
}
