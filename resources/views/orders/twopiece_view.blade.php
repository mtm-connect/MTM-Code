@php   
// Ensure we have the selected item (prioritizing the most specific extension)
if (isset($selected_threepiece)) {
    $selectedItem = $selected_threepiece;
    $type = 'three_piece';
} elseif (isset($selected_twopiece)) {
    $selectedItem = $selected_twopiece;
    $type = 'two_piece';
} elseif (isset($selectedjacket)) {
    $selectedItem = $selectedjacket;
    $type = 'jacket';
} else {
    $selectedItem = null;
    $type = null;
}

// Function to retrieve image path based on available extension
function getImage($imagesArray, $selectedItem, $attribute, $folder) {
    return isset($selectedItem->$attribute) && isset($imagesArray[$selectedItem->$attribute]) 
        ? asset("images/$folder/" . $imagesArray[$selectedItem->$attribute]) 
        : asset('images/order/default.jpg'); // Fallback image
}

// Image mappings for various jacket options
$Jacket_Type_Images = [
    'Single 1 Button' => 'jacket_type_1.png',
    'Single 2 Buttons' => 'jacket_type_2.png',
    'Single 3 Buttons' => 'jacket_type_3.png',
    'Single 4 Buttons' => 'jacket_type_4.png',
    'Double Breast 4 on 1' => 'jacket_type_9.png',
    'Double Breast 6 on 3' => 'jacket_type_8.png',
    '3 Roll 2' => 'jacket_type_5.png'
];

$Jacket_Construction_Images = [
    'Full Canvas' => 'full.png',
    'Half Canvas' => 'half.png',
];

$Jacket_LapelType_Images = [
    'Notch Lapel' => 'notch.png',
    'Peak Lapel' => 'peak.png',
    'Shawl Lapel' => 'shawl.png',
];

$Jacket_SatinType_Images = [
    'No Satin Lapel' => 'no_satin.png',
    'Satin Front Lapel' => 'front_satin.png',
    'Satin Front Including Back Collar' => 'front_back_collar_satin.png',
];

$handstitch_Images = [
    'Yes' => 'yes.png',
    'No' => 'no.png',
];

$lapel_width_Images = [
    'Thinner' => 'thinner.png',
    'Regular' => 'regular.png',
    'Wider' => 'wider.png',
];

$lapel_functional_button_Images = [
    'Decorative' => 'decorative.png',
    'Functional' => 'functional.png',
];

$jacket_sleeve_buttons_Images = [
    '2 Sleeve Buttons' => '2_buttons.png',
    '3 Sleeve Buttons' => '3_buttons.png',
    '4 Sleeve Buttons' => '4_buttons.png',
    '5 Sleeve Buttons' => '5_buttons.png',
];

$jacket_functional_buttons_Images = [
    'Decorative' => 'decorative.png',
    'Functional' => 'functional.png',
];

$jacket_buttons_colour_on_last_button_hole_Images = [
    'Yes' => 'yes.png',
    'No'  => 'no.png',
];

$jacket_lining_Images = [
    'Full Lining' => 'full_lining.png',
    'Half Lining' => 'half_lining.png',
    'No Lining'   => 'no_lining.png',
];

$jacket_pockets_Images = [
    'No Pockets' => 'no_pockets.png',
    '2 Pockets'  => '2_pockets.png',
    '3 Pockets'  => '3_pockets.png',
];

$jacket_pockets_with_flap_Images = [
    'Yes' => 'yes.png',
    'No'  => 'no.png',
];

$jacket_italian_pockets_Images = [
    'Yes' => 'yes.png',
    'No'  => 'no.png',
];

$jacket_patch_pockets_Images = [
    'Yes' => 'yes.png',
    'No'  => 'no.png',
];

$jacket_pockets_satin_piping_Images = [
    'Yes' => 'yes.png',
    'No'  => 'no.png',
];

$jacket_chest_pocket_type_Images = [
    'Curved Chest Pocket' => 'curved.png',
    'Patch Chest Pocket'  => 'patch.png',
    'Satin Chest Pocket'  => 'satin.png',
];

$jacket_vents_Images = [
    'No Vent'     => 'no_vent.png',
    'Single Vent' => 'single_vent.png',
    'Double Vent' => 'double_vent.png',
];

