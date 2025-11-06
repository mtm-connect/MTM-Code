<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-3xl text-white leading-tight leading-tight">
       Edit 2 Piece
        </h2>
    </x-slot>
    <x-guest-layout>

     <!-- SPACING / MARGINS -->
<div class=" mt-16 mx-40">

<h2 class="font-semibold text-m text-gray-800 leading-tight mb-10 text-center">
            Order Number: (#{{ $orders->order_number }})
        </h2>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
   
    <form method="POST" action="{{ route('two.update', $selected_twopiece->id) }}">
        @csrf
        @method('PUT')

   <!-- Measurement Dropdown with Emerald-950 background -->
<div class="p-4 rounded-xl mt-8">
    <div class="mt-0 flex items-center space-x-4">
        <x-input-label for="measurement_id" :value="__('For')" class="text-lg font-semibold text-black" />
        <select id="measurement_id" name="measurement_id" class="block w-full p-4 border-gray-300 bg-white focus:text-black  focus:font-bold focus:bg-white focus:bg-opacity-10 focus:border-gray-300 rounded-xl focus:ring-white" required>
            <option value="" disabled selected>{{ __('Select Measurement') }}</option>
            @foreach ($measurements as $measurement)
                <option value="{{ $measurement->id }}" {{ old('measurement_id') == $measurement->id || (isset($selectedmeasurement) && $selectedmeasurement->id == $measurement->id) ? 'selected' : ''  }}>
                    {{ $measurement->name }} <!-- Assuming 'name' is a column in the measurements table -->
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('measurement_id')" class="mt-2" />
    </div>
</div>



<br><br>
<h2 class="text-3xl font-semibold text-gray-800 leading-tight text-center">
    Jacket Construction
</h2>


    <!-- Jacket Type Radio Buttons -->
<div class="mt-6 ">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="jacket_type" :value="__('Jacket Type')" />

    <div class="mt-4 grid grid-cols-4 gap-4">
        <!-- Single 1 Button -->
        <label class="inline-flex flex-col items-center cursor-pointer group">
            <input 
                type="radio" 
                name="jacket_type" 
                value="Single 1 Button" 
                class="hidden peer" 
                {{ old('jacket_type', $selected_twopiece->jacket_type ?? '') == 'Single 1 Button' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center relative group">
                <div class="w-full h-full bg-cover bg-center rounded-lg transition-all duration-300 ease-in-out" style="background-image: url({{ asset('images/jacket_type/jacket_type_1.png') }});"></div>
                <p class="text-center text-sm mt-2">Single 1 Button</p>
            </div>
        </label>

        <!-- Single 2 Buttons -->
        <label class="inline-flex flex-col items-center cursor-pointer group">
            <input 
                type="radio" 
                name="jacket_type" 
                value="Single 2 Buttons" 
                class="hidden peer" 
                {{ old('jacket_type', $selected_twopiece->jacket_type ?? '') == 'Single 2 Buttons' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center relative group">
                <div class="w-full h-full bg-cover bg-center rounded-lg transition-all duration-300 ease-in-out" style="background-image: url({{ asset('images/jacket_type/jacket_type_2.png') }});"></div>
                <p class="text-center text-sm mt-2">Single 2 Buttons</p>
            </div>
        </label>

        <!-- Single 3 Buttons -->
        <label class="inline-flex flex-col items-center cursor-pointer group">
            <input 
                type="radio" 
                name="jacket_type" 
                value="Single 3 Buttons" 
                class="hidden peer" 
                {{ old('jacket_type', $selected_twopiece->jacket_type ?? '') == 'Single 3 Buttons' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center relative group">
                <div class="w-full h-full bg-cover bg-center rounded-lg transition-all duration-300 ease-in-out" style="background-image: url({{ asset('images/jacket_type/jacket_type_3.png') }});"></div>
                <p class="text-center text-sm mt-2">Single 3 Buttons</p>
            </div>
        </label>

        <!-- Single 4 Buttons -->
        <label class="inline-flex flex-col items-center cursor-pointer group">
            <input 
                type="radio" 
                name="jacket_type" 
                value="Single 4 Buttons" 
                class="hidden peer" 
                {{ old('jacket_type', $selected_twopiece->jacket_type ?? '') == 'Single 4 Buttons' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center relative group">
                <div class="w-full h-full bg-cover bg-center rounded-lg transition-all duration-300 ease-in-out" style="background-image: url({{ asset('images/jacket_type/jacket_type_4.png') }});"></div>
                <p class="text-center text-sm mt-2">Single 4 Buttons</p>
            </div>
        </label>

        <!-- Double Breast 4 on 1 -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_type" 
                value="Double Breast 4 on 1" 
                class="hidden peer" 
                {{ old('jacket_type', $selected_twopiece->jacket_type ?? '') == 'Double Breast 4 on 1' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url({{ asset('images/jacket_type/jacket_type_9.png') }});"></div>
                <p class="text-center text-sm mt-2">Double Breast 4 on 1</p>
            </div>
        </label>

        <!-- Double Breast 6 on 3 -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_type" 
                value="Double Breast 6 on 3" 
                class="hidden peer" 
                {{ old('jacket_type', $selected_twopiece->jacket_type ?? '') == 'Double Breast 6 on 3' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url({{ asset('images/jacket_type/jacket_type_8.png') }});"></div>
                <p class="text-center text-sm mt-2">Double Breast 6 on 3</p>
            </div>
        </label>

        <!-- 3 Roll 2 -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_type" 
                value="3 Roll 2" 
                class="hidden peer" 
                {{ old('jacket_type', $selected_twopiece->jacket_type ?? '') == '3 Roll 2' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url({{ asset('images/jacket_type/jacket_type_5.png') }});"></div>
                <p class="text-center text-sm mt-2">3 Roll 2</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('jacket_type')" class="mt-2" />
</div>





    
    
<!-- Jacket Construction Radio Buttons -->
<div class="mt-20 border-emerald-950">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="jacket_construction" :value="__('Jacket Construction')" />
    
    <div class="mt-4 grid grid-cols-2 gap-4">
        <!-- Full Canvas -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_construction" 
                value="Full Canvas" 
                class="hidden peer"
                {{ old('jacket_construction', $selected_twopiece->jacket_construction ?? '') == 'Full Canvas' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url({{ asset('images/canvas/full.png') }});">
                    <!-- Image set as background -->
                </div>
                
                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Full Canvas</p>
            </div>
        </label>

        <!-- Half Canvas -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_construction" 
                value="Half Canvas" 
                class="hidden peer"
                {{ old('jacket_construction', $selected_twopiece->jacket_construction ?? '') == 'Half Canvas' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/canvas/half.png') }}');">
                    <!-- Image set as background -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Half Canvas</p>
            </div>
        </label>
    </div>
</div>






<!-- Jacket Lapel Type Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="jacket_lapel_type" :value="__('Jacket Lapel Type')" />

    <div class="mt-4 grid grid-cols-3 gap-4">
        <!-- Notch Lapel -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_lapel_type" 
                value="Notch Lapel" 
                class="hidden peer"
                {{ old('jacket_lapel_type', $selected_twopiece->jacket_lapel_type ?? '') == 'Notch Lapel' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lapel_type/notch.png') }}');">
                    <!-- Image set as background -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Notch Lapel</p>
            </div>
        </label>

        <!-- Peak Lapel -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_lapel_type" 
                value="Peak Lapel" 
                class="hidden peer"
                {{ old('jacket_lapel_type', $selected_twopiece->jacket_lapel_type ?? '') == 'Peak Lapel' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lapel_type/peak.png') }}');">
                    <!-- Image set as background -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Peak Lapel</p>
            </div>
        </label>

        <!-- Shawl Lapel -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_lapel_type" 
                value="Shawl Lapel" 
                class="hidden peer"
                {{ old('jacket_lapel_type', $selected_twopiece->jacket_lapel_type ?? '') == 'Shawl Lapel' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lapel_type/shawl.png') }}');">
                    <!-- Image set as background -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Shawl Lapel</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('jacket_lapel_type')" class="mt-2" />
</div>

<!-- Jacket Satin Lapel Type Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="jacket_satin_lapel" :value="__('Jacket Satin Lapel Type?')" />

    <div class="mt-4 grid grid-cols-3 gap-4">
        <!-- No Satin Lapel -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_satin_lapel" 
                value="No Satin Lapel" 
                class="hidden peer"
                {{ old('jacket_satin_lapel', $selected_twopiece->jacket_satin_lapel ?? '') == 'No Satin Lapel' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/satin_lapel/no_satin.png') }}');">
                    <!-- Image set as background for No Satin Lapel -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">No Satin Lapel</p>
            </div>
        </label>

        <!-- Satin Front Lapel -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_satin_lapel" 
                value="Satin Front Lapel" 
                class="hidden peer"
                {{ old('jacket_satin_lapel', $selected_twopiece->jacket_satin_lapel ?? '') == 'Satin Front Lapel' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/satin_lapel/front_satin.png') }}');">
                    <!-- Image set as background for Satin Front Lapel -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Satin Front Lapel</p>
            </div>
        </label>

        <!-- Satin Front Including Back Collar -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_satin_lapel" 
                value="Satin Front Including Back Collar" 
                class="hidden peer"
                {{ old('jacket_satin_lapel', $selected_twopiece->jacket_satin_lapel ?? '') == 'Satin Front Including Back Collar' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/satin_lapel/front_back_collar_satin.png') }}');">
                    <!-- Image set as background for Satin Front Including Back Collar -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Satin Front Including Back Collar</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('jacket_satin_lapel')" class="mt-2" />
</div>



     <!-- Jacket Hand Stitch Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="jacket_hand_stitch" :value="__('Lapel Hand Stitch?')" />

    <div class="mt-4 grid grid-cols-2 gap-4">
        <!-- Yes Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_hand_stitch" 
                value="Yes" 
                class="hidden peer"
                {{ old('jacket_hand_stitch', $selected_twopiece->jacket_hand_stitch ?? '') == 'Yes' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/handstitch/yes.png') }}');">
                    <!-- Image set as background -->
                </div>

                <p class="text-center text-sm mt-2">Yes</p>
            </div>
        </label>

        <!-- No Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_hand_stitch" 
                value="No" 
                class="hidden peer"
                {{ old('jacket_hand_stitch', $selected_twopiece->jacket_hand_stitch ?? '') == 'No' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/handstitch/no.png') }}');">
                    <!-- Image set as background -->
                </div>

                <p class="text-center text-sm mt-2">No</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('jacket_hand_stitch')" class="mt-2" />
</div>








   <!-- Jacket Lapel Width Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="jacket_lapel_width" :value="__('Jacket Lapel Width')" />

    <div class="mt-4 grid grid-cols-3 gap-4">
        <!-- Thinner Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_lapel_width" 
                value="Thinner" 
                class="hidden peer"
                {{ old('jacket_lapel_width', $selected_twopiece->jacket_lapel_width ?? '') == 'Thinner' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lapel_width/thinner.png') }}');">
                    <!-- Image set as background for Thinner -->
                </div>

                <p class="text-center text-sm mt-2">Thinner</p>
            </div>
        </label>

        <!-- Regular Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_lapel_width" 
                value="Regular" 
                class="hidden peer"
                {{ old('jacket_lapel_width', $selected_twopiece->jacket_lapel_width ?? '') == 'Regular' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lapel_width/regular.png') }}');">
                    <!-- Image set as background for Regular -->
                </div>

                <p class="text-center text-sm mt-2">Regular</p>
            </div>
        </label>

        <!-- Wider Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_lapel_width" 
                value="Wider" 
                class="hidden peer"
                {{ old('jacket_lapel_width', $selected_twopiece->jacket_lapel_width ?? '') == 'Wider' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lapel_width/wider.png') }}');">
                    <!-- Image set as background for Wider -->
                </div>

                <p class="text-center text-sm mt-2">Wider</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('jacket_lapel_width')" class="mt-2" />
</div>


<!-- Jacket Lapel Functional Button Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="jacket_lapel_functional_button" :value="__('Jacket Lapel Functional Button')" />

    <div class="mt-4 grid grid-cols-2 gap-4">
        <!-- Decorative Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_lapel_functional_button" 
                value="Decorative" 
                class="hidden peer"
                {{ old('jacket_lapel_functional_button', $selected_twopiece->jacket_lapel_functional_button ?? '') == 'Decorative' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lapel_functional_button/decorative.png') }}');">
                    <!-- Image set as background for Decorative -->
                </div>

                <p class="text-center text-sm mt-2">Decorative</p>
            </div>
        </label>

        <!-- Functional Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_lapel_functional_button" 
                value="Functional" 
                class="hidden peer"
                {{ old('jacket_lapel_functional_button', $selected_twopiece->jacket_lapel_functional_button ?? '') == 'Functional' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lapel_functional_button/functional.png') }}');">
                    <!-- Image set as background for Functional -->
                </div>

                <p class="text-center text-sm mt-2">Functional</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('jacket_lapel_functional_button')" class="mt-2" />
</div>


<!-- Jacket Sleeve Buttons Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="jacket_sleeve_buttons" :value="__('Jacket Sleeve Buttons')" />

    <div class="mt-4 grid grid-cols-4 gap-4">
        <!-- 2 Sleeve Buttons Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_sleeve_buttons" 
                value="2 Sleeve Buttons" 
                class="hidden peer"
                {{ old('jacket_sleeve_buttons', $selected_twopiece->jacket_sleeve_buttons ?? '') == '2 Sleeve Buttons' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/sleeve_buttons/2_buttons.png') }}');">
                    <!-- Image set as background for 2 Sleeve Buttons -->
                </div>

                <p class="text-center text-sm mt-2">2 Sleeve Buttons</p>
            </div>
        </label>

        <!-- 3 Sleeve Buttons Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_sleeve_buttons" 
                value="3 Sleeve Buttons" 
                class="hidden peer"
                {{ old('jacket_sleeve_buttons', $selected_twopiece->jacket_sleeve_buttons ?? '') == '3 Sleeve Buttons' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/sleeve_buttons/3_buttons.png') }}');">
                    <!-- Image set as background for 3 Sleeve Buttons -->
                </div>

                <p class="text-center text-sm mt-2">3 Sleeve Buttons</p>
            </div>
        </label>

        <!-- 4 Sleeve Buttons Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_sleeve_buttons" 
                value="4 Sleeve Buttons" 
                class="hidden peer"
                {{ old('jacket_sleeve_buttons', $selected_twopiece->jacket_sleeve_buttons ?? '') == '4 Sleeve Buttons' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/sleeve_buttons/4_buttons.png') }}');">
                    <!-- Image set as background for 4 Sleeve Buttons -->
                </div>

                <p class="text-center text-sm mt-2">4 Sleeve Buttons</p>
            </div>
        </label>

        <!-- 5 Sleeve Buttons Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_sleeve_buttons" 
                value="5 Sleeve Buttons" 
                class="hidden peer"
                {{ old('jacket_sleeve_buttons', $selected_twopiece->jacket_sleeve_buttons ?? '') == '5 Sleeve Buttons' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/sleeve_buttons/5_buttons.png') }}');">
                    <!-- Image set as background for 5 Sleeve Buttons -->
                </div>

                <p class="text-center text-sm mt-2">5 Sleeve Buttons</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('jacket_sleeve_buttons')" class="mt-2" />
</div>




<!-- Jacket Functional Buttons Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="jacket_functional_buttons" :value="__('Jacket Sleeve Functional Buttons')" />

    <div class="mt-4 grid grid-cols-2 gap-4">
        <!-- Decorative Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_functional_buttons" 
                value="Decorative" 
                class="hidden peer"
                {{ old('jacket_functional_buttons', $selected_twopiece->jacket_functional_buttons ?? '') == 'Decorative' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/functional_buttons/decorative.png') }}');">
                    <!-- Image set as background for Decorative -->
                </div>

                <p class="text-center text-sm mt-2">Decorative</p>
            </div>
        </label>

        <!-- Functional Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_functional_buttons" 
                value="Functional" 
                class="hidden peer"
                {{ old('jacket_functional_buttons', $selected_twopiece->jacket_functional_buttons ?? '') == 'Functional' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/functional_buttons/functional.png') }}');">
                    <!-- Image set as background for Functional -->
                </div>

                <p class="text-center text-sm mt-2">Functional</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('jacket_functional_buttons')" class="mt-2" />
</div>

<!-- Jacket Buttons Colour on Last Button Hole Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="jacket_buttons_colour_on_last_button_hole" :value="__('Contrast Colour on Last Button Hole?')" />

    <div class="mt-4 grid grid-cols-2 gap-4">
        <!-- Yes Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_buttons_colour_on_last_button_hole" 
                value="Yes" 
                class="hidden peer"
                {{ old('jacket_buttons_colour_on_last_button_hole', $selected_twopiece->jacket_buttons_colour_on_last_button_hole ?? '') == 'Yes' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/buttons_contrast_colour/yes.png') }}');">
                    <!-- Image set as background for Yes -->
                </div>

                <p class="text-center text-sm mt-2">Yes</p>
            </div>
        </label>

        <!-- No Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_buttons_colour_on_last_button_hole" 
                value="No" 
                class="hidden peer"
                {{ old('jacket_buttons_colour_on_last_button_hole', $selected_twopiece->jacket_buttons_colour_on_last_button_hole ?? '') == 'No' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/buttons_contrast_colour/no.png') }}');">
                    <!-- Image set as background for No -->
                </div>

                <p class="text-center text-sm mt-2">No</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('jacket_buttons_colour_on_last_button_hole')" class="mt-2" />
</div>

<!-- Jacket Lining Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="jacket_lining" :value="__('Jacket Lining')" />

    <div class="mt-4 grid grid-cols-3 gap-4">
        <!-- Full Lining Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_lining" 
                value="Full Lining" 
                class="hidden peer"
                {{ old('jacket_lining', $selected_twopiece->jacket_lining ?? '') == 'Full Lining' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lining/full_lining.png') }}');">
                    <!-- Image set as background for Full Lining -->
                </div>

                <p class="text-center text-sm mt-2">Full Lining</p>
            </div>
        </label>

        <!-- Half Lining Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_lining" 
                value="Half Lining" 
                class="hidden peer"
                {{ old('jacket_lining', $selected_twopiece->jacket_lining ?? '') == 'Half Lining' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lining/half_lining.png') }}');">
                    <!-- Image set as background for Half Lining -->
                </div>

                <p class="text-center text-sm mt-2">Half Lining</p>
            </div>
        </label>

        <!-- No Lining Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_lining" 
                value="No Lining" 
                class="hidden peer"
                {{ old('jacket_lining', $selected_twopiece->jacket_lining ?? '') == 'No Lining' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lining/no_lining.png') }}');">
                    <!-- Image set as background for No Lining -->
                </div>

                <p class="text-center text-sm mt-2">No Lining</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('jacket_lining')" class="mt-2" />
</div>


<!-- Jacket Pockets Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="jacket_pockets" :value="__('Jacket Pockets')" />

    <div class="mt-4 grid grid-cols-3 gap-4">
        <!-- No Pockets Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_pockets" 
                value="No Pockets" 
                class="hidden peer"
                {{ old('jacket_pockets', $selected_twopiece->jacket_pockets ?? '') == 'No Pockets' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pockets/no_pockets.png') }}');">
                    <!-- Image set as background for No Pockets -->
                </div>

                <p class="text-center text-sm mt-2">No Pockets</p>
            </div>
        </label>

        <!-- 2 Pockets Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_pockets" 
                value="2 Pockets" 
                class="hidden peer"
                {{ old('jacket_pockets', $selected_twopiece->jacket_pockets ?? '') == '2 Pockets' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pockets/2_pockets.png') }}');">
                    <!-- Image set as background for 2 Pockets -->
                </div>

                <p class="text-center text-sm mt-2">2 Pockets</p>
            </div>
        </label>

        <!-- 3 Pockets Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_pockets" 
                value="3 Pockets" 
                class="hidden peer"
                {{ old('jacket_pockets', $selected_twopiece->jacket_pockets ?? '') == '3 Pockets' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pockets/3_pockets.png') }}');">
                    <!-- Image set as background for 3 Pockets -->
                </div>

                <p class="text-center text-sm mt-2">3 Pockets</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('jacket_pockets')" class="mt-2" />
</div>

<!-- Jacket Pockets with Flap Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="jacket_pockets_with_flap" :value="__('Jacket Pockets with Flap')" />

    <div class="mt-4 grid grid-cols-2 gap-4">
        <!-- Yes Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_pockets_with_flap" 
                value="Yes" 
                class="hidden peer"
                {{ old('jacket_pockets_with_flap', $selected_twopiece->jacket_pockets_with_flap ?? '') == 'Yes' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pockets_with_flap/yes.png') }}');">
                    <!-- Image set as background for Yes -->
                </div>

                <p class="text-center text-sm mt-2">Yes</p>
            </div>
        </label>

        <!-- No Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_pockets_with_flap" 
                value="No" 
                class="hidden peer"
                {{ old('jacket_pockets_with_flap', $selected_twopiece->jacket_pockets_with_flap ?? '') == 'No' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pockets_with_flap/no.png') }}');">
                    <!-- Image set as background for No -->
                </div>

                <p class="text-center text-sm mt-2">No</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('jacket_pockets_with_flap')" class="mt-2" />
</div>

<!-- Jacket Italian Pockets Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="jacket_italian_pockets" :value="__('Jacket Italian Pockets')" />

    <div class="mt-4 grid grid-cols-2 gap-4">
        <!-- Yes Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_italian_pockets" 
                value="Yes" 
                class="hidden peer"
                {{ old('jacket_italian_pockets', $selected_twopiece->jacket_italian_pockets ?? '') == 'Yes' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/italian_pockets/yes.png') }}');">
                    <!-- Image set as background for Yes -->
                </div>

                <p class="text-center text-sm mt-2">Yes</p>
            </div>
        </label>

        <!-- No Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_italian_pockets" 
                value="No" 
                class="hidden peer"
                {{ old('jacket_italian_pockets', $selected_twopiece->jacket_italian_pockets ?? '') == 'No' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/italian_pockets/no.png') }}');">
                    <!-- Image set as background for No -->
                </div>

                <p class="text-center text-sm mt-2">No</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('jacket_italian_pockets')" class="mt-2" />
</div>

<!-- Jacket Patch Pockets Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="jacket_patch_pockets" :value="__('Jacket Patch Pockets')" />

    <div class="mt-4 grid grid-cols-2 gap-4">
        <!-- Yes Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_patch_pockets" 
                value="Yes" 
                class="hidden peer"
                {{ old('jacket_patch_pockets', $selected_twopiece->jacket_patch_pockets ?? '') == 'Yes' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/patch_pockets/yes.png') }}');">
                    <!-- Image set as background for Yes -->
                </div>

                <p class="text-center text-sm mt-2">Yes</p>
            </div>
        </label>

        <!-- No Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_patch_pockets" 
                value="No" 
                class="hidden peer"
                {{ old('jacket_patch_pockets', $selected_twopiece->jacket_patch_pockets ?? '') == 'No' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/patch_pockets/no.png') }}');">
                    <!-- Image set as background for No -->
                </div>

                <p class="text-center text-sm mt-2">No</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('jacket_patch_pockets')" class="mt-2" />
</div>

<!-- Jacket Pockets Satin Piping Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="jacket_pockets_satin_piping" :value="__('Jacket Pockets Satin Piping')" />

    <div class="mt-4 grid grid-cols-2 gap-4">
        <!-- Yes Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_pockets_satin_piping" 
                value="Yes" 
                class="hidden peer"
                {{ old('jacket_pockets_satin_piping', $selected_twopiece->jacket_pockets_satin_piping ?? '') == 'Yes' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pockets_satin_piping/yes.png') }}');">
                    <!-- Image set as background for Yes -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Yes</p>
            </div>
        </label>

        <!-- No Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_pockets_satin_piping" 
                value="No" 
                class="hidden peer"
                {{ old('jacket_pockets_satin_piping', $selected_twopiece->jacket_pockets_satin_piping ?? '') == 'No' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pockets_satin_piping/no.png') }}');">
                    <!-- Image set as background for No -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">No</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('jacket_pockets_satin_piping')" class="mt-2" />
</div>

<!-- Jacket Chest Pocket Type Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="jacket_chest_pocket_type" :value="__('Jacket Chest Pocket Type')" />

    <div class="mt-4 grid grid-cols-3 gap-4">
        <!-- Curved Chest Pocket -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_chest_pocket_type" 
                value="Curved Chest Pocket" 
                class="hidden peer"
                {{ old('jacket_chest_pocket_type', $selected_twopiece->jacket_chest_pocket_type ?? '') == 'Curved Chest Pocket' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/chest_pocket/curved.png') }}');">
                    <!-- Image set as background for Curved Chest Pocket -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Curved Chest Pocket</p>
            </div>
        </label>

        <!-- Patch Chest Pocket -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_chest_pocket_type" 
                value="Patch Chest Pocket" 
                class="hidden peer"
                {{ old('jacket_chest_pocket_type', $selected_twopiece->jacket_chest_pocket_type ?? '') == 'Patch Chest Pocket' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/chest_pocket/patch.png') }}');">
                    <!-- Image set as background for Patch Chest Pocket -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Patch Chest Pocket</p>
            </div>
        </label>

        <!-- Satin Chest Pocket -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_chest_pocket_type" 
                value="Satin Chest Pocket" 
                class="hidden peer"
                {{ old('jacket_chest_pocket_type', $selected_twopiece->jacket_chest_pocket_type ?? '') == 'Satin Chest Pocket' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/chest_pocket/satin.png') }}');">
                    <!-- Image set as background for Satin Chest Pocket -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Satin Chest Pocket</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('jacket_chest_pocket_type')" class="mt-2" />
</div>

<!-- Jacket Vents Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="jacket_vents" :value="__('Jacket Vents')" />

    <div class="mt-4 grid grid-cols-3 gap-4">
        <!-- No Vent Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_vents" 
                value="No Vent" 
                class="hidden peer"
                {{ old('jacket_vents', $selected_twopiece->jacket_vents ?? '') == 'No Vent' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/vents/no_vent.png') }}');">
                    <!-- Image set as background for No Vent -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">No Vent</p>
            </div>
        </label>

        <!-- Single Vent Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_vents" 
                value="Single Vent" 
                class="hidden peer"
                {{ old('jacket_vents', $selected_twopiece->jacket_vents ?? '') == 'Single Vent' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/vents/single_vent.png') }}');">
                    <!-- Image set as background for Single Vent -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Single Vent</p>
            </div>
        </label>

        <!-- Double Vent Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="jacket_vents" 
                value="Double Vent" 
                class="hidden peer"
                {{ old('jacket_vents', $selected_twopiece->jacket_vents ?? '') == 'Double Vent' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/vents/double_vent.png') }}');">
                    <!-- Image set as background for Double Vent -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Double Vent</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('jacket_vents')" class="mt-2" />
</div>

<br><br>

<h2 class="text-3xl font-semibold text-gray-800 leading-tight text-center mt-20">
    Pants Construction
</h2>

<!-- Pants Pocket Radio Buttons -->
<div class="mt-6">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="pants_pocket" :value="__('Pants Pocket')" />

    <div class="mt-4 grid grid-cols-2 gap-4">
        <!-- Straight Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_pocket" 
                value="Straight" 
                class="hidden peer"
                {{ old('pants_pocket', $selected_twopiece->pants_pocket ?? '') == 'Straight' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pants_pockets/straight.png') }}');">
                    <!-- Image set as background for Straight -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Straight</p>
            </div>
        </label>

        <!-- Slanted Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_pocket" 
                value="Slanted" 
                class="hidden peer"
                {{ old('pants_pocket', $selected_twopiece->pants_pocket ?? '') == 'Slanted' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pants_pockets/slanted.png') }}');">
                    <!-- Image set as background for Slanted -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Slanted</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('pants_pocket')" class="mt-2" />
</div>


<!-- Pants Extended Waist Strap Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="pants_extended_waist_strap" :value="__('Pants Waist Strap')" />

    <div class="mt-4 grid grid-cols-2 gap-4">
        <!-- Extended Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_extended_waist_strap" 
                value="extended" 
                class="hidden peer"
                {{ old('pants_extended_waist_strap', $selected_twopiece->pants_extended_waist_strap ?? '') == 'extended' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/waist_strap/extended.png') }}');">
                    <!-- Image set as background for Extended -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Extended</p>
            </div>
        </label>

        <!-- Regular Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_extended_waist_strap" 
                value="regular" 
                class="hidden peer"
                {{ old('pants_extended_waist_strap', $selected_twopiece->pants_extended_waist_strap ?? '') == 'regular' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/waist_strap/regular.png') }}');">
                    <!-- Image set as background for Regular -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Regular</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('pants_extended_waist_strap')" class="mt-2" />
</div>


<!-- Pants Pleats Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="pants_pleats" :value="__('Pants Pleats')" />

    <div class="mt-4 grid grid-cols-3 gap-4">
        <!-- No Pleat Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_pleats" 
                value="No Pleat" 
                class="hidden peer"
                {{ old('pants_pleats', $selected_twopiece->pants_pleats ?? '') == 'No Pleat' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pleats/no_pleat.png') }}');">
                    <!-- Image set as background for No Pleat -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">No Pleat</p>
            </div>
        </label>

        <!-- Single Pleat Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_pleats" 
                value="Single Pleat" 
                class="hidden peer"
                {{ old('pants_pleats', $selected_twopiece->pants_pleats ?? '') == 'Single Pleat' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pleats/single_pleat.png') }}');">
                    <!-- Image set as background for Single Pleat -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Single Pleat</p>
            </div>
        </label>

        <!-- Double Pleat Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_pleats" 
                value="Double Pleat" 
                class="hidden peer"
                {{ old('pants_pleats', $selected_twopiece->pants_pleats ?? '') == 'Double Pleat' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pleats/double_pleat.png') }}');">
                    <!-- Image set as background for Double Pleat -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Double Pleat</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('pants_pleats')" class="mt-2" />
</div>

<!-- Pants Back Pocket Type Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="pants_back_pocket_type" :value="__('Pants Back Pocket Type')" />

    <div class="mt-4 grid grid-cols-4 gap-4">
        <!-- No Back Pocket Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_back_pocket_type" 
                value="No Back Pocket" 
                class="hidden peer"
                {{ old('pants_back_pocket_type', $selected_twopiece->pants_back_pocket_type ?? '') == 'No Back Pocket' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/back_pockets/no_back_pocket.png') }}');">
                    <!-- Image set as background for No Back Pocket -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">No Back Pocket</p>
            </div>
        </label>

        <!-- 2 Back Pockets Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_back_pocket_type" 
                value="2 Back Pockets" 
                class="hidden peer"
                {{ old('pants_back_pocket_type', $selected_twopiece->pants_back_pocket_type ?? '') == '2 Back Pockets' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/back_pockets/two_back_pockets.png') }}');">
                    <!-- Image set as background for 2 Back Pockets -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">2 Back Pockets</p>
            </div>
        </label>

        <!-- 1 Left Back Pocket Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_back_pocket_type" 
                value="1 Left Back Pocket" 
                class="hidden peer"
                {{ old('pants_back_pocket_type', $selected_twopiece->pants_back_pocket_type ?? '') == '1 Left Back Pocket' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/back_pockets/left_back_pocket.png') }}');">
                    <!-- Image set as background for 1 Left Back Pocket -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">1 Left Back Pocket</p>
            </div>
        </label>

        <!-- 1 Right Back Pocket Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_back_pocket_type" 
                value="1 Right Back Pocket" 
                class="hidden peer"
                {{ old('pants_back_pocket_type', $selected_twopiece->pants_back_pocket_type ?? '') == '1 Right Back Pocket' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/back_pockets/right_back_pocket.png') }}');">
                    <!-- Image set as background for 1 Right Back Pocket -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">1 Right Back Pocket</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('pants_back_pocket_type')" class="mt-2" />
</div>

<!-- Pants Back Pocket with Buttons Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="pants_back_pocket_with_buttons" :value="__('Pants Back Pocket with Buttons')" />

    <div class="mt-4 grid grid-cols-2 gap-4">
        <!-- Yes Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_back_pocket_with_buttons" 
                value="Yes" 
                class="hidden peer"
                {{ old('pants_back_pocket_with_buttons', $selected_twopiece->pants_back_pocket_with_buttons ?? '') == 'Yes' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/back_pocket/yes.png') }}');">
                    <!-- Image set as background for Yes -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Yes</p>
            </div>
        </label>

        <!-- No Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_back_pocket_with_buttons" 
                value="No" 
                class="hidden peer"
                {{ old('pants_back_pocket_with_buttons', $selected_twopiece->pants_back_pocket_with_buttons ?? '') == 'No' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/back_pocket/no.png') }}');">
                    <!-- Image set as background for No -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">No</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('pants_back_pocket_with_buttons')" class="mt-2" />
</div>


<!-- Pants Back Pocket with Flap Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="pants_back_pocket_with_flap" :value="__('Pants Back Pocket with Flap')" />

    <div class="mt-4 grid grid-cols-2 gap-4">
        <!-- Yes Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_back_pocket_with_flap" 
                value="Yes" 
                class="hidden peer"
                {{ old('pants_back_pocket_with_flap', $selected_twopiece->pants_back_pocket_with_flap ?? '') == 'Yes' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/back_pocket_with_flap/yes.png') }}');">
                    <!-- Image set as background for Yes -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Yes</p>
            </div>
        </label>

        <!-- No Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_back_pocket_with_flap" 
                value="No" 
                class="hidden peer"
                {{ old('pants_back_pocket_with_flap', $selected_twopiece->pants_back_pocket_with_flap ?? '') == 'No' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/back_pocket_with_flap/no.png') }}');">
                    <!-- Image set as background for No -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">No</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('pants_back_pocket_with_flap')" class="mt-2" />
</div>

<!-- Pants Pant Cuffs Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="pants_pant_cuffs" :value="__('Pants Pant Cuffs')" />

    <div class="mt-4 grid grid-cols-2 gap-4">
        <!-- With Pant Cuff Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_pant_cuffs" 
                value="With Pant Cuff (1.5&quot;)"
                class="hidden peer"
                {{ old('pants_pant_cuffs', $selected_twopiece->pants_pant_cuffs ?? '') == 'With Pant Cuff (1.5&quot;)' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pant_cuffs/with_cuff.png') }}');">
                    <!-- Image set as background for With Pant Cuff -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">With Pant Cuff (1.5&quot;)</p>
            </div>
        </label>

        <!-- No Pant Cuff Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_pant_cuffs" 
                value="No Pant Cuff" 
                class="hidden peer"
                {{ old('pants_pant_cuffs', $selected_twopiece->pants_pant_cuffs ?? '') == 'No Pant Cuff' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pant_cuffs/no_cuff.png') }}');">
                    <!-- Image set as background for No Pant Cuff -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">No Pant Cuff</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('pants_pant_cuffs')" class="mt-2" />
</div>




<!-- Pants Side Adjusters Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="pants_side_adjusters" :value="__('Pants Side Adjusters')" />

    <div class="mt-4 grid grid-cols-3 gap-4">
        <!-- Side Adjusters with No Belt Looks Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_side_adjusters" 
                value="Side Adjusters with No Belt Loops" 
                class="hidden peer"
                {{ old('pants_side_adjusters', $selected_twopiece->pants_side_adjusters ?? '') == 'Side Adjusters with No Belt Loops' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/side_adjusters/no_belt_loops.png') }}');">
                    <!-- Image set as background for Side Adjusters with No Belt Looks -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Side Adjusters with No Belt Loops</p>
            </div>
        </label>

        

        <!-- Side Adjusters with Belt Looks Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_side_adjusters" 
                value="Side Adjusters with Belt Loops" 
                class="hidden peer"
                {{ old('pants_side_adjusters', $selected_twopiece->pants_side_adjusters ?? '') == 'Side Adjusters with Belt Loops' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/side_adjusters/belt_loops.png') }}');">
                    <!-- Image set as background for Side Adjusters with Belt Looks -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Side Adjusters with Belt Loops</p>
            </div>
        </label>

        <!-- No Side Adjusters Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_side_adjusters" 
                value="No Side Adjusters" 
                class="hidden peer"
                {{ old('pants_side_adjusters', $selected_twopiece->pants_side_adjusters ?? '') == 'No Side Adjusters' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/side_adjusters/no_side_adjusters.png') }}');">
                    <!-- Image set as background for No Side Adjusters -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">No Side Adjusters</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('pants_side_adjusters')" class="mt-2" />
</div>


<!-- Pants Satin Tape on Side Radio Buttons -->
<div class="mt-20">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="pants_satin_tape_on_side" :value="__('Pants Satin Tape on Side')" />

    <div class="mt-4 grid grid-cols-2 gap-4">
        <!-- Yes Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_satin_tape_on_side" 
                value="Yes" 
                class="hidden peer"
                {{ old('pants_satin_tape_on_side', $selected_twopiece->pants_satin_tape_on_side ?? '') == 'Yes' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/satin_tape/yes.png') }}');">
                    <!-- Image set as background for Yes -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">Yes</p>
            </div>
        </label>

        <!-- No Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_satin_tape_on_side" 
                value="No" 
                class="hidden peer"
                {{ old('pants_satin_tape_on_side', $selected_twopiece->pants_satin_tape_on_side ?? '') == 'No' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/satin_tape/no.png') }}');">
                    <!-- Image set as background for No -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">No</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('pants_satin_tape_on_side')" class="mt-2" />
</div>











<br><br>
<h2 class="text-3xl font-semibold text-gray-800 leading-tight text-center mt-20">
Fabric / Button Codes
</h2>
   
<br><br>
<!-- Code Jacket -->
<div class="mt-2">
    <x-input-label for="code_jacket" :value="__('Code Jacket')" />
    <x-text-input 
        id="code_jacket" 
        class="block mt-1 w-full uppercase" 
        type="text" 
        name="code_jacket" 
        :value="old('code_jacket', $selected_twopiece->code_jacket ?? '')" 
        required 
        autocomplete="code_jacket" 
        pattern="[A-Za-z0-9]+" 
        title="Only letters and numbers are allowed"
    />
    <x-input-error :messages="$errors->get('code_jacket')" class="mt-2" />
</div>


<!-- Code Jacket Lining -->
<div class="mt-2">
    <x-input-label for="code_jacket_lining" :value="__('Code Jacket Lining')" />
    <x-text-input 
        id="code_jacket_lining" 
        class="block mt-1 w-full uppercase" 
        type="text" 
        name="code_jacket_lining" 
        :value="old('code_jacket_lining', $selected_twopiece->code_jacket_lining ?? '')" 
        required 
        autocomplete="code_jacket_lining" 
        pattern="[A-Za-z0-9]+" 
        title="Only letters and numbers are allowed"
    />
    <x-input-error :messages="$errors->get('code_jacket_lining')" class="mt-2" />
</div>

<!-- Code Jacket Button -->
<div class="mt-2">
    <x-input-label for="code_jacket_button" :value="__('Code Jacket Button')" />
    <x-text-input 
        id="code_jacket_button" 
        class="block mt-1 w-full uppercase" 
        type="text" 
        name="code_jacket_button" 
        :value="old('code_jacket_button', $selected_twopiece->code_jacket_button ?? '')" 
        required 
        autocomplete="code_jacket_button" 
        pattern="[A-Za-z0-9]+" 
        title="Only letters and numbers are allowed"
    />
    <x-input-error :messages="$errors->get('code_jacket_button')" class="mt-2" />
</div>

<br><br>

<!-- Code Satin Lapel -->
<div class="mt-2">
    <x-input-label for="code_satin_lapel" :value="__('Code Satin Lapel')" />
    <x-text-input 
        id="code_satin_lapel" 
        class="block mt-1 w-full uppercase" 
        type="text" 
        name="code_satin_lapel" 
        :value="old('code_satin_lapel', $selected_twopiece->code_satin_lapel ?? '')" 
        autocomplete="code_satin_lapel" 
        pattern="[A-Za-z0-9]+" 
        title="Only letters and numbers are allowed"
    />
    <p class="text-xs text-gray-500 mt-1">This is only needed if satin elements have been selected.</p>
    <x-input-error :messages="$errors->get('code_satin_lapel')" class="mt-2" />
</div>

<!-- Code Colour on Last Button Hole -->
<div class="mt-2">
    <x-input-label for="code_colour_on_last_button_hole" :value="__('Code Colour on Last Button Hole')" />
    <x-text-input 
        id="code_colour_on_last_button_hole" 
        class="block mt-1 w-full uppercase" 
        type="text" 
        name="code_colour_on_last_button_hole" 
        :value="old('code_colour_on_last_button_hole', $selected_twopiece->code_colour_on_last_button_hole ?? '')" 
        autocomplete="code_colour_on_last_button_hole" 
        pattern="[A-Za-z0-9]+" 
        title="Only letters and numbers are allowed"
    />
    <p class="text-xs text-gray-500 mt-1">This is only needed if contrast colour on last button hole has been selected.</p>
    <x-input-error :messages="$errors->get('code_colour_on_last_button_hole')" class="mt-2" />
</div>

<br><br>

<!-- Code Pants -->
<div class="mt-2">
    <x-input-label for="code_pants" :value="__('Code Pants')" />
    <x-text-input 
        id="code_pants" 
        class="block mt-1 w-full uppercase" 
        type="text" 
        name="code_pants" 
        :value="old('code_pants', $selected_twopiece->code_pants ?? '')" 
        required 
        autocomplete="code_pants" 
        pattern="[A-Za-z0-9]+" 
        title="Only letters and numbers are allowed"
    />
    <x-input-error :messages="$errors->get('code_pants')" class="mt-2" />
</div>

<!-- Code Pants Button -->
<div class="mt-2">
    <x-input-label for="code_pants_button" :value="__('Code Pants Button')" />
    <x-text-input 
        id="code_pants_button" 
        class="block mt-1 w-full uppercase" 
        type="text" 
        name="code_pants_button" 
        :value="old('code_pants_button', $selected_twopiece->code_pants_button ?? '')" 
        required 
        autocomplete="code_pants_button" 
        pattern="[A-Za-z0-9]+" 
        title="Only letters and numbers are allowed"
    />
    <x-input-error :messages="$errors->get('code_pants_button')" class="mt-2" />
</div>


<div class="mt-20 flex justify-end">
    <x-primary-button class="ms-4">
        {{ __('Update 2 Piece') }}
    </x-primary-button>
</div>
<br><br>
</div>
    </form>
    </div>
    
</x-guest-layout>
</x-app-layout>