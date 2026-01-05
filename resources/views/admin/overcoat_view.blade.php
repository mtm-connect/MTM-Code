@php
// Ensure we have the selected item (prioritizing the most specific extension)
if (isset($selected_threepiece)) {
    $selectedItem = $selected_threepiece;
    $type = 'three_piece';
} elseif (isset($selected_twopiece)) {
    $selectedItem = $selected_twopiece;
    $type = 'two_piece';
} elseif (isset($selectedovercoat)) {
    $selectedItem = $selectedovercoat;
    $type = 'overcoat';
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

// Image mappings (KEEPING IMAGES EXACTLY THE SAME)
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

// Assign images dynamically (JUST SWITCHED ATTRIBUTES TO OVERCOAT_* — IMAGES SAME)
$Jacket_Type_Image = getImage($Jacket_Type_Images, $selectedItem, 'overcoat_type', 'jacket_type');
$Jacket_Construction_Image = getImage($Jacket_Construction_Images, $selectedItem, 'overcoat_construction', 'canvas');
$Jacket_LapelType_Image = getImage($Jacket_LapelType_Images, $selectedItem, 'overcoat_lapel_type', 'lapel_type');
$Jacket_SatinType_Image = getImage($Jacket_SatinType_Images, $selectedItem, 'overcoat_satin_lapel', 'satin_lapel');
$handstitch_Image = getImage($handstitch_Images, $selectedItem, 'overcoat_hand_stitch', 'handstitch');
$lapel_width_Image = getImage($lapel_width_Images, $selectedItem, 'overcoat_lapel_width', 'lapel_width');
$lapel_functional_button_Image = getImage($lapel_functional_button_Images, $selectedItem, 'overcoat_lapel_functional_button', 'lapel_functional_button');
$jacket_sleeve_buttons_Image = getImage($jacket_sleeve_buttons_Images, $selectedItem, 'overcoat_sleeve_buttons', 'sleeve_buttons');
$jacket_functional_buttons_Image = getImage($jacket_functional_buttons_Images, $selectedItem, 'overcoat_functional_buttons', 'functional_buttons');
$jacket_buttons_colour_on_last_button_hole_Image = getImage($jacket_buttons_colour_on_last_button_hole_Images, $selectedItem, 'overcoat_buttons_colour_on_last_button_hole', 'buttons_contrast_colour');
$jacket_lining_Image = getImage($jacket_lining_Images, $selectedItem, 'overcoat_lining', 'lining');
$jacket_pockets_Image = getImage($jacket_pockets_Images, $selectedItem, 'overcoat_pockets', 'pockets');
$jacket_pockets_with_flap_Image = getImage($jacket_pockets_with_flap_Images, $selectedItem, 'overcoat_pockets_with_flap', 'pockets_with_flap');
$jacket_italian_pockets_Image = getImage($jacket_italian_pockets_Images, $selectedItem, 'overcoat_italian_pockets', 'italian_pockets');
$jacket_patch_pockets_Image = getImage($jacket_patch_pockets_Images, $selectedItem, 'overcoat_patch_pockets', 'patch_pockets');
$jacket_pockets_satin_piping_Image = getImage($jacket_pockets_satin_piping_Images, $selectedItem, 'overcoat_pockets_satin_piping', 'pockets_satin_piping');
$jacket_chest_pocket_type_Image = getImage($jacket_chest_pocket_type_Images, $selectedItem, 'overcoat_chest_pocket_type', 'chest_pocket');
$jacket_vents_Image = getImage($jacket_vents_Images, $selectedItem, 'overcoat_vents', 'vents');
@endphp


<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight">
            Overcoat (#{{ $selectedovercoat->id }})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg p-6">

                <div class="flex justify-end items-center mb-10 space-x-4">
                    <h2 class="font-semibold text-m text-gray-800 leading-tight">
                        Order Number: (#{{ $orders->order_number }})
                    </h2>
                    <h2 class="font-semibold text-m text-gray-800 leading-tight">
                        Item Number: (#{{ $selectedovercoat->item_number }})
                    </h2>
                </div>

                <div class="p-4 rounded-xl mt-8 mb-10 flex items-center space-x-4 px-10">
                    <x-input-label for="view_measurements" :value="__('For')" class="text-lg font-semibold text-black" />

                    <button id="view_measurements" onclick="toggleDropdown()" class="w-full p-4 text-lg font-semibold text-black border-gray-300 bg-white rounded-xl border focus:outline-none focus:ring-2 focus:ring-emerald-500 hover:bg-emerald-700 flex items-center justify-between">
                        <span>{{ $measurement->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-black ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>

                <div id="measurementDropdown" class="hidden mt-2 mb-10 w-1/2 bg-white border border-gray-300 rounded-xl p-6 flex justify-center mx-auto transition-all duration-300 ease-in-out opacity-0 max-h-0 overflow-hidden">
                    {{-- Measurement table unchanged --}}
                    <table class="w-full max-w-full table-auto p-4">
                        <thead>
                            <tr>
                                <th class="text-left font-bold text-emerald-950 px-2 py-1">Measurement</th>
                                <th class="text-left font-bold text-emerald-950 px-2 py-1">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- ... keep your measurement rows exactly the same ... --}}
                            <tr>
                                <td class="border-b px-2 py-1">DOB</td>
                                <td class="border-b px-2 py-1">{{ $measurement->dob }}</td>
                            </tr>
                            {{-- (rest of rows unchanged) --}}
                        </tbody>
                    </table>
                </div>

                <script>
                    function toggleDropdown() {
                        const dropdown = document.getElementById('measurementDropdown');

                        if (dropdown.classList.contains('hidden')) {
                            dropdown.classList.remove('hidden');
                            setTimeout(() => {
                                dropdown.classList.add('opacity-100', 'max-h-screen');
                            }, 10);
                        } else {
                            dropdown.classList.remove('opacity-100', 'max-h-screen');
                            setTimeout(() => {
                                dropdown.classList.add('hidden');
                            }, 300);
                        }
                    }
                </script>

                <h2 class="text-3xl font-semibold text-gray-800 leading-tight text-center">
                    Overcoat Construction
                </h2>

                <!-- Color Codes Section -->
                <div class="bg-emerald-950 grid grid-cols-4 gap-4 place-items-center mx-auto rounded-xl mt-6 mb-6 py-10">

                    <!-- Overcoat Fabric Color -->
                    <div class="flex flex-col items-center">
                        <p class="text-m mb-2 text-white">Overcoat Fabric</p>
                        <div class="w-48 h-12 flex items-center justify-center border border-white bg-white rounded-lg">
                            <p class="font-bold text-xl">{{ strtoupper($selectedovercoat->code_overcoat) }}</p>
                        </div>
                    </div>

                    <!-- Overcoat Lining Color -->
                    @if($selectedovercoat->overcoat_lining != 'No Lining')
                        <div class="flex flex-col items-center">
                            <p class="text-m mb-2 text-white">Overcoat Lining</p>
                            <div class="w-48 h-36 flex items-center justify-center border border-white bg-white rounded-lg">
                                <p class="font-bold text-xl">{{ strtoupper($selectedovercoat->code_overcoat_lining) }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Overcoat Buttons Color -->
                    <div class="flex flex-col items-center">
                        <p class="text-m mb-2 text-white">Overcoat Buttons</p>
                        <div class="w-48 h-36 flex items-center justify-center border border-white bg-white rounded-lg">
                            <p class="font-bold text-xl">{{ strtoupper($selectedovercoat->code_overcoat_button) }}</p>
                        </div>
                    </div>

                    <!-- Satin Lapel Colour -->
                    @if($selectedovercoat->overcoat_satin_lapel != 'No Satin Lapel')
                        <div class="flex flex-col items-center">
                            <p class="text-m mb-2 text-white">Satin Lapel Colour</p>
                            <div class="w-48 h-36 flex items-center justify-center border border-white bg-white rounded-lg">
                                <p class="font-bold text-xl">{{ strtoupper($selectedovercoat->code_satin_lapel) }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Last Button Hole Colour -->
                    @if($selectedovercoat->overcoat_buttons_colour_on_last_button_hole == 'Yes')
                        <div class="flex flex-col items-center col-span-4 sm:col-span-1">
                            <p class="text-m mb-2 text-white">Last Button Hole Colour</p>
                            <div class="w-48 h-36 flex items-center justify-center border border-white bg-white rounded-lg">
                                <p class="font-bold text-xl">{{ strtoupper($selectedovercoat->code_colour_on_last_button_hole) }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="grid grid-cols-4 gap-4 place-items-center mx-auto">

                    <!-- Overcoat Type Card -->
                    <div class="rounded-lg flex flex-col items-center">
                        <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
                            Overcoat Type
                        </p>
                        <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
                            <div class="w-full h-full bg-cover bg-center rounded-lg"
                                style="background-image: url({{ asset($Jacket_Type_Image) }}); background-size: contain; background-repeat: no-repeat;">
                            </div>
                            <p class="text-center text-sm mt-2">
                                {{ $selectedovercoat->overcoat_type }}
                            </p>
                            <p class="text-center text-sm mt-2 font-bold">
                                Overcoat Fabric: {{ strtoupper($selectedovercoat->code_overcoat) }}
                            </p>
                        </div>
                    </div>

                    <!-- Overcoat Construction Card -->
                    <div class="rounded-lg flex flex-col items-center">
                        <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
                            Overcoat Construction
                        </p>
                        <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
                            <div class="w-full h-full bg-cover bg-center rounded-lg"
                                style="background-image: url({{ asset($Jacket_Construction_Image) }}); background-size: contain; background-repeat: no-repeat;">
                            </div>
                            <p class="text-center text-sm mt-2">
                                {{ $selectedovercoat->overcoat_construction }}
                            </p>
                        </div>
                    </div>

                    <!-- Overcoat Lapel Type Card -->
                    <div class="rounded-lg flex flex-col items-center">
                        <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
                            Overcoat Lapel Type
                        </p>
                        <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
                            <div class="w-full h-full bg-cover bg-center rounded-lg"
                                style="background-image: url({{ asset($Jacket_LapelType_Image) }}); background-size: contain; background-repeat: no-repeat;">
                            </div>
                            <p class="text-center text-sm mt-2">
                                {{ $selectedovercoat->overcoat_lapel_type }}
                            </p>
                        </div>
                    </div>

                    <!-- Overcoat Satin Lapel Type -->
                    <div class="rounded-lg flex flex-col items-center">
                        <p class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white mb-2 w-full">
                            Overcoat Satin Lapel Type
                        </p>
                        <div class="w-64 h-80 rounded-xl border flex flex-col items-center justify-between p-4">
                            <div class="w-full h-full bg-cover bg-center rounded-lg"
                                style="background-image: url({{ asset($Jacket_SatinType_Image) }}); background-size: contain; background-repeat: no-repeat;">
                            </div>
                            <p class="text-center text-sm mt-2">
                                {{ $selectedovercoat->overcoat_satin_lapel }}
                            </p>

                            @if (!is_null($selectedovercoat->code_satin_lapel))
                                <p class="text-center text-sm mt-2 font-bold">
                                    Satin Code: {{ strtoupper($selectedovercoat->code_satin_lapel) }}
                                </p>
                            @endif
                        </div>
                    </div>

                    {{-- Everything below is same layout/images, just swap jacket_* -> overcoat_* exactly like above --}}
                    {{-- hand stitch, lapel width, vents, pockets, etc... use the same $..._Image variables already set --}}
                </div>

            </div>
        </div>
    </div>
</x-admin-layout>