// Image mappings for various pants options
$Pants_Pockets_Images = [
    'Straight' => 'straight.png',
    'Slanted' => 'slanted.png',
];

$Pants_Waist_Strap_Images = [
    'extended' => 'extended.png',
    'regular' => 'regular.png',
];

$Pants_Pleats_Images = [
    'No Pleat' => 'no_pleat.png',
    'Single Pleat' => 'single_pleat.png',
    'Double Pleat' => 'double_pleat.png',
];

$Pants_Back_Pocket_Type_Images = [
    'No Back Pocket' => 'no_back_pocket.png',
    '2 Back Pockets' => 'two_back_pockets.png',
    '1 Left Back Pocket' => 'left_back_pocket.png',
    '1 Right Back Pocket' => 'right_back_pocket.png',
];

$Pants_Back_Pocket_With_Button_Images = [
    'Yes' => 'yes.png',
    'No' => 'no.png',
];

$Pants_Back_Pocket_With_Flap_Images = [
    'Yes' => 'yes.png',
    'No' => 'no.png',
];

$Pants_Cuff_Images = [
  'With Pant Cuff 1.5"'   => 'with_cuff.png',
  'With Pant Cuff (1.5")' => 'with_cuff.png',
  'No Pant Cuff'          => 'no_cuff.png',
];

$Pants_Side_Adjusters_Images = [
    'Side Adjusters with No Belt Loops' => 'no_belt_loops.png',
    'Side Adjusters with Belt Loops' => 'belt_loops.png',
    'No Side Adjusters' => 'no_side_adjusters.png',
];

$Pants_Satin_Tape_Images = [
    'Yes' => 'yes.png',
    'No' => 'no.png',
];

// Assign images dynamically
$Jacket_Type_Image = getImage($Jacket_Type_Images, $selectedItem, 'jacket_type', 'jacket_type');
$Jacket_Construction_Image = getImage($Jacket_Construction_Images, $selectedItem, 'jacket_construction', 'canvas');
$Jacket_LapelType_Image = getImage($Jacket_LapelType_Images, $selectedItem, 'jacket_lapel_type', 'lapel_type');
$Jacket_SatinType_Image = getImage($Jacket_SatinType_Images, $selectedItem, 'jacket_satin_lapel', 'satin_lapel');
$handstitch_Image = getImage($handstitch_Images, $selectedItem, 'jacket_hand_stitch', 'handstitch');
$lapel_width_Image = getImage($lapel_width_Images, $selectedItem, 'jacket_lapel_width', 'lapel_width');
$lapel_functional_button_Image = getImage($lapel_functional_button_Images, $selectedItem, 'jacket_lapel_functional_button', 'lapel_functional_button');
$jacket_sleeve_buttons_Image = getImage($jacket_sleeve_buttons_Images, $selectedItem, 'jacket_sleeve_buttons', 'sleeve_buttons');
$jacket_functional_buttons_Image = getImage($jacket_functional_buttons_Images, $selectedItem, 'jacket_functional_buttons', 'functional_buttons');
$jacket_buttons_colour_on_last_button_hole_Image = getImage($jacket_buttons_colour_on_last_button_hole_Images, $selectedItem, 'jacket_buttons_colour_on_last_button_hole', 'buttons_contrast_colour');
$jacket_lining_Image = getImage($jacket_lining_Images, $selectedItem, 'jacket_lining', 'lining');
$jacket_pockets_Image = getImage($jacket_pockets_Images, $selectedItem, 'jacket_pockets', 'pockets');
$jacket_pockets_with_flap_Image = getImage($jacket_pockets_with_flap_Images, $selectedItem, 'jacket_pockets_with_flap', 'pockets_with_flap');
$jacket_italian_pockets_Image = getImage($jacket_italian_pockets_Images, $selectedItem, 'jacket_italian_pockets', 'italian_pockets');
$jacket_patch_pockets_Image = getImage($jacket_patch_pockets_Images, $selectedItem, 'jacket_patch_pockets', 'patch_pockets');
$jacket_pockets_satin_piping_Image = getImage($jacket_pockets_satin_piping_Images, $selectedItem, 'jacket_pockets_satin_piping', 'pockets_satin_piping');
$jacket_chest_pocket_type_Image = getImage($jacket_chest_pocket_type_Images, $selectedItem, 'jacket_chest_pocket_type', 'chest_pocket');
$jacket_vents_Image = getImage($jacket_vents_Images, $selectedItem, 'jacket_vents', 'vents');
$Pants_Pockets_Image = getImage($Pants_Pockets_Images, $selectedItem, 'pants_pocket', 'pants_pockets');
$Pants_Waist_Strap_Image = getImage($Pants_Waist_Strap_Images, $selectedItem, 'pants_extended_waist_strap', 'waist_strap');
$Pants_Pleats_Image = getImage($Pants_Pleats_Images, $selectedItem, 'pants_pleats', 'pleats');
$Pants_Back_Pocket_Type_Image = getImage($Pants_Back_Pocket_Type_Images, $selectedItem, 'pants_back_pocket_type', 'back_pockets');
$Pants_Back_Pocket_With_Button_Image = getImage($Pants_Back_Pocket_With_Button_Images, $selectedItem, 'pants_back_pocket_with_buttons', 'back_pocket');
$Pants_Back_Pocket_With_Flap_Image = getImage($Pants_Back_Pocket_With_Flap_Images, $selectedItem, 'pants_back_pocket_with_flap', 'back_pocket_with_flap');
$Pants_Cuff_Image = getImage($Pants_Cuff_Images, $selectedItem, 'pants_pant_cuffs', 'pant_cuffs');
$Pants_Side_Adjusters_Image = getImage($Pants_Side_Adjusters_Images, $selectedItem, 'pants_side_adjusters', 'side_adjusters');
$Pants_Satin_Tape_Image = getImage($Pants_Satin_Tape_Images, $selectedItem, 'pants_satin_tape_on_side', 'satin_tape');



