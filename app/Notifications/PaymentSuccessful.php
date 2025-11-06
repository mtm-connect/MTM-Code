<?php

namespace App\Notifications;

use App\Models\Orders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentSuccessful extends Notification implements ShouldQueue
{
    use Queueable;

    protected Orders $order;
    protected ?int $receiptId;
    protected ?string $receiptNumber; // e.g. "receipt_12345" (without .pdf)

    /**
     * @param Orders $order
     * @param int|null $receiptId      // database id of receipt (optional)
     * @param string|null $receiptNumber // filename stem if you have one (e.g. "receipt_12345")
     */
    public function __construct(Orders $order, ?int $receiptId = null, ?string $receiptNumber = null)
    {
        $this->order = $order;
        $this->receiptId = $receiptId;
        $this->receiptNumber = $receiptNumber;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id'     => $this->order->id,
            'order_number' => $this->order->order_number ?? null,
            'receipt_id'   => $this->receiptId,
            'receipt_file' => $this->getReceiptFileNameOrNull(), // e.g. "receipt_12345.pdf"
            'status'       => 'paid',
            'message'      => 'Your payment for order ' . ($this->order->order_number ?? "#{$this->order->id}") . ' was successful.',
        ];
    }

    public function toMail($notifiable)
    {
        $orderNumber = $this->order->order_number ?? "#{$this->order->id}";
    
        // Links
        $orderUrl   = route('orders.show', ['orders' => $this->order->id]);
        $receiptUrl = $this->getPublicReceiptUrl(); // e.g. https://mtmconnect.test/storage/receipts/receipt_12345.pdf
    
        $mail = (new MailMessage)
            ->subject('Payment Successful')
            ->greeting('Thank you for your payment!')
            ->line("Your order {$orderNumber} has been successfully paid.")
            ->line('We’ll begin processing your order right away.');
    
        // ✅ Add download link or button here
        if ($receiptUrl) {
            // Add a "Download Receipt PDF" button
            $mail->action('Download Receipt PDF', $receiptUrl)
                 ->line('You can also access your receipt from your order page anytime.')
    
                 // Optional: add a plain text link below the button for compatibility
                 ->line("If the button above doesn’t work, you can also download your receipt directly here:")
                 ->line($receiptUrl);
        } else {
            // Fallback: just link to the order page
            $mail->action('View Your Order', $orderUrl);
        }
    
        // Try to attach the PDF if it exists on disk
        if ($path = $this->getLocalReceiptPathIfExists()) {
            $mail->attach($path, [
                'as'   => "{$this->sanitizeFileName($orderNumber)}_receipt.pdf",
                'mime' => 'application/pdf',
            ]);
        }
    
        return $mail;
    }
    

    /**
     * Build the public URL to the receipt under /storage/receipts/{file}.pdf
     * Requires the storage symlink (php artisan storage:link) and that the file is on the "public" disk.
     */
    protected function getPublicReceiptUrl(): ?string
    {
        $file = $this->getReceiptFileNameOrNull();
        if (!$file) {
            return null;
        }

        // Use url() so it respects your APP_URL (mtmconnect.test)
        return url("storage/receipts/{$file}");
    }

    /**
     * Build the local filesystem path for attaching the PDF if it exists.
     * Looks in storage/app/public/receipts/{file}.pdf
     */
    protected function getLocalReceiptPathIfExists(): ?string
    {
        $file = $this->getReceiptFileNameOrNull();
        if (!$file) {
            return null;
        }

        $path = storage_path("app/public/receipts/{$file}");
        return is_file($path) ? $path : null;
    }

    /**
     * Decide the filename stem:
     * - Prefer an explicit $receiptNumber if provided (e.g., "receipt_12345")
     * - Else fall back to "receipt_{receiptId}"
     * Returns the filename WITH .pdf or null if we have neither.
     */
    protected function getReceiptFileNameOrNull(): ?string
    {
        if ($this->receiptNumber) {
            return "{$this->receiptNumber}.pdf";
        }
        if ($this->receiptId) {
            return "receipt_{$this->receiptId}.pdf";
        }
        return null;
    }

    protected function sanitizeFileName(string $name): string
    {
        return preg_replace('/[^A-Za-z0-9_\-]+/', '_', $name) ?? 'receipt';
    }
}

