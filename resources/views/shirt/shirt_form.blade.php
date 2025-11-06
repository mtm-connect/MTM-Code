<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-3xl text-white leading-tight leading-tight">
       Create Shirt
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
   
    <form method="POST" action="">
        @csrf
    
<!-- Measurement Dropdown with Emerald-950 background -->
<div class="p-4 rounded-xl mt-8">
    <div class="mt-0 flex items-center space-x-4">
        <x-input-label for="measurement_id" :value="__('For')" class="text-lg font-semibold text-black" />
        <select id="measurement_id" name="measurement_id" class="block w-full p-4 border-gray-300 bg-white focus:text-black  focus:font-bold focus:bg-white focus:bg-opacity-10 focus:border-gray-300 rounded-xl focus:ring-white" required>
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

<br><br>
<h2 class="text-3xl font-semibold text-gray-800 leading-tight text-center">
    Shirt Construction
</h2>

     
<!-- Collar Radio Buttons -->
<div class="mt-6 border-emerald-950">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="collar" :value="__('Collar')" />
    
    <div class="mt-4 grid grid-cols-4 gap-4">
        <!-- Classic -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="collar" 
                value="Classic" 
                class="hidden peer"
                {{ old('collar') == 'Classic' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collars/classic.png') }}');">
                    <!-- Image set as background for Classic -->
                </div>

                <p class="text-center text-sm mt-2">Classic</p>
            </div>
        </label>

        <!-- Cutaway -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="collar" 
                value="Cutaway" 
                class="hidden peer"
                {{ old('collar') == 'Cutaway' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collars/cutaway.png') }}');">
                    <!-- Image set as background for Cutaway -->
                </div>

                <p class="text-center text-sm mt-2">Cutaway</p>
            </div>
        </label>

        <!-- Italian Spread -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="collar" 
                value="Italian Spread" 
                class="hidden peer"
                {{ old('collar') == 'Italian Spread' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collars/italian-spread.png') }}');">
                    <!-- Image set as background for Italian Spread -->
                </div>

                <p class="text-center text-sm mt-2">Italian Spread</p>
            </div>
        </label>

        <!-- Special 1 -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="collar" 
                value="Special 1" 
                class="hidden peer"
                {{ old('collar') == 'Special 1' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collars/special1.png') }}');">
                    <!-- Image set as background for Special 1 -->
                </div>

                <p class="text-center text-sm mt-2">Special 1</p>
            </div>
        </label>

        <!-- Special 2 -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="collar" 
                value="Special 2" 
                class="hidden peer"
                {{ old('collar') == 'Special 2' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collars/special2.png') }}');">
                    <!-- Image set as background for Special 2 -->
                </div>

                <p class="text-center text-sm mt-2">Special 2</p>
            </div>
        </label>
    </div>
</div>



<!-- Collar Buttons Radio Buttons -->
<div class="mt-20 border-emerald-950">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="collar_buttons" :value="__('Collar Buttons')" />
    
    <div class="mt-4 grid grid-cols-4 gap-4">
        <!-- 1 Button -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="collar_buttons" 
                value="1 Button" 
                class="hidden peer"
                {{ old('collar_buttons') == '1 Button' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collar_buttons/1_button.png') }}');">
                    <!-- Image set as background for 1 Button -->
                </div>

                <p class="text-center text-sm mt-2">1 Button</p>
            </div>
        </label>

        <!-- 2 Buttons Classic -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="collar_buttons" 
                value="2 Buttons Classic" 
                class="hidden peer"
                {{ old('collar_buttons') == '2 Buttons Classic' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collar_buttons/2_buttons_classic.png') }}');">
                    <!-- Image set as background for 2 Buttons Classic -->
                </div>

                <p class="text-center text-sm mt-2">2 Buttons Classic</p>
            </div>
        </label>

        <!-- 2 Buttons Tall -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="collar_buttons" 
                value="2 Buttons Tall" 
                class="hidden peer"
                {{ old('collar_buttons') == '2 Buttons Tall' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collar_buttons/2_buttons_tall.png') }}');">
                    <!-- Image set as background for 2 Buttons Tall -->
                </div>

                <p class="text-center text-sm mt-2">2 Buttons Tall</p>
            </div>
        </label>

        <!-- 3 Buttons -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="collar_buttons" 
                value="3 Buttons" 
                class="hidden peer"
                {{ old('collar_buttons') == '3 Buttons' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collar_buttons/3_buttons.png') }}');">
                    <!-- Image set as background for 3 Buttons -->
                </div>

                <p class="text-center text-sm mt-2">3 Buttons</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('collar_buttons')" class="mt-2" />
</div>


<!-- Collar Button Down Radio Buttons -->
<div class="mt-20 border-emerald-950">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="collar_button_down" :value="__('Collar Button Down')" />
    
    <div class="mt-4 grid grid-cols-3 gap-4">
        <!-- No Button Down -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="collar_button_down" 
                value="No Button Down" 
                class="hidden peer"
                {{ old('collar_button_down') == 'No Button Down' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collar_buttons/no_button_down.png') }}');">
                    <!-- Image for No Button Down -->
                </div>

                <p class="text-center text-sm mt-2">No Button Down</p>
            </div>
        </label>

        <!-- Button Down -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="collar_button_down" 
                value="Button Down" 
                class="hidden peer"
                {{ old('collar_button_down') == 'Button Down' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collar_buttons/button_down.png') }}');">
                    <!-- Image for Button Down -->
                </div>

                <p class="text-center text-sm mt-2">Button Down</p>
            </div>
        </label>

        <!-- Hidden Button Down -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="collar_button_down" 
                value="Hidden Button Down" 
                class="hidden peer"
                {{ old('collar_button_down') == 'Hidden Button Down' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collar_buttons/hidden_button_down.png') }}');">
                    <!-- Image for Hidden Button Down -->
                </div>

                <p class="text-center text-sm mt-2">Hidden Button Down</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('collar_button_down')" class="mt-2" />
</div>



<!-- Cuff Radio Buttons -->
<div class="mt-20 border-emerald-950">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="cuff" :value="__('Cuff')" />
    
    <div class="mt-4 grid grid-cols-4 gap-4">
        <!-- 1 Button Round -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="cuff" 
                value="1 Button Round" 
                class="hidden peer"
                {{ old('cuff') == '1 Button Round' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/cuffs/1_button_round.png') }}');">
                    <!-- Image for 1 Button Round -->
                </div>

                <p class="text-center text-sm mt-2">1 Button Round</p>
            </div>
        </label>

        <!-- 2 Button Round -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="cuff" 
                value="2 Button Round" 
                class="hidden peer"
                {{ old('cuff') == '2 Button Round' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/cuffs/2_button_round.png') }}');">
                    <!-- Image for 2 Button Round -->
                </div>

                <p class="text-center text-sm mt-2">2 Button Round</p>
            </div>
        </label>

        <!-- 1 Button Angle -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="cuff" 
                value="1 Button Angle" 
                class="hidden peer"
                {{ old('cuff') == '1 Button Angle' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/cuffs/1_button_angle.png') }}');">
                    <!-- Image for 1 Button Angle -->
                </div>

                <p class="text-center text-sm mt-2">1 Button Angle</p>
            </div>
        </label>

        <!-- 2 Button Angle -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="cuff" 
                value="2 Button Angle" 
                class="hidden peer"
                {{ old('cuff') == '2 Button Angle' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/cuffs/2_button_angle.png') }}');">
                    <!-- Image for 2 Button Angle -->
                </div>

                <p class="text-center text-sm mt-2">2 Button Angle</p>
            </div>
        </label>

        <!-- French Square -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="cuff" 
                value="French Square" 
                class="hidden peer"
                {{ old('cuff') == 'French Square' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/cuffs/french_square.png') }}');">
                    <!-- Image for French Square -->
                </div>

                <p class="text-center text-sm mt-2">French Square</p>
            </div>
        </label>

        <!-- French Angle -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="cuff" 
                value="French Angle" 
                class="hidden peer"
                {{ old('cuff') == 'French Angle' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/cuffs/french_angle.png') }}');">
                    <!-- Image for French Angle -->
                </div>

                <p class="text-center text-sm mt-2">French Angle</p>
            </div>
        </label>

        <!-- Cocktail -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="cuff" 
                value="Cocktail" 
                class="hidden peer"
                {{ old('cuff') == 'Cocktail' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/cuffs/cocktail.png') }}');">
                    <!-- Image for Cocktail -->
                </div>

                <p class="text-center text-sm mt-2">Cocktail</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('cuff')" class="mt-2" />
</div>

<!-- Contrast Radio Buttons -->
<div class="mt-20 border-emerald-950">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="contrast" :value="__('Contrast')" />
    
    <div class="mt-4 grid grid-cols-3 gap-4">
        <!-- No Contrast -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="contrast" 
                value="No Contrast" 
                class="hidden peer"
                {{ old('cell_contrast') == 'No Contrast' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/contrasts/no_contrast.png') }}');">
                    <!-- Image for No Contrast -->
                </div>

                <p class="text-center text-sm mt-2">No Contrast</p>
            </div>
        </label>

        <!-- Contrast 1 -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="contrast" 
                value="Contrast 1" 
                class="hidden peer"
                {{ old('cell_contrast') == 'Contrast 1' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/contrasts/contrast_1.png') }}');">
                    <!-- Image for Contrast 1 -->
                </div>

                <p class="text-center text-sm mt-2">Contrast 1</p>
            </div>
        </label>

        <!-- Contrast 2 -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="contrast" 
                value="Contrast 2" 
                class="hidden peer"
                {{ old('contrast') == 'Contrast 2' ? 'checked' : '' }}>
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/contrasts/contrast_2.png') }}');">
                    <!-- Image for Contrast 2 -->
                </div>

                <p class="text-center text-sm mt-2">Contrast 2</p>
            </div>
        </label>

    </div>

    <x-input-error :messages="$errors->get('cell_contrast')" class="mt-2" />
</div>




<!-- Placket Radio Buttons -->
<div class="mt-20 border-emerald-950">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="placket" :value="__('Placket')" />
    
    <div class="mt-4 grid grid-cols-3 gap-4">
        <!-- Standard Placket -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="placket" 
                value="Standard Placket" 
                class="hidden peer"
                {{ old('placket') == 'Standard Placket' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/placket/standard.png') }}');">
                    <!-- Image for Standard Placket -->
                </div>
                <p class="text-center text-sm mt-2">Standard Placket</p>
            </div>
        </label>

        <!-- No Placket -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="placket" 
                value="No Placket" 
                class="hidden peer"
                {{ old('placket') == 'No Placket' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/placket/no.png') }}');">
                    <!-- Image for No Placket -->
                </div>
                <p class="text-center text-sm mt-2">No Placket</p>
            </div>
        </label>

        <!-- Concealed Placket -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="placket" 
                value="Concealed Placket" 
                class="hidden peer"
                {{ old('placket') == 'Concealed Placket' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/placket/concealed.png') }}');">
                    <!-- Image for Concealed Placket -->
                </div>
                <p class="text-center text-sm mt-2">Concealed Placket</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('placket')" class="mt-2" />
</div>

<!-- Pleat Radio Buttons -->
<div class="mt-20 border-emerald-950">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="pleat" :value="__('Pleat')" />
    
    <div class="mt-4 grid grid-cols-3 gap-4">
        <!-- Two Side Pleat -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pleat" 
                value="Two Side Pleat" 
                class="hidden peer"
                {{ old('pleat') == 'Two Side Pleat' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/pleat/two_side.png') }}');">
                    <!-- Image for Two Side Pleat -->
                </div>
                <p class="text-center text-sm mt-2">Two Side Pleat</p>
            </div>
        </label>

        <!-- Center Pleat -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pleat" 
                value="Center Pleat" 
                class="hidden peer"
                {{ old('pleat') == 'Center Pleat' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/pleat/center.png') }}');">
                    <!-- Image for Center Pleat -->
                </div>
                <p class="text-center text-sm mt-2">Center Pleat</p>
            </div>
        </label>

        <!-- No Pleat -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pleat" 
                value="No Pleat" 
                class="hidden peer"
                {{ old('pleat') == 'No Pleat' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/pleat/no.png') }}');">
                    <!-- Image for No Pleat -->
                </div>
                <p class="text-center text-sm mt-2">No Pleat</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('pleat')" class="mt-2" />
</div>

<!-- Bottom Radio Buttons -->
<div class="mt-20 border-emerald-950">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="bottom" :value="__('Bottom')" />
    
    <div class="mt-4 grid grid-cols-4 gap-4">
        <!-- Round Bottom -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="bottom" 
                value="Round Bottom" 
                class="hidden peer"
                {{ old('bottom') == 'Round Bottom' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/bottom/round.png') }}');">
                    <!-- Image for Round Bottom -->
                </div>
                <p class="text-center text-sm mt-2">Round Bottom</p>
            </div>
        </label>

        <!-- Straight Bottom -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="bottom" 
                value="Straight Bottom" 
                class="hidden peer"
                {{ old('bottom') == 'Straight Bottom' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/bottom/straight.png') }}');">
                    <!-- Image for Straight Bottom -->
                </div>
                <p class="text-center text-sm mt-2">Straight Bottom</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('bottom')" class="mt-2" />
</div>

<!-- Pocket Radio Buttons -->
<div class="mt-20 border-emerald-950">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="pocket" :value="__('Pocket')" />
    
    <div class="mt-4 grid grid-cols-4 gap-4">
        <!-- Round -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pocket" 
                value="Round" 
                class="hidden peer"
                {{ old('pocket') == 'Round' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/pocket/round.png') }}');">
                    <!-- Image for Round Pocket -->
                </div>
                <p class="text-center text-sm mt-2">Round</p>
            </div>
        </label>

        <!-- Angle -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pocket" 
                value="Angle" 
                class="hidden peer"
                {{ old('pocket') == 'Angle' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/pocket/angle.png') }}');">
                    <!-- Image for Angle Pocket -->
                </div>
                <p class="text-center text-sm mt-2">Angle</p>
            </div>
        </label>

        <!-- Pointed -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pocket" 
                value="Pointed" 
                class="hidden peer"
                {{ old('pocket') == 'Pointed' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/pocket/pointed.png') }}');">
                    <!-- Image for Pointed Pocket -->
                </div>
                <p class="text-center text-sm mt-2">Pointed</p>
            </div>
        </label>

        <!-- No Pocket -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="pocket" 
                value="No Pocket" 
                class="hidden peer"
                {{ old('pocket') == 'No Pocket' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/pocket/no.png') }}');">
                    <!-- Image for No Pocket -->
                </div>
                <p class="text-center text-sm mt-2">No Pocket</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('pocket')" class="mt-2" />
</div>

<!-- Fit Radio Buttons -->
<div class="mt-20 border-emerald-950">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="fit" :value="__('Fit')" />
    
    <div class="mt-4 grid grid-cols-3 gap-4">
        <!-- Regular -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="fit" 
                value="Regular" 
                class="hidden peer"
                {{ old('fit') == 'Regular' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/fit/regular.png') }}');">
                    <!-- Image for Regular Fit -->
                </div>
                <p class="text-center text-sm mt-2">Regular</p>
            </div>
        </label>

        <!-- Fitted -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="fit" 
                value="Fitted" 
                class="hidden peer"
                {{ old('fit') == 'Fitted' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/fit/fitted.png') }}');">
                    <!-- Image for Fitted -->
                </div>
                <p class="text-center text-sm mt-2">Fitted</p>
            </div>
        </label>

        <!-- Slim Fit -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="fit" 
                value="Slim Fit" 
                class="hidden peer"
                {{ old('fit') == 'Slim Fit' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/fit/slim.png') }}');">
                    <!-- Image for Slim Fit -->
                </div>
                <p class="text-center text-sm mt-2">Slim Fit</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('fit')" class="mt-2" />
</div>





<br><br>
<h2 class="text-3xl font-semibold text-gray-800 leading-tight text-center mt-20">
Fabric / Button Codes
</h2>
<!-- Shirt Fabric Code -->
<div class="mt-2">
    <x-input-label for="shirt_fabric_code" :value="__('Shirt Fabric Code')" />
    <x-text-input 
        id="shirt_fabric_code" 
        class="block mt-1 w-full uppercase" 
        type="text" 
        name="shirt_fabric_code" 
        :value="old('shirt_fabric_code')" 
        required 
        autocomplete="shirt_fabric_code" 
        pattern="[A-Za-z0-9]+" 
        title="Only letters and numbers are allowed"
    />
    <x-input-error :messages="$errors->get('shirt_fabric_code')" class="mt-2" />
</div>

<!-- Shirt Button Code -->
<div class="mt-2">
    <x-input-label for="shirt_button_code" :value="__('Shirt Button Code')" />
    <x-text-input 
        id="shirt_button_code" 
        class="block mt-1 w-full uppercase" 
        type="text" 
        name="shirt_button_code" 
        :value="old('shirt_button_code')" 
        required 
        autocomplete="shirt_button_code" 
        pattern="[A-Za-z0-9]+" 
        title="Only letters and numbers are allowed"
    />
    <x-input-error :messages="$errors->get('shirt_button_code')" class="mt-2" />
</div>

<!-- Cell Shirt Contrast Code -->
<div class="mt-2">
    <x-input-label for="shirt_contrast_code" :value="__('Shirt Contrast Code')" />
    <x-text-input 
        id="shirt_contrast_code" 
        class="block mt-1 w-full uppercase" 
        type="text" 
        name="shirt_contrast_code" 
        :value="old('shirt_contrast_code')" 
        autocomplete="shirt_contrast_code" 
        pattern="[A-Za-z0-9]+" 
        title="Only letters and numbers are allowed"
    />
    <p class="text-xs text-gray-500 mt-1">Only needed if contrast colour option has been selected.</p>
    <x-input-error :messages="$errors->get('shirt_contrast_code')" class="mt-2" />
</div>





<div class="mt-20 flex justify-end">
            <x-primary-button class="ms-4">
                {{ __('Create Shirt') }}
            </x-primary-button>
        </div>
        <br><br>
</div>
    </form>
    </div>
</x-guest-layout>
</x-app-layout>