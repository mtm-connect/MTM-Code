<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-3xl text-white leading-tight leading-tight">
       Create Pants
        </h2>
    </x-slot>

 


    <!-- SPACING / MARGINS -->
<div class=" mt-16 mx-40">

<h2 class="font-semibold text-m text-gray-800 leading-tight mb-10 text-center">
            Order Number: (#{{ $orders->id }})
        </h2>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
   
    <form method="POST" action="">
        @csrf
<!-- Measurement Dropdown with Emerald-950 background -->
<div class="p-4 rounded-xl mt-8">
    <div class="mt-0 flex items-center space-x-4">
        <x-input-label for="measurement_id" :value="__('For')" class="text-lg font-semibold text-black" />
        <select id="measurement_id" name="measurement_id" class="block mt-3 w-full p-4 border border-gray-300 bg-gray-300 bg-opacity-10
           focus:font-bold focus:bg-emerald-950 focus:bg-opacity-10
           focus:border-emerald-950 rounded-lg focus:ring-emerald-950" required>
            <option value="" disabled selected>{{ __('Select Measurement') }}</option>
            @foreach ($measurements as $measurement)
                <option value="{{ $measurement->id }}" {{ old('measurement_id') == $measurement->id ? 'selected' : '' }}>
                    {{ $measurement->name }} <!-- Assuming 'name' is a column in the measurements table -->
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('measurement_id')" class="mt-2" />
    </div>
</div>






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
                {{ old('pants_pocket') == 'Straight' ? 'checked' : '' }}>

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
                {{ old('pants_pocket') == 'Slanted' ? 'checked' : '' }}>

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
                {{ old('pants_extended_waist_strap') == 'extended' ? 'checked' : '' }}>

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
                {{ old('pants_extended_waist_strap') == 'regular' ? 'checked' : '' }}>

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
                {{ old('pants_pleats') == 'No Pleat' ? 'checked' : '' }}>

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
                {{ old('pants_pleats') == 'Single Pleat' ? 'checked' : '' }}>

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
                {{ old('pants_pleats') == 'Double Pleat' ? 'checked' : '' }}>

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
                {{ old('pants_back_pocket_type') == 'No Back Pocket' ? 'checked' : '' }}>

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
                {{ old('pants_back_pocket_type') == '2 Back Pockets' ? 'checked' : '' }}>

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
                {{ old('pants_back_pocket_type') == '1 Left Back Pocket' ? 'checked' : '' }}>

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
                {{ old('pants_back_pocket_type') == '1 Right Back Pocket' ? 'checked' : '' }}>

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
                {{ old('pants_back_pocket_with_buttons') == 'Yes' ? 'checked' : '' }}>

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
                {{ old('pants_back_pocket_with_buttons') == 'No' ? 'checked' : '' }}>

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
                {{ old('pants_back_pocket_with_flap') == 'Yes' ? 'checked' : '' }}>

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
                {{ old('pants_back_pocket_with_flap') == 'No' ? 'checked' : '' }}>

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
                value="With Pant Cuff 1.5""
                class="hidden peer"
                {{ old('pants_pant_cuffs') == 'With Pant Cuff (1.5")' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pant_cuffs/with_cuff.png') }}');">
                    <!-- Image set as background for With Pant Cuff -->
                </div>

                <!-- Text under the image -->
                <p class="text-center text-sm mt-2">With Pant Cuff (1.5")</p>
            </div>
        </label>

        <!-- No Pant Cuff Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pants_pant_cuffs" 
                value="No Pant Cuff" 
                class="hidden peer"
                {{ old('pants_pant_cuffs') == 'No Pant Cuff' ? 'checked' : '' }}>

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
                {{ old('pants_side_adjusters') == 'Side Adjusters with No Belt Loops' ? 'checked' : '' }}>

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
                {{ old('pants_side_adjusters') == 'Side Adjusters with Belt Loops' ? 'checked' : '' }}>

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
                {{ old('pants_side_adjusters') == 'No Side Adjusters' ? 'checked' : '' }}>

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
                {{ old('pants_satin_tape_on_side') == 'Yes' ? 'checked' : '' }}>

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
                {{ old('pants_satin_tape_on_side') == 'No' ? 'checked' : '' }}>

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



<!-- Code Pants -->
<div class="mt-2">
    <x-input-label for="code_pants" :value="__('Code Pants')" />
    <x-text-input 
        id="code_pants" 
        class="block mt-1 w-full uppercase" 
        type="text" 
        name="code_pants" 
        :value="old('code_pants')" 
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
        :value="old('code_pants_button')" 
        required 
        autocomplete="code_pants_button" 
        pattern="[A-Za-z0-9]+" 
        title="Only letters and numbers are allowed"
    />
    <x-input-error :messages="$errors->get('code_pants_button')" class="mt-2" />
</div>




<div class="mt-20 flex justify-end">
    <x-primary-button class="ms-4">
        {{ __('Create 2 Piece') }}
    </x-primary-button>
</div>

        <br><br>
</div>
    </form>

    </div>




</x-app-layout>