@endphp


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight">
            Two Piece (#{{ $selected_twopiece->id }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden  sm:rounded-lg p-6">
                
            <div class="flex justify-end items-center mb-10 space-x-4">
    <h2 class="font-semibold text-m text-gray-800 leading-tight">
        Order Number: (#{{ $orders->order_number }})
    </h2>
    <h2 class="font-semibold text-m text-gray-800 leading-tight">
        Item Number: (#{{ $selected_twopiece->item_number }})
    </h2>
</div>


                
                
<div class="p-4 rounded-xl mt-8 mb-10 flex items-center space-x-4 px-10">
    <!-- Label for the button -->
    <x-input-label for="view_measurements" :value="__('For')" class="text-lg font-semibold text-black" />
    
    <!-- Button to trigger dropdown -->
    <button id="view_measurements" onclick="toggleDropdown()" class="w-full p-4 text-lg font-semibold text-black border-gray-300 bg-white rounded-xl border focus:outline-none focus:ring-2 focus:ring-emerald-500 hover:bg-emerald-700 flex items-center justify-between">
        <span>{{ $measurement->name }}</span>
        <!-- Down Arrow Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-black ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>
</div>

<!-- Dropdown Menu -->
<div id="measurementDropdown" class="hidden mt-2 mb-10 w-1/2 bg-white border border-gray-300 rounded-xl p-6 flex justify-center mx-auto transition-all duration-300 ease-in-out opacity-0 max-h-0 overflow-hidden">
    <table class="w-full max-w-full table-auto p-4">
        <thead>
            <tr>
                <th class="text-left font-bold text-emerald-950 px-2 py-1">Measurement</th>
                <th class="text-left font-bold text-emerald-950 px-2 py-1">Value</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="border-b px-2 py-1">DOB</td>
                <td class="border-b px-2 py-1">{{ $measurement->dob }}</td>
            </tr>
            <tr>
                <td class="border-b px-2 py-1">Gender</td>
                <td class="border-b px-2 py-1">{{ $measurement->gender }}</td>
            </tr>
            <tr>
                <td class="border-b px-2 py-1">Height</td>
                <td class="border-b px-2 py-1">{{ $measurement->height }} cm</td>
            </tr>
            <tr>
                <td class="border-b px-2 py-1">Weight</td>
                <td class="border-b px-2 py-1">{{ $measurement->weight }} kg</td>
            </tr>
            <tr>
                <td class="border-b px-2 py-1">Shoulders</td>
                <td class="border-b px-2 py-1">{{ $measurement->shoulders }} cm</td>
            </tr>
            <tr>
                <td class="border-b px-2 py-1">Sleeve Length</td>
                <td class="border-b px-2 py-1">{{ $measurement->sleeve_length }} cm</td>
            </tr>
            <tr>
                <td class="border-b px-2 py-1">Bicep</td>
                <td class="border-b px-2 py-1">{{ $measurement->bicep }} cm</td>
            </tr>
            <tr>
                <td class="border-b px-2 py-1">Wrist</td>
                <td class="border-b px-2 py-1">{{ $measurement->wrist }} cm</td>
            </tr>
            <tr>
                <td class="border-b px-2 py-1">Chest</td>
                <td class="border-b px-2 py-1">{{ $measurement->chest }} cm</td>
            </tr>
            <tr>
                <td class="border-b px-2 py-1">Belly</td>
                <td class="border-b px-2 py-1">{{ $measurement->belly }} cm</td>
            </tr>
            <tr>
                <td class="border-b px-2 py-1">Waist</td>
                <td class="border-b px-2 py-1">{{ $measurement->waist }} cm</td>
            </tr>
            <tr>
                <td class="border-b px-2 py-1">Hip</td>
                <td class="border-b px-2 py-1">{{ $measurement->hip }} cm</td>
            </tr>
            <tr>
                <td class="border-b px-2 py-1">Thigh</td>
                <td class="border-b px-2 py-1">{{ $measurement->thigh }} cm</td>
            </tr>
            <tr>
                <td class="border-b px-2 py-1">Knee</td>
                <td class="border-b px-2 py-1">{{ $measurement->knee }} cm</td>
            </tr>
            <tr>
                <td class="border-b px-2 py-1">Cuff</td>
                <td class="border-b px-2 py-1">{{ $measurement->cuff }} cm</td>
            </tr>
            <tr>
                <td class="border-b px-2 py-1">Outside Leg Length</td>
                <td class="border-b px-2 py-1">{{ $measurement->outside_leg_length }} cm</td>
            </tr>
            <tr>
                <td class="border-b px-2 py-1">Neck</td>
                <td class="border-b px-2 py-1">{{ $measurement->neck }} cm</td>
            </tr>
            @if($measurement->crotch !== NULL)
<tr>
    <td class="border-b px-2 py-1">Crotch</td>
    <td class="border-b px-2 py-1">{{ $measurement->crotch }} cm</td>
</tr>
@endif

@if($measurement->inside_leg_length !== NULL)
<tr>
    <td class="border-b px-2 py-1">Inside Leg Length</td>
    <td class="border-b px-2 py-1">{{ $measurement->inside_leg_length }} cm</td>
</tr>
@endif

@if($measurement->inside_sleeve_length !== NULL)
<tr>
    <td class="border-b px-2 py-1">Inside Sleeve Length</td>
    <td class="border-b px-2 py-1">{{ $measurement->inside_sleeve_length }} cm</td>
</tr>
@endif

@if($measurement->pants_cuff_width !== NULL)
<tr>
    <td class="border-b px-2 py-1">Pants Cuff Width</td>
    <td class="border-b px-2 py-1">{{ $measurement->pants_cuff_width }} cm</td>
</tr>
@endif

@if($measurement->jacket_length_front !== NULL)
<tr>
    <td class="border-b px-2 py-1">Jacket Length Front</td>
    <td class="border-b px-2 py-1">{{ $measurement->jacket_length_front }} cm</td>
</tr>
@endif

            <tr>
                <td class="border-b px-2 py-1">BS Shoulders</td>
                <td class="border-b px-2 py-1">{{ $measurement->bs_shoulders }}</td>
            </tr>
            <tr>
                <td class="border-b px-2 py-1">BS Chest</td>
                <td class="border-b px-2 py-1">{{ $measurement->bs_chest }}</td>
            </tr>
            <tr>
                <td class="border-b px-2 py-1">BS Stomach</td>
                <td class="border-b px-2 py-1">{{ $measurement->bs_stomach }}</td>
            </tr>
            <tr>
                <td class="border-b px-2 py-1">BS Posture</td>
                <td class="border-b px-2 py-1">{{ $measurement->bs_posture }}</td>
            </tr>
            <tr>
                <td class="border-b px-2 py-1">BS Seat</td>
                <td class="border-b px-2 py-1">{{ $measurement->bs_seat }}</td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Script to toggle dropdown visibility -->
<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('measurementDropdown');

        if (dropdown.classList.contains('hidden')) {
            dropdown.classList.remove('hidden');
            setTimeout(() => {
                dropdown.classList.add('opacity-100', 'max-h-screen');
            }, 10);  // small delay for transition effect
        } else {
            dropdown.classList.remove('opacity-100', 'max-h-screen');
            setTimeout(() => {
                dropdown.classList.add('hidden');
            }, 300);  // delay for transition to finish before hiding
        }
    }
</script>




<!-- JACKET CONSTRUCTION -->

<h2 class="text-3xl font-semibold text-gray-800 leading-tight text-center">
    Jacket Construction
</h2>
<!-- Color Codes Section -->
<div class="bg-emerald-950 grid grid-cols-4 gap-4 place-items-center mx-auto rounded-xl mt-6 mb-6 py-10">

    <!-- Jacket Fabric Color -->
    <div class="flex flex-col items-center">
        <p class="text-m mb-2 text-white">Jacket Fabric</p>
        <div class="w-48 h-36 flex items-center justify-center border border-white bg-white rounded-lg">
        <p class="font-bold text-xl">{{ strtoupper($selected_twopiece->code_jacket) }}</p>

        </div>
    </div>

<!-- Jacket Lining Color -->
@if($selected_twopiece->jacket_lining != 'No Lining')
    <div class="flex flex-col items-center">
        <p class="text-m mb-2 text-white">Jacket Lining</p>
        <div class="w-48 h-36 flex items-center justify-center border border-white bg-white rounded-lg">
        <p class="font-bold text-xl">{{ strtoupper($selected_twopiece->code_jacket_lining) }}</p>

        </div>
    </div>
@endif

    <!-- Jacket Buttons Color -->
    <div class="flex flex-col items-center">
        <p class="text-m mb-2 text-white">Jacket Buttons</p>
        <div class="w-48 h-36 flex items-center justify-center border border-white bg-white rounded-lg">
        <p class="font-bold text-xl">{{ strtoupper($selected_twopiece->code_jacket_button) }}</p>

        </div>
    </div>

  <!-- Satin Lapel Colour -->
@if($selected_twopiece->jacket_satin_lapel != 'No Satin Lapel')
    <div class="flex flex-col items-center">
        <p class="text-m mb-2 text-white">Satin Lapel Colour</p>
        <div class="w-48 h-36 flex items-center justify-center border border-white bg-white rounded-lg">
        <p class="font-bold text-xl">{{ strtoupper($selected_twopiece->code_satin_lapel) }}</p>

        </div>
    </div>
@endif


   <!-- Last Button Hole Colour -->
@if($selected_twopiece->jacket_buttons_colour_on_last_button_hole == 'Yes')
    <div class="flex flex-col items-center col-span-4 sm:col-span-1">
        <p class="text-m mb-2 text-white">Last Button Hole Colour</p>
        <div class="w-48 h-36 flex items-center justify-center border border-white bg-white rounded-lg">
        <p class="font-bold text-xl">{{ strtoupper($selected_twopiece->code_colour_on_last_button_hole) }}</p>

        </div>
    </div>
@endif


</div> <!-- Colour Code Div -->









 <div class="grid grid-cols-4 gap-4 place-items-center mx-auto">

    
<!-- Jacket Type Card -->
<div class=" rounded-lg  flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
        Jacket Type
    </p>
    <!-- Centered Image Container -->
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($Jacket_Type_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->jacket_type }}
        </p>
        <p class="text-center text-sm mt-2 font-bold">
    Jacket Fabric: {{ strtoupper($selected_twopiece->code_jacket) }}
</p>
    </div>
</div>
    
<!-- Jacket Construction Card -->
<div class=" rounded-lg  flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
      Jacket Construction
    </p>
    <!-- Centered Image Container -->
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($Jacket_Construction_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->jacket_construction }}
        </p>
    </div>
