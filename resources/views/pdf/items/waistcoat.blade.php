{{-- resources/views/pdf/items/waistcoat.blade.php --}}
@php
use App\Support\PdfAsset;

/* ---------- Select the concrete item (supports both selectedjacket & selected_jacket) ---------- */
$selectedItem = null; $type = null;
if (!empty($selected_threepiece))      { $selectedItem = $selected_threepiece; $type = 'three_piece'; }
elseif (!empty($selected_twopiece))    { $selectedItem = $selected_twopiece;   $type = 'two_piece'; }
elseif (!empty($selected_jacket ?? $selectedjacket ?? null)) { $selectedItem = ($selected_jacket ?? $selectedjacket); $type = 'jacket'; }
elseif (!empty($selected_waistcoat))   { $selectedItem = $selected_waistcoat;  $type = 'waistcoat'; }
else                                   { $selectedItem = (object)[]; }

/* ---------- Image map (PNG -> JPG) ---------- */
$Waistcoat_Type_Images = [
  'Q001+DD4 Point Bottom'      => 'Q001-DD4-Point-Bottom.jpg',
  'Q003+DD5 Point Bottom'      => 'Q003-DD5-Point-Bottom.jpg',
  'Q004+DD4 Round Bottom'      => 'Q004-DD4-Round-Bottom.jpg',
  'Q008+DD4 Point Bottom'      => 'Q008-DD4-Point-Bottom.jpg',
  'Q009+DD4 Straight Bottom'   => 'Q009-DD4-Straight-Bottom.jpg',
  'Q012+DD4 Point Bottom'      => 'Q012-DD4-Point-Bottom.jpg',
  'Q013+DD4 Straight Bottom'   => 'Q013-DD4-Straight-Bottom.jpg',
  'Q011+DD4 Point Bottom'      => 'Q011-DD4-Point-Bottom.jpg',
  'Q010+DD4 Point Bottom'      => 'Q010-DD4-Point-Bottom.jpg',
  'Q016+DD4 Point Bottom'      => 'Q016-DD4-Point-Bottom.jpg',
  'Q018+DD4 Straight Bottom'   => 'Q018-DD4-Straight-Bottom.jpg',
  'Q019+DD4 Straight Bottom'   => 'Q019-DD4-Straight-Bottom.jpg',
  'Q020+DD4 Point Bottom'      => 'Q020-DD4-Point-Bottom.jpg',
  'Q021+DD4 Straight Bottom'   => 'Q021-DD4-Straight-Bottom.jpg',
];

/* ---------- Resolve (smart), build data URI, and detect missing ---------- */
$Waistcoat_Type_Path = PdfAsset::fromMapSmart('waistcoat_types', $Waistcoat_Type_Images, $selectedItem->waistcoat_type ?? null);
$Waistcoat_Type_Data = PdfAsset::toDataUri($Waistcoat_Type_Path);
$Waistcoat_Type_IsMissing = empty($Waistcoat_Type_Data);
if ($Waistcoat_Type_IsMissing) { $Waistcoat_Type_Data = PdfAsset::transparentPixel(); }

/* ---------- Debug toggle + info + visible test image ---------- */
/* No request() usage: you can pass $pdf_debug=true from the caller if you want */
$PDF_DEBUG = isset($pdf_debug) ? (bool)$pdf_debug : false;
$DBG = PdfAsset::debugInfo($Waistcoat_Type_Path);
/* A big, obvious 200×80 PNG stripe (to prove dompdf will render data URIs no matter what) */
$TEST_PNG = 'data:image/png;base64,'.
'iVBORw0KGgoAAAANSUhEUgAAAMgAAAAwCAYAAABGkH5hAAAACXBIWXMAAAsSAAALEgHS3X78AAABkElEQVR4nO3aMQ6CQBQF0Xg9kV4b'.
'9kQmY2i9r3B1F6QXo0k7c1Wb3r2k7d7iQhO3g3s6LkQk9+0mZsQ8Lw7QK0gAAAAAAAAAAAPw2qg6z0j8WmVqkG3b9u+8yTt8g3In'.
'8Qf4z9z9yA0g8n2Ww2j8xA1JcJ9g3lry7uQKj9aC6Y2J8p0m3mS9Lr7mYJ1gV5w3wq9bQ4fF2q2h7mQG6wO3E1gQF4o9'.
'zX3rYl7zF0r3h7QkM8V8L4k9iQG3cO3bF1QkF4o7V+2nQYb9Yy9dQkE4b9cV9dQkF4e8Wc7dQkF4o8AAAAAAAAAAAAAPwG0gEo'.
'3w2f9b8B0gEo3w2f9b8B0gEo3w2f9b8B0gEo3w2f9b8B0gEo3w2f9b8B0gGo7g3yCk7+3o2QAAAABJRU5ErkJggg==';
@endphp


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Waistcoat – Order #{{ $order->order_number ?? ($orders->order_number ?? '') }}</title>
<style>
  body { font-family: "DejaVu Sans", sans-serif; font-size: 12px; color:#111; }
  h1,h2 { margin: 0 0 8px 0; }
  h1 { font-size: 18px; } h2 { font-size: 14px; }
  .muted { color: #555; }
  .section { margin-top: 18px; }
  table { width: 100%; border-collapse: collapse; }
  th, td { padding: 6px 8px; border: 1px solid #ddd; vertical-align: top; }
  th { background: #f3f4f6; text-align: left; }
  .row { display: table; width: 100%; table-layout: fixed; }
  .col-25 { display: table-cell; width: 25%; vertical-align: top; }
  .card { border: 1px solid #ddd; padding: 8px; }
  .img-box { width: 100%; height: 220px;  text-align: center; position: relative; }
  .img-box img { max-width: 100%; max-height: 210px; }
  .tag { display: inline-block; padding: 2px 6px; border: 1px solid #aaa; border-radius: 3px; font-size: 11px; margin-top: 4px; }
  .missing {
    position:absolute; inset:0; display:flex; align-items:center; justify-content:center;
    font-size:13px; font-weight:700; color:#b91c1c; background: repeating-linear-gradient(
      -45deg, #fee2e2, #fee2e2 10px, #fff 10px, #fff 20px
    );
    border: 1px dashed #b91c1c;
  }
  .debug { font-size:10px; color:#666; margin:6px 0; }
  .test-img { margin:8px 0; border:1px solid #ddd; display:inline-block; }
</style>
</head>
<body>

<h1>Waistcoat</h1>

@if($PDF_DEBUG)
  <div class="debug">
    <strong>DEBUG:</strong>
    type="{{ $selectedItem->waistcoat_type ?? '' }}" |
    path="{{ $DBG['path'] ?? 'NULL' }}" |
    exists={{ !empty($DBG['exists']) ? 'yes' : 'no' }} |
    size={{ $DBG['size'] ?? '—' }} |
    ext={{ $DBG['ext'] ?? '—' }}
    <div class="test-img">
      <!-- This MUST show up (green stripe). If it doesn't, dompdf/image rendering is disabled. -->
      <img src="{{ $TEST_PNG }}" alt="TEST_PNG" width="320" height="128">
    </div>
  </div>
@endif

<p class="muted">
  Order #: <strong>{{ $order->order_number ?? ($orders->order_number ?? '') }}</strong> &nbsp;|&nbsp;
  Item #: <strong>{{ $selected_waistcoat->item_number ?? ($selectedItem->item_number ?? '') }}</strong> &nbsp;|&nbsp;
  For: <strong>{{ $measurement->name ?? '—' }}</strong>
</p>

<!-- Measurements -->
<div class="section">
  <h2>Measurements</h2>
  <table>
    <thead><tr><th>Measurement</th><th>Value</th></tr></thead>
    <tbody>
      <tr><td>DOB</td><td>{{ $measurement->dob ?? '' }}</td></tr>
      <tr><td>Gender</td><td>{{ $measurement->gender ?? '' }}</td></tr>
      <tr><td>Height</td><td>{{ $measurement->height ? $measurement->height.' cm' : '' }}</td></tr>
      <tr><td>Weight</td><td>{{ $measurement->weight ? $measurement->weight.' kg' : '' }}</td></tr>
      <tr><td>Shoulders</td><td>{{ $measurement->shoulders ? $measurement->shoulders.' cm' : '' }}</td></tr>
      <tr><td>Chest</td><td>{{ $measurement->chest ? $measurement->chest.' cm' : '' }}</td></tr>
      <tr><td>Waist</td><td>{{ $measurement->waist ? $measurement->waist.' cm' : '' }}</td></tr>
      <tr><td>Hip</td><td>{{ $measurement->hip ? $measurement->hip.' cm' : '' }}</td></tr>
      <tr><td>BS Shoulders</td><td>{{ $measurement->bs_shoulders ?? '' }}</td></tr>
      <tr><td>BS Chest</td><td>{{ $measurement->bs_chest ?? '' }}</td></tr>
      <tr><td>BS Stomach</td><td>{{ $measurement->bs_stomach ?? '' }}</td></tr>
      <tr><td>BS Posture</td><td>{{ $measurement->bs_posture ?? '' }}</td></tr>
      <tr><td>BS Seat</td><td>{{ $measurement->bs_seat ?? '' }}</td></tr>

      @if(!is_null($measurement->sleeve_length ?? null))        <tr><td>Sleeve Length</td><td>{{ $measurement->sleeve_length }} cm</td></tr>@endif
      @if(!is_null($measurement->bicep ?? null))                <tr><td>Bicep</td><td>{{ $measurement->bicep }} cm</td></tr>@endif
      @if(!is_null($measurement->wrist ?? null))                <tr><td>Wrist</td><td>{{ $measurement->wrist }} cm</td></tr>@endif
      @if(!is_null($measurement->belly ?? null))                <tr><td>Belly</td><td>{{ $measurement->belly }} cm</td></tr>@endif
      @if(!is_null($measurement->thigh ?? null))                <tr><td>Thigh</td><td>{{ $measurement->thigh }} cm</td></tr>@endif
      @if(!is_null($measurement->knee ?? null))                 <tr><td>Knee</td><td>{{ $measurement->knee }} cm</td></tr>@endif
      @if(!is_null($measurement->cuff ?? null))                 <tr><td>Cuff</td><td>{{ $measurement->cuff }} cm</td></tr>@endif
      @if(!is_null($measurement->outside_leg_length ?? null))   <tr><td>Outside Leg Length</td><td>{{ $measurement->outside_leg_length }} cm</td></tr>@endif
      @if(!is_null($measurement->neck ?? null))                 <tr><td>Neck</td><td>{{ $measurement->neck }} cm</td></tr>@endif
      @if(!is_null($measurement->crotch ?? null))               <tr><td>Crotch</td><td>{{ $measurement->crotch }} cm</td></tr>@endif
      @if(!is_null($measurement->inside_leg_length ?? null))    <tr><td>Inside Leg Length</td><td>{{ $measurement->inside_leg_length }} cm</td></tr>@endif
      @if(!is_null($measurement->inside_sleeve_length ?? null)) <tr><td>Inside Sleeve Length</td><td>{{ $measurement->inside_sleeve_length }} cm</td></tr>@endif
      @if(!is_null($measurement->pants_cuff_width ?? null))     <tr><td>Pants Cuff Width</td><td>{{ $measurement->pants_cuff_width }} cm</td></tr>@endif
      @if(!is_null($measurement->jacket_length_front ?? null))  <tr><td>Jacket Length Front</td><td>{{ $measurement->jacket_length_front }} cm</td></tr>@endif
    </tbody>
  </table>
</div>

<!-- Waistcoat -->
<div class="section">
  <h2>Waistcoat Construction</h2>

  {{-- ===== Waistcoat Codes ===== --}}
<div class="section">
  <h2>Waistcoat Codes (All)</h2>
  <table>
    <thead><tr><th>Code Field</th><th>Value</th></tr></thead>
    <tbody>
      <tr>
        <td>Code Waistcoat</td>
        <td>{{ strtoupper(($selected_waistcoat->code_waistcoat ?? $selectedItem->code_waistcoat) ?? '') }}</td>
      </tr>
      <tr>
        <td>Code Waistcoat Button</td>
        <td>{{ strtoupper(($selected_waistcoat->code_waistcoat_buttons ?? $selectedItem->code_waistcoat_buttons) ?? '') }}</td>
      </tr>

    </tbody>
  </table>
</div>


  <table class="section">
    <tbody>
      <tr>
        <td class="col-25">

        <div style="text-align:center; font-weight:700;">Type</div>
        <br>

          <div class="img-box">
            <img src="{{ $Waistcoat_Type_Data }}" alt="Waistcoat Type">
            @if($Waistcoat_Type_IsMissing)
              <div class="missing">⚠️ MISSING ASSET ({{ $selectedItem->waistcoat_type ?? '—' }})</div>
            @endif
          </div>
          <div>Type: {{ $selected_waistcoat->waistcoat_type ?? ($selectedItem->waistcoat_type ?? '') }}</div>
        </td>
        <td class="col-25"></td><td class="col-25"></td><td class="col-25"></td>
      </tr>
    </tbody>
  </table>
</div>

</body>
</html>


