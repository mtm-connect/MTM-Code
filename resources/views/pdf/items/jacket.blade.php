{{-- resources/views/pdf/items/jacket.blade.php --}}
@php
use App\Support\PdfAsset; // still fine even if we don't use it

/* ===== Resolve the selected item ===== */
$selectedItem = null; $type = 'jacket';
if (!empty($selectedjacket)) { $selectedItem = $selectedjacket; }
elseif (!empty($item))       { $selectedItem = $item; }
else                         { $selectedItem = (object)[]; }

$ordNo = $order->order_number ?? ($orders->order_number ?? '');
$cust  = $measurement->name ?? '—';

/**
 * Safe local-image resolver:
 *  - $folder: e.g. 'jacket_type', 'canvas', 'lapel_type', etc.
 *  - $map: label => filename
 *  - $value: selected option string
 *
 * Looks in public/images/{folder}/{filename} and returns a data: URI.
 * Never throws – returns null if anything goes wrong.
 */
$img = function (string $folder, array $map, $value): ?string {
    $v = is_string($value) ? trim($value) : ($value ?? null);
    if ($v === '' || $v === null) return null;
    if (!isset($map[$v])) return null;

    $filename = $map[$v];
    $path = public_path('images/' . trim($folder, '/') . '/' . $filename);

    if (!is_file($path) || !is_readable($path)) {
        return null;
    }

    try {
        $bytes = @file_get_contents($path);
        if ($bytes === false) return null;

        $ext  = strtolower(pathinfo($path, PATHINFO_EXTENSION));
        $mime = ($ext === 'jpg' || $ext === 'jpeg') ? 'image/jpeg' : 'image/png';

        return 'data:' . $mime . ';base64,' . base64_encode($bytes);
    } catch (\Throwable $e) {
        return null;
    }
};

/* ===== Image maps – same labels/filenames as your jacket VIEW ===== */
$Jacket_Type_Images = [
  'Single 1 Button'      => 'jacket_type_1.jpg',
  'Single 2 Buttons'     => 'jacket_type_2.jpg',
  'Single 3 Buttons'     => 'jacket_type_3.jpg',
  'Single 4 Buttons'     => 'jacket_type_4.jpg',
  'Double Breast 4 on 1' => 'jacket_type_9.jpg',
  'Double Breast 6 on 3' => 'jacket_type_8.jpg',
  '3 Roll 2'             => 'jacket_type_5.jpg',
];

$Jacket_Construction_Images = [
  'Full Canvas' => 'full.jpg',
  'Half Canvas' => 'half.jpg',
];

$Jacket_LapelType_Images = [
  'Notch Lapel' => 'notch.jpg',
  'Peak Lapel'  => 'peak.jpg',
  'Shawl Lapel' => 'shawl.jpg',
];

$Jacket_SatinType_Images = [
  'No Satin Lapel'                     => 'no_satin.jpg',
  'Satin Front Lapel'                  => 'front_satin.jpg',
  'Satin Front Including Back Collar'  => 'front_back_collar_satin.jpg',
];

$handstitch_Images = [
  'Yes' => 'yes.jpg',
  'No'  => 'no.jpg',
];

$lapel_width_Images = [
  'Thinner' => 'thinner.jpg',
  'Regular' => 'regular.jpg',
  'Wider'   => 'wider.jpg',
];

$lapel_functional_button_Images = [
  'Decorative' => 'decorative.jpg',
  'Functional' => 'functional.jpg',
];

$jacket_sleeve_buttons_Images = [
  '2 Sleeve Buttons' => '2_buttons.jpg',
  '3 Sleeve Buttons' => '3_buttons.jpg',
  '4 Sleeve Buttons' => '4_buttons.jpg',
  '5 Sleeve Buttons' => '5_buttons.jpg',
];

$jacket_functional_buttons_Images = [
  'Decorative' => 'decorative.jpg',
  'Functional' => 'functional.jpg',
];

