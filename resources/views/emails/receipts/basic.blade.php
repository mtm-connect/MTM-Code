<p>Hi {{ $order->name }},</p>
<p>Thanks for your payment. Your receipt is attached for Order #{{ $order->order_number ?? $order->id }}.</p>
<p>Receipt Number: {{ $receipt->receipt_number }}</p>
<p>Amount: {{ $receipt->currency }} {{ number_format(($receipt->amount + $receipt->tax_amount)/100, 2) }}</p>
<p>— {{ config('app.name') }}</p>
