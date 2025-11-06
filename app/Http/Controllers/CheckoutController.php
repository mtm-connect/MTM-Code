<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\OrderOverview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Services\ReceiptService;

class CheckoutController extends Controller
{
    public function checkout(Orders $orders)
    {
        $orderId = $orders->id;

        if ($orders->status !== 'draft') {
            return redirect()->route('orders.show', $orders)
                ->with('info', 'This order is already paid.');
        }

        $orderOverviews = OrderOverview::with([
            'jacket:id,item_number',
            'shirt:id,item_number',
            'twoPiece:id,item_number',
            'threePiece:id,item_number',
            'trouser:id,item_number',
            'waistcoat:id,item_number',
        ])->where('order_id', $orderId)->get();

        Stripe::setApiKey(config('services.stripe.secret'));

        $lineItems = [];
        foreach ($orderOverviews as $ov) {
            $labelRef = $ov->item_number ?? "#{$orderId}";
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'gbp',
                    'product_data' => [
                        'name' => "{$ov->type} ({$labelRef})",
                    ],
                    'unit_amount' => (int) ($ov->price * 100),
                ],
                'quantity' => 1,
            ];
        }

        $checkoutSession = Session::create([
            'payment_method_types' => ['card'],
            'line_items'           => $lineItems,
            'mode'                 => 'payment',
            'success_url'          => route('checkout.success', ['orders' => $orders->id]) . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'           => route('checkout.cancel',  ['orders' => $orders->id]),
        ]);

        return redirect($checkoutSession->url);
    }

    public function success(Request $request, Orders $orders)
    {
        $orderId = $orders->id;

        // Idempotent mark paid
        if ($orders->status !== 'paid') {
            $orders->update(['status' => 'paid']);
            OrderOverview::where('order_id', $orderId)->update(['status' => 'paid']);
        }

        // Build money from Stripe (with fallbacks)
        $money = ['amount' => 0, 'tax_amount' => 0, 'currency' => 'GBP'];

        try {
            $sessionId = $request->query('session_id');
            if ($sessionId) {
                Stripe::setApiKey(config('services.stripe.secret'));
                $session = \Stripe\Checkout\Session::retrieve([
                    'id'     => $sessionId,
                    'expand' => ['payment_intent', 'total_details'],
                ]);

                if (!empty($session->amount_total) && !empty($session->currency)) {
                    $money['amount']   = (int) $session->amount_total;
                    $money['currency'] = strtoupper($session->currency);
                }

                if (!empty($session->total_details) && isset($session->total_details->amount_tax)) {
                    $money['tax_amount'] = (int) $session->total_details->amount_tax;
                }

                if ($money['amount'] <= 0 && !empty($session->payment_intent)) {
                    $pi = is_object($session->payment_intent)
                        ? $session->payment_intent
                        : \Stripe\PaymentIntent::retrieve($session->payment_intent);
                    if (!empty($pi->amount_received)) {
                        $money['amount']   = (int) $pi->amount_received;
                        $money['currency'] = strtoupper($pi->currency ?? $money['currency']);
                    }
                }
            }
        } catch (\Throwable $e) {
            Log::warning('Stripe fetch failed', ['order_id' => $orderId, 'error' => $e->getMessage()]);
        }

        if ($money['amount'] <= 0) {
            $sum = OrderOverview::where('order_id', $orderId)->sum('price'); // major units
            $money['amount']   = (int) round($sum * 100);
            $money['currency'] = $orders->currency ?? 'GBP';
        }

        // ✅ Generate receipt using your email Blade as the PDF view
        $receipt = null;
        try {
            $receipt = app(ReceiptService::class)->generate(
                $orders,
                $money,
                'emails.receipts.basic'   // your Blade view for the PDF
            );

            Log::info('Receipt generated', [
                'order_id'     => $orderId,
                'receipt_id'   => $receipt?->id,
                'file_name'    => $receipt?->file_name ?? null,     // e.g. "REC-2025-ABC123.pdf"
                'amount_minor' => $money['amount'],
                'currency'     => $money['currency'],
            ]);
        } catch (\Throwable $e) {
            Log::error('Receipt generation failed', [
                'order_id' => $orderId,
                'error'    => $e->getMessage(),
            ]);
        }

        // 🔗 Notify with receipt info so the email shows "Download Receipt PDF"
        try {
            // Prefer a friendly filename stem if your service returns one
            $receiptNumber = null;
            if (!empty($receipt?->file_name)) {
                // Strip ".pdf" to get the stem the notifier expects
                $receiptNumber = pathinfo($receipt->file_name, PATHINFO_FILENAME);
            } elseif (!empty($receipt?->receipt_number)) {
                $receiptNumber = $receipt->receipt_number; // already a stem like "REC-2025-ABC123"
            }

            $orders->user->notify(
                new \App\Notifications\PaymentSuccessful(
                    $orders,
                    $receipt?->id,       // used for fallback naming
                    $receiptNumber       // ensures URL like /storage/receipts/{stem}.pdf
                )
            );
        } catch (\Throwable $e) {
            Log::warning('Notification failed', [
                'order_id' => $orderId,
                'error'    => $e->getMessage(),
            ]);
        }

        return redirect()
            ->route('orders.show', ['orders' => $orderId])
            ->with('success', 'Payment has been successful.');
    }

    public function cancel(Orders $orders)
    {
        return redirect()
            ->route('orders.show', ['orders' => $orders->id])
            ->with('unsuccessful', 'Payment was unsuccessful. Please try again.');
    }
}