// These were already jpg — unchanged
$jacket_buttons_colour_on_last_button_hole_Images = [
    'Yes' => 'yes.jpg',
    'No'  => 'no.jpg',
];

$jacket_lining_Images = [
  'Full Lining' => 'full_lining.jpg',
  'Half Lining' => 'half_lining.jpg',
  'No Lining'   => 'no_lining.jpg',
];

$jacket_pockets_Images = [
  'No Pockets' => 'no_pockets.jpg',
  '2 Pockets'  => '2_pockets.jpg',
  '3 Pockets'  => '3_pockets.jpg',
];

$jacket_pockets_with_flap_Images = [
  'Yes' => 'yes.jpg',
  'No'  => 'no.jpg',
];

$jacket_italian_pockets_Images = [
  'Yes' => 'yes.jpg',
  'No'  => 'no.jpg',
];

$jacket_patch_pockets_Images = [
  'Yes' => 'yes.jpg',
  'No'  => 'no.jpg',
];

$jacket_pockets_satin_piping_Images = [
  'Yes' => 'yes.jpg',
  'No'  => 'no.jpg',
];

$jacket_chest_pocket_type_Images = [
  'Curved Chest Pocket' => 'curved.jpg',
  'Patch Chest Pocket'  => 'patch.jpg',
  'Satin Chest Pocket'  => 'satin.jpg',
];

$jacket_vents_Images = [
  'No Vent'     => 'no_vent.jpg',
  'Single Vent' => 'single_vent.jpg',
  'Double Vent' => 'double_vent.jpg',
];


/* ===== Resolve data URIs (folders mirror your web view) ===== */
$S = $selectedItem;

$Jacket_Type_Data           = $img('jacket_type',             $Jacket_Type_Images,                    $S->jacket_type ?? null);
$Jacket_Construction_Data   = $img('canvas',                  $Jacket_Construction_Images,            $S->jacket_construction ?? null);
$Jacket_LapelType_Data      = $img('lapel_type',              $Jacket_LapelType_Images,               $S->jacket_lapel_type ?? null);
$Jacket_SatinType_Data      = $img('satin_lapel',             $Jacket_SatinType_Images,               $S->jacket_satin_lapel ?? null);
$handstitch_Data            = $img('handstitch',              $handstitch_Images,                     $S->jacket_hand_stitch ?? null);
$lapel_width_Data           = $img('lapel_width',             $lapel_width_Images,                    $S->jacket_lapel_width ?? null);
$lapel_functional_Data      = $img('lapel_functional_button', $lapel_functional_button_Images,        $S->jacket_lapel_functional_button ?? null);
$jacket_sleeve_buttons_Data = $img('sleeve_buttons',          $jacket_sleeve_buttons_Images,          $S->jacket_sleeve_buttons ?? null);
$jacket_functional_Data     = $img('functional_buttons',      $jacket_functional_buttons_Images,      $S->jacket_functional_buttons ?? null);

$jacket_buttons_colour_last_Data
    = $img('buttons_contrast_jpg', $jacket_buttons_colour_on_last_button_hole_Images, $S->jacket_buttons_colour_on_last_button_hole ?? null);


$jacket_lining_Data         = $img('lining',                  $jacket_lining_Images,                  $S->jacket_lining ?? null);
$jacket_pockets_Data        = $img('pockets',                 $jacket_pockets_Images,                 $S->jacket_pockets ?? null);
$jacket_pockets_flap_Data   = $img('pockets_with_flap',       $jacket_pockets_with_flap_Images,       $S->jacket_pockets_with_flap ?? null);
$jacket_italian_Data        = $img('italian_pockets',         $jacket_italian_pockets_Images,         $S->jacket_italian_pockets ?? null);
$jacket_patch_Data          = $img('patch_pockets',           $jacket_patch_pockets_Images,           $S->jacket_patch_pockets ?? null);
$jacket_satin_piping_Data   = $img('pockets_satin_piping',    $jacket_pockets_satin_piping_Images,    $S->jacket_pockets_satin_piping ?? null);
$jacket_chest_Data          = $img('chest_pocket',            $jacket_chest_pocket_type_Images,       $S->jacket_chest_pocket_type ?? null);
$jacket_vents_Data          = $img('vents',                   $jacket_vents_Images,                   $S->jacket_vents ?? null);

