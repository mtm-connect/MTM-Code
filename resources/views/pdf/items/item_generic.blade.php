<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Order #{{ $order->order_number ?? '—' }} – {{ strtoupper($type ?? 'ITEM') }}</title>
  <style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color:#111; }
    h1 { margin:0 0 8px; font-size:18px; }
    table { width:100%; border-collapse: collapse; margin-top:10px; }
    th, td { border:1px solid #ddd; padding:6px 8px; vertical-align: top; }
    th { background:#f3f4f6; text-align:left; }
    .muted { color:#555; }
    .chip { display:inline-block; border:1px solid #ccc; padding:2px 6px; border-radius:12px; font-size:11px; }
  </style>
</head>
<body>
  <h1>Item Summary (Generic)</h1>
  <p class="muted">
    Order: <strong>#{{ $order->order_number ?? '—' }}</strong> &nbsp;|&nbsp;
    Type: <span class="chip">{{ $type ?? '—' }}</span> &nbsp;|&nbsp;
    Item #: <strong>{{ $item->item_number ?? '—' }}</strong>
  </p>

  <table>
    <thead><tr><th>Field</th><th>Value</th></tr></thead>
    <tbody>
      <tr><td>Overview ID</td><td>{{ $overview->id ?? '—' }}</td></tr>
      <tr><td>Measurement</td><td>{{ $measurement->name ?? '—' }}</td></tr>
      @foreach((array)$item as $k => $v)
        @if(is_scalar($v) || is_null($v))
          <tr><td>{{ $k }}</td><td>{{ (string)$v }}</td></tr>
        @endif
      @endforeach
    </tbody>
  </table>
</body>
</html>