</div>

<!-- Jacket Lapel Type Card -->
<div class=" rounded-lg  flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
    Jacket Lapel Type
    </p>
    <!-- Centered Image Container -->
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($Jacket_LapelType_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->jacket_lapel_type }}
        </p>
    </div>
</div>

<!-- Jacket Satin Lapel Type -->
<div class=" rounded-lg  flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
    Jacket Satin Lapel Type
    </p>
    <!-- Centered Image Container -->
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($Jacket_SatinType_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->jacket_satin_lapel }}
        </p>

        @if (!is_null($selected_twopiece->code_satin_lapel))
    <p class="text-center text-sm mt-2 font-bold">
        Satin Code: {{ strtoupper($selected_twopiece->code_satin_lapel) }}
    </p>
@endif

    </div>
</div>

<!-- Jacket Hand Stitch Lapel Type -->
<div class=" rounded-lg  flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
    Lapel Hand Stitch?
    </p>
    <!-- Centered Image Container -->
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($handstitch_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->jacket_hand_stitch }}
        </p>
    </div>
</div>

<!-- Jacket Lapel Width Lapel Type -->
<div class=" rounded-lg  flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
    Jacket Lapel Width
    </p>
    <!-- Centered Image Container -->
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($lapel_width_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->jacket_lapel_width }}
        </p>
    </div>