$code = fn($v) => is_string($v) ? strtoupper($v) : '';
@endphp


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Jacket – Order #{{ $ordNo }}</title>
<style>
  body { font-family: "DejaVu Sans", sans-serif; font-size: 12px; color:#111; }
  h1,h2 { margin:0 0 8px 0; } h1{ font-size:18px; } h2{ font-size:14px; }
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

<h1>Jacket</h1>
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
      <tr><td>Sleeve Length</td><td>{{ isset($measurement->sleeve_length) ? $measurement->sleeve_length.' cm' : '' }}</td></tr>
      <tr><td>Bicep</td><td>{{ isset($measurement->bicep) ? $measurement->bicep.' cm' : '' }}</td></tr>
      <tr><td>Wrist</td><td>{{ isset($measurement->wrist) ? $measurement->wrist.' cm' : '' }}</td></tr>
      <tr><td>Chest</td><td>{{ isset($measurement->chest) ? $measurement->chest.' cm' : '' }}</td></tr>
      <tr><td>Belly</td><td>{{ isset($measurement->belly) ? $measurement->belly.' cm' : '' }}</td></tr>
      <tr><td>Waist</td><td>{{ isset($measurement->waist) ? $measurement->waist.' cm' : '' }}</td></tr>
      <tr><td>Hip</td><td>{{ isset($measurement->hip) ? $measurement->hip.' cm' : '' }}</td></tr>
      <tr><td>Thigh</td><td>{{ isset($measurement->thigh) ? $measurement->thigh.' cm' : '' }}</td></tr>
      <tr><td>Knee</td><td>{{ isset($measurement->knee) ? $measurement->knee.' cm' : '' }}</td></tr>
      <tr><td>Cuff</td><td>{{ isset($measurement->cuff) ? $measurement->cuff.' cm' : '' }}</td></tr>
      <tr><td>Outside Leg Length</td><td>{{ isset($measurement->outside_leg_length) ? $measurement->outside_leg_length.' cm' : '' }}</td></tr>
      <tr><td>Neck</td><td>{{ isset($measurement->neck) ? $measurement->neck.' cm' : '' }}</td></tr>

      @if(!is_null($measurement->crotch ?? null))               <tr><td>Crotch</td><td>{{ $measurement->crotch }} cm</td></tr>@endif
      @if(!is_null($measurement->inside_leg_length ?? null))    <tr><td>Inside Leg Length</td><td>{{ $measurement->inside_leg_length }} cm</td></tr>@endif
      @if(!is_null($measurement->inside_sleeve_length ?? null)) <tr><td>Inside Sleeve Length</td><td>{{ $measurement->inside_sleeve_length }} cm</td></tr>@endif
      @if(!is_null($measurement->pants_cuff_width ?? null))     <tr><td>Pants Cuff Width</td><td>{{ $measurement->pants_cuff_width }} cm</td></tr>@endif
      @if(!is_null($measurement->jacket_length_front ?? null))  <tr><td>Jacket Length Front</td><td>{{ $measurement->jacket_length_front }} cm</td></tr>@endif

      <tr><td>BS Shoulders</td><td>{{ $measurement->bs_shoulders ?? '' }}</td></tr>
      <tr><td>BS Chest</td><td>{{ $measurement->bs_chest ?? '' }}</td></tr>
      <tr><td>BS Stomach</td><td>{{ $measurement->bs_stomach ?? '' }}</td></tr>
      <tr><td>BS Posture</td><td>{{ $measurement->bs_posture ?? '' }}</td></tr>
      <tr><td>BS Seat</td><td>{{ $measurement->bs_seat ?? '' }}</td></tr>
    </tbody>
  </table>
</div>

{{-- Jacket Codes --}}
<div class="section">
  <h2>Jacket Codes</h2>
  <table>
    <thead><tr><th>Code Field</th><th>Value</th></tr></thead>
    <tbody>
      <tr><td>Jacket Fabric</td><td>{{ $code($S->code_jacket ?? '') }}</td></tr>
      @if(($S->jacket_lining ?? '') !== 'No Lining')
      <tr><td>Jacket Lining</td><td>{{ $code($S->code_jacket_lining ?? '') }}</td></tr>
      @endif
      <tr><td>Jacket Buttons</td><td>{{ $code($S->code_jacket_button ?? '') }}</td></tr>
      @if(($S->jacket_satin_lapel ?? '') !== 'No Satin Lapel')
      <tr><td>Satin Lapel</td><td>{{ $code($S->code_satin_lapel ?? '') }}</td></tr>
      @endif
      @if(($S->jacket_buttons_colour_on_last_button_hole ?? '') === 'Yes')
      <tr><td>Last Button Hole Colour</td><td>{{ $code($S->code_colour_on_last_button_hole ?? '') }}</td></tr>
      @endif
    </tbody>
  </table>
</div>

{{-- Jacket Options – Shirt-style 4-column grid --}}
<div class="section">
  <h2>Jacket Construction</h2>
  <table class="grid4">
    <tr>
      <td class="cell">
        <div class="img-box">
          @if($Jacket_Type_Data)<img src="{{ $Jacket_Type_Data }}" alt="Jacket Type">@endif
        </div>
        <div>Type: {{ $S->jacket_type ?? '' }}</div>
        <div class="tag">Fabric: {{ $code($S->code_jacket ?? '') }}</div>
      </td>

      <td class="cell">
        <div class="img-box">
          @if($Jacket_Construction_Data)<img src="{{ $Jacket_Construction_Data }}" alt="Construction">@endif
        </div>
        <div>Construction: {{ $S->jacket_construction ?? '' }}</div>
      </td>

      <td class="cell">
        <div class="img-box">
          @if($Jacket_LapelType_Data)<img src="{{ $Jacket_LapelType_Data }}" alt="Lapel Type">@endif
        </div>
        <div>Lapel: {{ $S->jacket_lapel_type ?? '' }}</div>
      </td>

      <td class="cell">
        <div class="img-box">
          @if($Jacket_SatinType_Data)<img src="{{ $Jacket_SatinType_Data }}" alt="Satin Lapel">@endif
        </div>
        <div>Satin Lapel: {{ $S->jacket_satin_lapel ?? '' }}</div>
        @if(($S->jacket_satin_lapel ?? '') !== 'No Satin Lapel' && !empty($S->code_satin_lapel ?? ''))
          <div class="tag">Satin: {{ $code($S->code_satin_lapel) }}</div>
        @endif
      </td>
    </tr>

    <tr>
      <td class="cell">
        <div class="img-box">
          @if($handstitch_Data)<img src="{{ $handstitch_Data }}" alt="Hand Stitch">@endif
        </div>
        <div>Lapel Hand Stitch: {{ $S->jacket_hand_stitch ?? '' }}</div>
      </td>

      <td class="cell">
        <div class="img-box">
          @if($lapel_width_Data)<img src="{{ $lapel_width_Data }}" alt="Lapel Width">@endif
        </div>
        <div>Lapel Width: {{ $S->jacket_lapel_width ?? '' }}</div>
      </td>

      <td class="cell">
        <div class="img-box">
          @if($lapel_functional_Data)<img src="{{ $lapel_functional_Data }}" alt="Lapel Functional Button">@endif
        </div>
        <div>Lapel Functional Button: {{ $S->jacket_lapel_functional_button ?? '' }}</div>
      </td>

      <td class="cell">
        <div class="img-box">
          @if($jacket_sleeve_buttons_Data)<img src="{{ $jacket_sleeve_buttons_Data }}" alt="Sleeve Buttons">@endif
        </div>
        <div>Sleeve Buttons: {{ $S->jacket_sleeve_buttons ?? '' }}</div>
        <div class="tag">Buttons: {{ $code($S->code_jacket_button ?? '') }}</div>
      </td>
    </tr>

    <tr>
      <td class="cell">
        <div class="img-box">
          @if($jacket_functional_Data)<img src="{{ $jacket_functional_Data }}" alt="Functional Buttons">@endif
        </div>
        <div>Functional Buttons: {{ $S->jacket_functional_buttons ?? '' }}</div>
      </td>

      <td class="cell">
        <div class="img-box">
          @if($jacket_lining_Data)<img src="{{ $jacket_lining_Data }}" alt="Jacket Lining">@endif
        </div>
        <div>Lining: {{ $S->jacket_lining ?? '' }}</div>
        @if(($S->jacket_lining ?? '') !== 'No Lining' && !empty($S->code_jacket_lining ?? ''))
          <div class="tag">Lining: {{ $code($S->code_jacket_lining) }}</div>
        @endif
      </td>

      <td class="cell">
        <div class="img-box">
          @if($jacket_pockets_Data)<img src="{{ $jacket_pockets_Data }}" alt="Jacket Pockets">@endif
        </div>
        <div>Pockets: {{ $S->jacket_pockets ?? '' }}</div>
      </td>

      <td class="cell">
        <div class="img-box">
          @if($jacket_pockets_flap_Data)<img src="{{ $jacket_pockets_flap_Data }}" alt="Pockets with Flap">@endif
        </div>
        <div>Pockets with Flap: {{ $S->jacket_pockets_with_flap ?? '' }}</div>
      </td>
    </tr>

    <tr>
      <td class="cell">
        <div class="img-box">
          @if($jacket_italian_Data)<img src="{{ $jacket_italian_Data }}" alt="Italian Pockets">@endif
        </div>
        <div>Italian Pockets: {{ $S->jacket_italian_pockets ?? '' }}</div>
      </td>

      <td class="cell">
        <div class="img-box">
          @if($jacket_patch_Data)<img src="{{ $jacket_patch_Data }}" alt="Patch Pockets">@endif
        </div>
        <div>Patch Pockets: {{ $S->jacket_patch_pockets ?? '' }}</div>
      </td>

      <td class="cell">
        <div class="img-box">
          @if($jacket_satin_piping_Data)<img src="{{ $jacket_satin_piping_Data }}" alt="Satin Piping">@endif
        </div>
        <div>Satin Piping: {{ $S->jacket_pockets_satin_piping ?? '' }}</div>
      </td>

      <td class="cell">
        <div class="img-box">
          @if($jacket_chest_Data)<img src="{{ $jacket_chest_Data }}" alt="Chest Pocket">@endif
        </div>
        <div>Chest Pocket: {{ $S->jacket_chest_pocket_type ?? '' }}</div>
      </td>
    </tr>

    <tr>
  <td class="cell">
    <div class="img-box">
      @if($jacket_vents_Data)<img src="{{ $jacket_vents_Data }}" alt="Vents">@endif
    </div>
    <div>Vents: {{ $S->jacket_vents ?? '' }}</div>
  </td>


  {{-- Colour on Last Button Hole --}}
  <td class="cell">
    <div class="img-box">
      @if($jacket_buttons_colour_last_Data)
        <img src="{{ $jacket_buttons_colour_last_Data }}" alt="Colour on Last Button Hole">
      @endif
    </div>
    <div>Colour on Last Button Hole: {{ $S->jacket_buttons_colour_on_last_button_hole ?? '' }}</div>
    @if(($S->jacket_buttons_colour_on_last_button_hole ?? '') === 'Yes')
      <div class="tag">Colour Code: {{ $code($S->code_colour_on_last_button_hole ?? '') }}</div>
    @endif
  </td>


  <td class="cell"></td>
  <td class="cell"></td>
</tr>



  </table>
</div>

</body>
</html>
