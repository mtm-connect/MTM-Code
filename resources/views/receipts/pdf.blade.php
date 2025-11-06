<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receipt {{ $receipt->receipt_number }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #111;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #064e3b; /* emerald-950 accent */
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .logo img {
            height: 60px;
        }
        .company-info {
            text-align: right;
            font-size: 12px;
            line-height: 1.4;
        }
        h2 {
            margin: 0;
            font-size: 18px;
            color: #064e3b;
        }
        .muted { color: #666; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th { background-color: #f8f8f8; }
        .right { text-align: right; }
        .footer {
            margin-top: 40px;
            font-size: 10px;
            text-align: center;
            color: #777;
        }
        .order-info {
            margin-top: 8px;
            margin-bottom: 18px;
            font-size: 13px;
        }
    </style>
</head>
<body>

<!-- Header with logo + company info -->
<div class="header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <div class="logo" style="flex-shrink: 0;">
        {{-- ✅ Update this path to your actual logo file --}}
        <img src="{{ public_path('images/logo.jpg') }}" alt="MTM Connect Logo" style="width: 160px; height: auto;">
    </div>
    <div class="company-info" style="text-align: right; font-size: 14px; line-height: 1.4;">
        <strong>MTM Connect</strong><br>
        <a href="{{ config('app.url') }}">{{ config('app.url') }}</a><br>
        admin@mtm-connect.com<br>
        +44 7518 316 585
    </div>
</div>


    <!-- Receipt Info -->
    <h2>Payment Receipt</h2>
    <div class="order-info">
        <strong>Order Number:</strong> {{ $order->order_number ?? $order->id }}<br>
        <strong>Receipt Number:</strong> {{ $receipt->receipt_number }}<br>
        <strong>Date:</strong> {{ $receipt->created_at->format('d M Y') }}
    </div>

    <h3>Billed To</h3>
    <p>
        {{ $user->company }}<br>
        {{ $user->name }}<br>
        {{ $user->email }}<br>
        {{ $user->address_line_1 }}, {{$user->address_line_2}}<br>
        {{ $user->post_code }}<br>
        {{ $user->county }}<br>
       
    </p>

    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th class="right">Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Order #{{ $order->order_number ?? $order->id }} — {{ ucfirst($order->status) }}</td>
                <td class="right">{{ $receipt->currency }} {{ number_format($receipt->amount / 100, 2) }}</td>
            </tr>
            @if($receipt->tax_amount > 0)
            <tr>
                <td>Tax</td>
                <td class="right">{{ $receipt->currency }} {{ number_format($receipt->tax_amount / 100, 2) }}</td>
            </tr>
            @endif
            <tr>
                <td><strong>Total Paid</strong></td>
                <td class="right"><strong>{{ $receipt->currency }} {{ number_format(($receipt->amount + $receipt->tax_amount)/100, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Paid via Stripe • This receipt serves as proof of payment<br>
        Thank you for choosing <strong>MTM Connect</strong>
    </div>

</body>
</html>
