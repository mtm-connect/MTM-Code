@component('mail::message')
# Factory Order {{ $order->order_number }}

You have a new factory order.

- Customer: {{ $order->name }}
- Email: {{ $order->email }}
- Phone: {{ $order->phone_number }}

@isset($factoryPreviewUrl)
@component('mail::button', ['url' => $factoryPreviewUrl])
View Order Online
@endcomponent
@endisset

@if($zipAbsolutePath ?? null)
A ZIP file with all PDFs is attached to this email.
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent
