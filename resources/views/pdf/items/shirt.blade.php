{{-- resources/views/pdf/items/shirt.blade.php --}}
@php
use App\Support\PdfAsset;

/* ===== Resolve the selected item ===== */
$selectedItem = null; $type = 'shirt';
if (!empty($selectedshirt))      { $selectedItem = $selectedshirt; }
elseif (!empty($item))           { $selectedItem = $item; }
else                             { $selectedItem = (object)[]; }

$ordNo = $order->order_number ?? ($orders->order_number ?? '');
$cust  = $measurement->name ?? '—';

/* ===== Image maps (all PNG changed to JPG) ===== */
$Shirt_Collars_Images = [
  'Classic'        => 'classic.jpg',
  'Cutaway'        => 'cutaway.jpg',
  'Italian Spread' => 'italian-spread.jpg',
  'Special 1'      => 'special1.jpg',
  'Special 2'      => 'special2.jpg',
];

$Shirt_Collar_Buttons_Images = [
  '1 Button'           => '1_button.jpg',
  '2 Buttons Classic'  => '2_buttons_classic.jpg',
  '2 Buttons Tall'     => '2_buttons_tall.jpg',
  '3 Buttons'          => '3_buttons.jpg',
];

$Shirt_Collar_Button_Down_Images = [
  'No Button Down'     => 'no_button_down.jpg',
  'Button Down'        => 'button_down.jpg',
  'Hidden Button Down' => 'hidden_button_down.jpg',
];

$Shirt_Cuff_Images = [
  '1 Button Round'  => '1_button_round.jpg',
  '2 Button Round'  => '2_button_round.jpg',
  '1 Button Angle'  => '1_button_angle.jpg',
  '2 Button Angle'  => '2_button_angle.jpg',
  'French Square'   => 'french_square.jpg',
  'French Angle'    => 'french_angle.jpg',
  'Cocktail'        => 'cocktail.jpg',
];

$Shirt_Contrast_Images =
[
  'No Contrast' => 'standard.jpg',
  'Contrast 1'  => 'contrast_1.jpg',
  'Contrast 2'  => 'contrast_2.jpg',
];

$Shirt_Placket_Images =
[
  'Standard Placket' => 'no_contrast.jpg',
  'No Placket'       => 'no.jpg',
  'Concealed Placket'=> 'concealed.jpg',
];

$Shirt_Pleat_Images =
[
  'Two Side Pleat' => 'two_side.jpg',
  'Center Pleat'   => 'center.jpg',
  'No Pleat'       => 'no.jpg',
];

$Shirt_Bottom_Images =
[
  'Round Bottom'    => 'round.jpg',
  'Straight Bottom' => 'straight.jpg',
];

$Shirt_Pocket_Images =
[
  'Round'      => 'round.jpg',
  'Angle'      => 'angle.jpg',
  'Pointed'    => 'pointed.jpg',
  'No Pocket'  => 'no.jpg',
];

$Shirt_Fit_Images =
[
  'Regular'  => 'regular.jpg',
  'Fitted'   => 'fitted.jpg',
  'Slim Fit' => 'slim.jpg',
];

/* ===== Resolve paths and data URIs ===== */
$S = $selectedItem;

$Shirt_Collars_Data =
    PdfAsset::toDataUri(PdfAsset::fromMap('shirt/collars', $Shirt_Collars_Images, $S->collar ?? null));

$Shirt_Collar_Buttons_Data =
    PdfAsset::toDataUri(PdfAsset::fromMap('shirt/collar_buttons', $Shirt_Collar_Buttons_Images, $S->collar_buttons ?? null));

$Shirt_Collar_Button_Down_Data =
    PdfAsset::toDataUri(PdfAsset::fromMap('shirt/collar_buttons', $Shirt_Collar_Button_Down_Images, $S->collar_button_down ?? null));

$Shirt_Cuff_Data =
    PdfAsset::toDataUri(PdfAsset::fromMap('shirt/cuffs', $Shirt_Cuff_Images, $S->cuff ?? null));

$Shirt_Contrast_Data =
    PdfAsset::toDataUri(PdfAsset::fromMap('shirt/contrasts', $Shirt_Contrast_Images, $S->contrast ?? null));

$Shirt_Placket_Data =
    PdfAsset::toDataUri(PdfAsset::fromMap('shirt/placket', $Shirt_Placket_Images, $S->placket ?? null));

$Shirt_Pleat_Data =
    PdfAsset::toDataUri(PdfAsset::fromMap('shirt/pleat', $Shirt_Pleat_Images, $S->pleat ?? null));

$Shirt_Bottom_Data =
    PdfAsset::toDataUri(PdfAsset::fromMap('shirt/bottom', $Shirt_Bottom_Images, $S->bottom ?? null));

$Shirt_Pocket_Data =
    PdfAsset::toDataUri(PdfAsset::fromMap('shirt/pocket', $Shirt_Pocket_Images, $S->pocket ?? null));

$Shirt_Fit_Data =
    PdfAsset::toDataUri(PdfAsset::fromMap('shirt/fit', $Shirt_Fit_Images, $S->fit ?? null));
@endphp


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Shirt – Order #{{ $ordNo }}</title>
<style>
  body { font-family: "DejaVu Sans", sans-serif; font-size: 12px; color:#111; }
  h1,h2{ margin:0 0 8px 0; } h1{ font-size:18px; } h2{ font-size:14px; }
  .muted{ color:#555; }
  .section{ margin-top:18px; }
  table{ width:100%; border-collapse:collapse; }
  th,td{ padding:6px 8px; border:1px solid #ddd; vertical-align:top; }
  th{ background:#f3f4f6; text-align:left; }
  .grid4 { width:100%; border-collapse:separate; border-spacing:10px 10px; }
  .cell { width:25%; border:1px solid #ddd; padding:8px; page-break-inside:avoid; }
  .img-box{ width:100%; height:220px; text-align:center; }
  .img-box img{ max-width:100%; max-height:210px; }
  .tag{ display:inline-block; padding:2px 6px; border:1px solid #aaa; border-radius:3px; font-size:11px; margin-top:4px; }
</style>
</head>
<body>

<h1>Shirt</h1>
<p class="muted">
  Order #: <strong>{{ $ordNo }}</strong> &nbsp;|&nbsp;
  Item #: <strong>{{ $selectedItem->item_number ?? '—' }}</strong> &nbsp;|&nbsp;
  For: <strong>{{ $cust }}</strong>
</p>

{{-- Measurements --}}
<div class="section">
  <h2>Measurements</h2>
  <table>
    <thead><tr><th>Measurement</th><th>Value</th></tr></thead>
    <tbody>
      <tr><td>DOB</td><td>{{ $measurement->dob ?? '' }}</td></tr>
      <tr><td>Gender</td><td>{{ $measurement->gender ?? '' }}</td></tr>
      <tr><td>Height</td><td>{{ isset($measurement->height) ? $measurement->height.' cm' : '' }}</td></tr>
      <tr><td>Weight</td><td>{{ isset($measurement->weight) ? $measurement->weight.' kg' : '' }}</td></tr>
      <tr><td>Shoulders</td><td>{{ isset($measurement->shoulders) ? $measurement->shoulders.' cm' : '' }}</td></tr>
      <tr><td>Chest</td><td>{{ isset($measurement->chest) ? $measurement->chest.' cm' : '' }}</td></tr>
      <tr><td>Waist</td><td>{{ isset($measurement->waist) ? $measurement->waist.' cm' : '' }}</td></tr>
      <tr><td>Hip</td><td>{{ isset($measurement->hip) ? $measurement->hip.' cm' : '' }}</td></tr>
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

{{-- Shirt Codes --}}
<div class="section">
  <h2>Shirt Codes</h2>
  <table>
    <thead><tr><th>Code Field</th><th>Value</th></tr></thead>
    <tbody>
      <tr><td>Shirt Fabric</td><td>{{ strtoupper($selectedItem->shirt_fabric_code ?? '') }}</td></tr>
      <tr><td>Shirt Buttons</td><td>{{ strtoupper($selectedItem->shirt_button_code ?? '') }}</td></tr>
      @if(($selectedItem->contrast ?? '') !== 'No Contrast')
      <tr><td>Shirt Contrast</td><td>{{ strtoupper($selectedItem->shirt_contrast_code ?? '') }}</td></tr>
      @endif
    </tbody>
  </table>
</div>

{{-- Shirt Options --}}
<div class="section">
  <h2>Shirt Construction</h2>
  <table class="grid4">
    <tr>
      <td class="cell"><div class="img-box">@if($Shirt_Collars_Data)<img src="{{ $Shirt_Collars_Data }}" alt="Collar">@endif</div><div>Collar: {{ $selectedItem->collar ?? '' }}</div></td>
      <td class="cell"><div class="img-box">@if($Shirt_Collar_Buttons_Data)<img src="{{ $Shirt_Collar_Buttons_Data }}" alt="Collar Buttons">@endif</div><div>Collar Buttons: {{ $selectedItem->collar_buttons ?? '' }}</div></td>
      <td class="cell"><div class="img-box">@if($Shirt_Collar_Button_Down_Data)<img src="{{ $Shirt_Collar_Button_Down_Data }}" alt="Collar Button Down">@endif</div><div>Collar Button Down: {{ $selectedItem->collar_button_down ?? '' }}</div></td>
      <td class="cell"><div class="img-box">@if($Shirt_Cuff_Data)<img src="{{ $Shirt_Cuff_Data }}" alt="Cuff">@endif</div><div>Cuff: {{ $selectedItem->cuff ?? '' }}</div></td>
    </tr>
    <tr>
      <td class="cell"><div class="img-box">@if($Shirt_Contrast_Data)<img src="{{ $Shirt_Contrast_Data }}" alt="Contrast">@endif</div><div>Contrast: {{ $selectedItem->contrast ?? '' }}</div></td>
      <td class="cell"><div class="img-box">@if($Shirt_Placket_Data)<img src="{{ $Shirt_Placket_Data }}" alt="Placket">@endif</div><div>Placket: {{ $selectedItem->placket ?? '' }}</div></td>
      <td class="cell"><div class="img-box">@if($Shirt_Pleat_Data)<img src="{{ $Shirt_Pleat_Data }}" alt="Pleat">@endif</div><div>Pleat: {{ $selectedItem->pleat ?? '' }}</div></td>
      <td class="cell"><div class="img-box">@if($Shirt_Bottom_Data)<img src="{{ $Shirt_Bottom_Data }}" alt="Bottom">@endif</div><div>Bottom: {{ $selectedItem->bottom ?? '' }}</div></td>
    </tr>
    <tr>
      <td class="cell"><div class="img-box">@if($Shirt_Pocket_Data)<img src="{{ $Shirt_Pocket_Data }}" alt="Pocket">@endif</div><div>Pocket: {{ $selectedItem->pocket ?? '' }}</div></td>
      <td class="cell"><div class="img-box">@if($Shirt_Fit_Data)<img src="{{ $Shirt_Fit_Data }}" alt="Fit">@endif</div><div>Fit: {{ $selectedItem->fit ?? '' }}</div></td>
      <td class="cell"></td><td class="cell"></td>
    </tr>
  </table>
</div>

</body>
</html>