</div>

<!-- Jacket Lapel Functional Button -->
<div class=" rounded-lg  flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
    Jacket Lapel Functional Button
    </p>
    <!-- Centered Image Container -->
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($lapel_functional_button_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->jacket_lapel_functional_button }}
        </p>
    </div>
</div>

<!-- Jacket Sleeve Buttons -->
<div class="rounded-lg flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
        Jacket Sleeve Buttons
    </p>
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($jacket_sleeve_buttons_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->jacket_sleeve_buttons }}
        </p>

        <p class="text-center text-sm mt-2 font-bold">
        Jacket Button Code: {{ strtoupper($selected_twopiece->code_jacket_button) }}
    </p>
    </div>
</div>

<!-- Jacket Functional Buttons -->
<div class="rounded-lg flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
        Jacket Functional Buttons
    </p>
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($jacket_functional_buttons_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->jacket_functional_buttons }}
        </p>
    </div>
</div>

<!-- Jacket Buttons Colour on Last Button Hole -->
<div class="rounded-lg flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
       Colour on Last Button Hole
    </p>
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($jacket_buttons_colour_on_last_button_hole_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->jacket_buttons_colour_on_last_button_hole }}
        </p>

        @if($selected_twopiece->jacket_buttons_colour_on_last_button_hole == 'Yes')
        <p class="text-center text-sm mt-2 font-bold">
    Colour Code: {{ strtoupper($selected_twopiece->code_colour_on_last_button_hole) }}
