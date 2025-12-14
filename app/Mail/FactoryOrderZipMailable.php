<?php

namespace App\Mail;

use App\Models\Orders;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;

class FactoryOrderZipMailable extends Mailable
{
    use Queueable, SerializesModels;

    public ?string $factoryPreviewUrl = null;

    /**
     * @param  Orders      $order
     * @param  string|null $zipAbsolutePath  (ignored now)
     */
    public function __construct(
        public Orders $order,
        public ?string $zipAbsolutePath = null
    ) {
        //
    }

    public function build()
    {
        Log::info('FactoryOrderZipMailable@build called (NO ATTACHMENT)', [
            'order_id' => $this->order->id,
        ]);

        // Try generating signed URL
        try {
            $this->factoryPreviewUrl = URL::signedRoute('factory.orders.show', [
                'order' => $this->order->id,
            ]);
        } catch (\Throwable $e) {
            Log::error('Failed to generate factory preview URL', [
                'order_id' => $this->order->id,
                'message'  => $e->getMessage(),
            ]);

            $this->factoryPreviewUrl = null;
        }

        return $this
            ->from('admin@mtm-connect.co.uk', 'MTM Connect')
            ->subject('Factory Order ' . $this->order->order_number)
            ->markdown('emails.factory_order')
            ->with([
                'order'             => $this->order,
                'factoryPreviewUrl' => $this->factoryPreviewUrl,
            ]);
    }
}