</p>

@endif

    </div>
</div>

<!-- Jacket Lining -->
<div class="rounded-lg flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
        Jacket Lining
    </p>
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($jacket_lining_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->jacket_lining }}
        </p>

        @if ($selected_twopiece->code_jacket_lining !== 'No Lining')
    <p class="text-center text-sm mt-2 font-bold">
        Lining Code: {{ strtoupper($selected_twopiece->code_jacket_lining) }}
    </p>
@endif

    </div>
</div>

<!-- Jacket Pockets -->
<div class="rounded-lg flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
        Jacket Pockets
    </p>
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($jacket_pockets_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->jacket_pockets }}
        </p>
    </div>
</div>

<!-- Jacket Pockets with Flap -->
<div class="rounded-lg flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
        Jacket Pockets with Flap
    </p>
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($jacket_pockets_with_flap_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->jacket_pockets_with_flap }}
        </p>
    </div>
</div>

<!-- Jacket Italian Pockets -->
<div class="rounded-lg flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
        Jacket Italian Pockets
    </p>
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($jacket_italian_pockets_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->jacket_italian_pockets }}
        </p>
    </div>
</div>

<!-- Jacket Patch Pockets -->
<div class="rounded-lg flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
        Jacket Patch Pockets
    </p>
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($jacket_patch_pockets_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->jacket_patch_pockets }}
        </p>
    </div>
</div>

<!-- Jacket Pockets Satin Piping -->
<div class="rounded-lg flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
        Jacket Pockets Satin Piping
    </p>
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($jacket_pockets_satin_piping_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->jacket_pockets_satin_piping }}
        </p>
    </div>
</div>

<!-- Jacket Chest Pocket Type -->
<div class="rounded-lg flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
        Jacket Chest Pocket Type
    </p>
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($jacket_chest_pocket_type_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->jacket_chest_pocket_type }}
        </p>
    </div>
</div>

<!-- Jacket Vents -->
<div class="rounded-lg flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
        Jacket Vents
    </p>
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($jacket_vents_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->jacket_vents }}
        </p>
    </div>
</div>

</div><!-- DIV JACKET CONSTRUCTION-->
<!-- END JACKET CONSTRUCTION-->

<!-- START PANTS CONSTRUCTION-->
<h2 class="text-3xl font-semibold text-gray-800 leading-tight text-center mt-20">
    Pants Construction
</h2>

<!-- Color Codes Section -->
<div class="bg-emerald-950 grid grid-cols-2 gap-4 place-items-center mx-auto rounded-xl mt-6 mb-6 py-10">

    <!-- Pants Fabric Color -->
    <div class="flex flex-col items-center">
        <p class="text-m mb-2 text-white">Pants Fabric</p>
        <div class="w-48 h-36 flex items-center justify-center border border-white bg-white rounded-lg">
        <p class="font-bold text-xl">{{ strtoupper($selected_twopiece->code_pants) }}</p>

        </div>
    </div>


    <!-- Pants Buttons Color -->
    <div class="flex flex-col items-center">
        <p class="text-m mb-2 text-white">Pants Buttons</p>
        <div class="w-48 h-36 flex items-center justify-center border border-white bg-white rounded-lg">
        <p class="font-bold text-xl">{{ strtoupper($selected_twopiece->code_pants_button) }}</p>

        </div>
    </div>
</div> <!-- Colour Code Div -->

<div class="grid grid-cols-4 gap-4 place-items-center mx-auto">

<!-- Pants Pockets -->
<div class="rounded-lg flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
        Pants Pockets
    </p>
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($Pants_Pockets_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->pants_pocket }}
        </p>
    </div>
</div>

<!-- Pants Waist Strap -->
<div class="rounded-lg flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
        Pants Waist Strap
    </p>
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($Pants_Waist_Strap_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->pants_extended_waist_strap }}
        </p>
    </div>
</div>

<!-- Pants Pleats -->
<div class="rounded-lg flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
        Pants Pleats
    </p>
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($Pants_Pleats_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->pants_pleats }}
        </p>
    </div>
</div>

<!-- Pants Back Pocket Type -->
<div class="rounded-lg flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
        Pants Back Pocket Type
    </p>
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($Pants_Back_Pocket_Type_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->pants_back_pocket_type }}
        </p>
    </div>
</div>

<!--  Pants Back Pocket with Buttons -->
<div class="rounded-lg flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
    Pants Back Pocket with Buttons
    </p>
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($Pants_Back_Pocket_With_Button_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->pants_back_pocket_with_buttons }}
        </p>
    </div>
</div>

<!--  Pants Back Pocket with Flap -->
<div class="rounded-lg flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
    Pants Back Pocket with Flap
    </p>
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($Pants_Back_Pocket_With_Flap_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->pants_back_pocket_with_flap }}
        </p>
    </div>
</div>

<!-- Pants Cuffs -->
<div class="rounded-lg flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
        Pants Cuff
    </p>
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($Pants_Cuff_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->pants_pant_cuffs }}
        </p>
    </div>
</div>

<!--  Pants Side Adjusters -->
<div class="rounded-lg flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
    Pants Side Adjusters
    </p>
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($Pants_Side_Adjusters_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->pants_side_adjusters }}
        </p>
    </div>
</div>


<!-- Pants Satin Tape -->
<div class="rounded-lg flex flex-col items-center">
    <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
        Pants Satin Tape
    </p>
    <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
        <div class="w-full h-full bg-cover bg-center rounded-lg" 
             style="background-image: url({{ asset($Pants_Satin_Tape_Image) }}); background-size: contain; background-repeat: no-repeat;">
        </div>
        <p class="text-center text-sm mt-2">
            {{ $selected_twopiece->pants_satin_tape_on_side }}
        </p>
    </div>
</div>

</div> <!-- END PANTS CONSTRUCTION -->




<!-- END PANTS CONSTRUCTION-->



    




            </div>
        </div>
    </div>
</x-app-layout>

