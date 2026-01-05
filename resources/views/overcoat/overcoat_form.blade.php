<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight leading-tight">
            Create Overcoat
        </h2>
    </x-slot>

    <!-- SPACING / MARGINS -->
    <div class=" mt-16 mx-40">

        <h2 class="font-semibold text-m text-gray-800 leading-tight mb-10 text-center">
            Order Number: (#{{ $orders->order_number }})
        </h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('overcoat.store', ['id' => $orders->id]) }}">
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
                                {{ $measurement->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('measurement_id')" class="mt-2" />
                </div>
            </div>

            <br><br>
            <h2 class="text-3xl font-semibold text-gray-800 leading-tight text-center">
                Overcoat Construction
            </h2>

            <!-- Overcoat Type Radio Buttons -->
            <div class="mt-6 ">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white " for="overcoat_type" :value="__('Overcoat Type')" />

                <div class="mt-4 grid grid-cols-4 gap-4">
                    <!-- Single 1 Button -->
                    <label class="inline-flex flex-col items-center cursor-pointer group">
                        <input
                            type="radio"
                            name="overcoat_type"
                            value="Single 1 Button"
                            id="single1"
                            class="hidden peer"
                            {{ old('overcoat_type') == 'Single 1 Button' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border peer-checked:border-emerald-950 flex flex-col items-center justify-center relative group">
                            <div
                                id="imageContainer"
                                class="w-full h-full bg-cover bg-center rounded-lg transition-all duration-300 ease-in-out"
                                style="background-image: url({{ asset('images/jacket_type/jacket_type_1.png') }});">
                            </div>

                            <p class="text-center text-sm mt-2">Single 1 Button</p>
                        </div>
                    </label>

                    <!-- Single 2 Buttons -->
                    <label class="inline-flex flex-col items-center cursor-pointer group">
                        <input
                            type="radio"
                            name="overcoat_type"
                            value="Single 2 Buttons"
                            class="hidden peer"
                            {{ old('overcoat_type') == 'Single 2 Buttons' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border peer-checked:border-emerald-950 flex flex-col items-center justify-center relative group">
                            <div
                                id="imageContainer"
                                class="w-full h-full bg-cover bg-center rounded-lg transition-all duration-300 ease-in-out"
                                style="background-image: url({{ asset('images/jacket_type/jacket_type_2.png') }});">
                            </div>

                            <p class="text-center text-sm mt-2">Single 2 Buttons</p>
                        </div>
                    </label>

                    <!-- Single 3 Buttons -->
                    <label class="inline-flex flex-col items-center cursor-pointer group">
                        <input
                            type="radio"
                            name="overcoat_type"
                            value="Single 3 Buttons"
                            class="hidden peer"
                            {{ old('overcoat_type') == 'Single 3 Buttons' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border peer-checked:border-emerald-950 flex flex-col items-center justify-center relative group">
                            <div
                                id="imageContainer"
                                class="w-full h-full bg-cover bg-center rounded-lg transition-all duration-300 ease-in-out"
                                style="background-image: url({{ asset('images/jacket_type/jacket_type_3.png') }});">
                            </div>

                            <p class="text-center text-sm mt-2">Single 3 Buttons</p>
                        </div>
                    </label>

                    <!-- Single 4 Buttons -->
                    <label class="inline-flex flex-col items-center cursor-pointer group">
                        <input
                            type="radio"
                            name="overcoat_type"
                            value="Single 4 Buttons"
                            class="hidden peer"
                            {{ old('overcoat_type') == 'Single 4 Buttons' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border peer-checked:border-emerald-950 flex flex-col items-center justify-center relative group">
                            <div
                                id="imageContainer"
                                class="w-full h-full bg-cover bg-center rounded-lg transition-all duration-300 ease-in-out"
                                style="background-image: url({{ asset('images/jacket_type/jacket_type_4.png') }});">
                            </div>

                            <p class="text-center text-sm mt-2">Single 4 Buttons</p>
                        </div>
                    </label>

                    <!-- Double Breast 4 on 1 -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_type"
                            value="Double Breast 4 on 1"
                            class="hidden peer"
                            {{ old('overcoat_type') == 'Double Breast 4 on 1' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url({{ asset('images/jacket_type/jacket_type_9.png') }});">
                            </div>

                            <p class="text-center text-sm mt-2">Double Breast 4 on 1</p>
                        </div>
                    </label>

                    <!-- Double Breast 4 on 2 -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_type"
                            value="Double Breast 4 on 2"
                            class="hidden peer"
                            {{ old('overcoat_type') == 'Double Breast 4 on 2' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url({{ asset('images/jacket_type/jacket_type_6.png') }});">
                            </div>

                            <p class="text-center text-sm mt-2">Double Breast 4 on 2</p>
                        </div>
                    </label>

                    <!-- Double Breast 6 on 2 -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_type"
                            value="Double Breast 6 on 2"
                            class="hidden peer"
                            {{ old('overcoat_type') == 'Double Breast 6 on 2' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url({{ asset('images/jacket_type/jacket_type_7.png') }});">
                            </div>

                            <p class="text-center text-sm mt-2">Double Breast 6 on 2</p>
                        </div>
                    </label>

                    <!-- Double Breast 6 on 3 -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_type"
                            value="Double Breast 6 on 3"
                            class="hidden peer"
                            {{ old('overcoat_type') == 'Double Breast 6 on 3' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url({{ asset('images/jacket_type/jacket_type_8.png') }});">
                            </div>

                            <p class="text-center text-sm mt-2">Double Breast 6 on 3</p>
                        </div>
                    </label>

                    <!-- 3 Roll 2 -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_type"
                            value="3 Roll 2"
                            class="hidden peer"
                            {{ old('overcoat_type') == '3 Roll 2' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url({{ asset('images/jacket_type/jacket_type_5.png') }});">
                            </div>

                            <p class="text-center text-sm mt-2">3 Roll 2</p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('overcoat_type')" class="mt-2" />
            </div>

            <!-- Overcoat Construction Radio Buttons -->
            <div class="mt-20 border-emerald-950">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg  bg-emerald-950 text-white" for="overcoat_construction" :value="__('Overcoat Construction')" />

                <div class="mt-4 grid grid-cols-2 gap-4">
                    <!-- Full Canvas -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_construction"
                            value="Full Canvas"
                            class="hidden peer"
                            {{ old('overcoat_construction') == 'Full Canvas' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url({{ asset('images/canvas/full.png') }});">
                            </div>

                            <p class="text-center text-sm mt-2">Full Canvas</p>
                        </div>
                    </label>

                    <!-- Half Canvas -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_construction"
                            value="Half Canvas"
                            class="hidden peer"
                            {{ old('overcoat_construction') == 'Half Canvas' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/canvas/half.png') }}');">
                            </div>

                            <p class="text-center text-sm mt-2">Half Canvas</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Overcoat Lapel Type Radio Buttons -->
            <div class="mt-20">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg  bg-emerald-950 text-white" for="overcoat_lapel_type" :value="__('Overcoat Lapel Type')" />

                <div class="mt-4 grid grid-cols-3 gap-4">
                    <!-- Notch Lapel -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_lapel_type"
                            value="Notch Lapel"
                            class="hidden peer"
                            {{ old('overcoat_lapel_type') == 'Notch Lapel' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lapel_type/notch.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Notch Lapel</p>
                        </div>
                    </label>

                    <!-- Peak Lapel -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_lapel_type"
                            value="Peak Lapel"
                            class="hidden peer"
                            {{ old('overcoat_lapel_type') == 'Peak Lapel' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lapel_type/peak.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Peak Lapel</p>
                        </div>
                    </label>

                    <!-- Shawl Lapel -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_lapel_type"
                            value="Shawl Lapel"
                            class="hidden peer"
                            {{ old('overcoat_lapel_type') == 'Shawl Lapel' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lapel_type/shawl.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Shawl Lapel</p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('overcoat_lapel_type')" class="mt-2" />
            </div>

            <!-- Overcoat Satin Lapel Type Radio Buttons -->
            <div class="mt-20">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg  bg-emerald-950 text-white" for="overcoat_satin_lapel" :value="__('Overcoat Satin Lapel Type?')" />

                <div class="mt-4 grid grid-cols-3 gap-4">
                    <!-- No Satin Lapel -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_satin_lapel"
                            value="No Satin Lapel"
                            class="hidden peer"
                            {{ old('overcoat_satin_lapel') == 'No Satin Lapel' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/satin_lapel/no_satin.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">No Satin Lapel</p>
                        </div>
                    </label>

                    <!-- Satin Front Lapel -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_satin_lapel"
                            value="Satin Front Lapel"
                            class="hidden peer"
                            {{ old('overcoat_satin_lapel') == 'Satin Front Lapel' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/satin_lapel/front_satin.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Satin Front Lapel</p>
                        </div>
                    </label>

                    <!-- Satin Front Including Back Collar -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_satin_lapel"
                            value="Satin Front Including Back Collar"
                            class="hidden peer"
                            {{ old('overcoat_satin_lapel') == 'Satin Front Including Back Collar' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/satin_lapel/front_back_collar_satin.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Satin Front Including Back Collar</p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('overcoat_satin_lapel')" class="mt-2" />
            </div>

            <!-- Overcoat Hand Stitch Radio Buttons -->
            <div class="mt-20">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg  bg-emerald-950 text-white" for="overcoat_hand_stitch" :value="__('Lapel Hand Stitch?')" />

                <div class="mt-4 grid grid-cols-2 gap-4">
                    <!-- Yes Option -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_hand_stitch"
                            value="Yes"
                            class="hidden peer"
                            {{ old('overcoat_hand_stitch') == 'Yes' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/handstitch/yes.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Yes</p>
                        </div>
                    </label>

                    <!-- No Option -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_hand_stitch"
                            value="No"
                            class="hidden peer"
                            {{ old('overcoat_hand_stitch') == 'No' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/handstitch/no.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">No</p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('overcoat_hand_stitch')" class="mt-2" />
            </div>

            <!-- Overcoat Lapel Width Radio Buttons -->
            <div class="mt-20">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg  bg-emerald-950 text-white" for="overcoat_lapel_width" :value="__('Overcoat Lapel Width')" />

                <div class="mt-4 grid grid-cols-3 gap-4">
                    <!-- Thinner -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_lapel_width"
                            value="Thinner"
                            class="hidden peer"
                            {{ old('overcoat_lapel_width') == 'Thinner' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lapel_width/thinner.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Thinner</p>
                        </div>
                    </label>

                    <!-- Regular -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_lapel_width"
                            value="Regular"
                            class="hidden peer"
                            {{ old('overcoat_lapel_width') == 'Regular' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lapel_width/regular.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Regular</p>
                        </div>
                    </label>

                    <!-- Wider -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_lapel_width"
                            value="Wider"
                            class="hidden peer"
                            {{ old('overcoat_lapel_width') == 'Wider' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lapel_width/wider.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Wider</p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('overcoat_lapel_width')" class="mt-2" />
            </div>

            <!-- Overcoat Lapel Functional Button Radio Buttons -->
            <div class="mt-20">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="overcoat_lapel_functional_button" :value="__('Overcoat Lapel Functional Button')" />

                <div class="mt-4 grid grid-cols-2 gap-4">
                    <!-- Decorative -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_lapel_functional_button"
                            value="Decorative"
                            class="hidden peer"
                            {{ old('overcoat_lapel_functional_button') == 'Decorative' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lapel_functional_button/decorative.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Decorative</p>
                        </div>
                    </label>

                    <!-- Functional -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_lapel_functional_button"
                            value="Functional"
                            class="hidden peer"
                            {{ old('overcoat_lapel_functional_button') == 'Functional' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lapel_functional_button/functional.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Functional</p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('overcoat_lapel_functional_button')" class="mt-2" />
            </div>

            <!-- Overcoat Sleeve Buttons Radio Buttons -->
            <div class="mt-20">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="overcoat_sleeve_buttons" :value="__('Overcoat Sleeve Buttons')" />

                <div class="mt-4 grid grid-cols-4 gap-4">
                    <!-- 2 -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_sleeve_buttons"
                            value="2 Sleeve Buttons"
                            class="hidden peer"
                            {{ old('overcoat_sleeve_buttons') == '2 Sleeve Buttons' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/sleeve_buttons/2_buttons.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">2 Sleeve Buttons</p>
                        </div>
                    </label>

                    <!-- 3 -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_sleeve_buttons"
                            value="3 Sleeve Buttons"
                            class="hidden peer"
                            {{ old('overcoat_sleeve_buttons') == '3 Sleeve Buttons' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/sleeve_buttons/3_buttons.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">3 Sleeve Buttons</p>
                        </div>
                    </label>

                    <!-- 4 -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_sleeve_buttons"
                            value="4 Sleeve Buttons"
                            class="hidden peer"
                            {{ old('overcoat_sleeve_buttons') == '4 Sleeve Buttons' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/sleeve_buttons/4_buttons.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">4 Sleeve Buttons</p>
                        </div>
                    </label>

                    <!-- 5 -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_sleeve_buttons"
                            value="5 Sleeve Buttons"
                            class="hidden peer"
                            {{ old('overcoat_sleeve_buttons') == '5 Sleeve Buttons' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/sleeve_buttons/5_buttons.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">5 Sleeve Buttons</p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('overcoat_sleeve_buttons')" class="mt-2" />
            </div>

            <!-- Overcoat Functional Buttons Radio Buttons -->
            <div class="mt-20">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="overcoat_functional_buttons" :value="__('Overcoat Sleeve Functional Buttons')" />

                <div class="mt-4 grid grid-cols-2 gap-4">
                    <!-- Decorative -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_functional_buttons"
                            value="Decorative"
                            class="hidden peer"
                            {{ old('overcoat_functional_buttons') == 'Decorative' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/functional_buttons/decorative.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Decorative</p>
                        </div>
                    </label>

                    <!-- Functional -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_functional_buttons"
                            value="Functional"
                            class="hidden peer"
                            {{ old('overcoat_functional_buttons') == 'Functional' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/functional_buttons/functional.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Functional</p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('overcoat_functional_buttons')" class="mt-2" />
            </div>

            <!-- Overcoat Buttons Colour on Last Button Hole Radio Buttons -->
            <div class="mt-20">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="overcoat_buttons_colour_on_last_button_hole" :value="__('Contrast Colour on Last Button Hole?')" />

                <div class="mt-4 grid grid-cols-2 gap-4">
                    <!-- Yes -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_buttons_colour_on_last_button_hole"
                            value="Yes"
                            class="hidden peer"
                            {{ old('overcoat_buttons_colour_on_last_button_hole') == 'Yes' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/buttons_contrast_colour/yes.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Yes</p>
                        </div>
                    </label>

                    <!-- No -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_buttons_colour_on_last_button_hole"
                            value="No"
                            class="hidden peer"
                            {{ old('overcoat_buttons_colour_on_last_button_hole') == 'No' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/buttons_contrast_colour/no.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">No</p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('overcoat_buttons_colour_on_last_button_hole')" class="mt-2" />
            </div>

            <!-- Overcoat Lining Radio Buttons -->
            <div class="mt-20">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="overcoat_lining" :value="__('Overcoat Lining')" />

                <div class="mt-4 grid grid-cols-3 gap-4">
                    <!-- Full Lining -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_lining"
                            value="Full Lining"
                            class="hidden peer"
                            {{ old('overcoat_lining') == 'Full Lining' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lining/full_lining.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Full Lining</p>
                        </div>
                    </label>

                    <!-- Half Lining -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_lining"
                            value="Half Lining"
                            class="hidden peer"
                            {{ old('overcoat_lining') == 'Half Lining' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lining/half_lining.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Half Lining</p>
                        </div>
                    </label>

                    <!-- No Lining -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_lining"
                            value="No Lining"
                            class="hidden peer"
                            {{ old('overcoat_lining') == 'No Lining' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lining/no_lining.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">No Lining</p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('overcoat_lining')" class="mt-2" />
            </div>

            <!-- Overcoat Pockets Radio Buttons -->
            <div class="mt-20">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="overcoat_pockets" :value="__('Overcoat Pockets')" />

                <div class="mt-4 grid grid-cols-3 gap-4">
                    <!-- No Pockets -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_pockets"
                            value="No Pockets"
                            class="hidden peer"
                            {{ old('overcoat_pockets') == 'No Pockets' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pockets/no_pockets.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">No Pockets</p>
                        </div>
                    </label>

                    <!-- 2 Pockets -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_pockets"
                            value="2 Pockets"
                            class="hidden peer"
                            {{ old('overcoat_pockets') == '2 Pockets' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pockets/2_pockets.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">2 Pockets</p>
                        </div>
                    </label>

                    <!-- 3 Pockets -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_pockets"
                            value="3 Pockets"
                            class="hidden peer"
                            {{ old('overcoat_pockets') == '3 Pockets' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pockets/3_pockets.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">3 Pockets</p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('overcoat_pockets')" class="mt-2" />
            </div>

            <!-- Overcoat Pockets with Flap Radio Buttons -->
            <div class="mt-20">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="overcoat_pockets_with_flap" :value="__('Overcoat Pockets with Flap')" />

                <div class="mt-4 grid grid-cols-2 gap-4">
                    <!-- Yes -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_pockets_with_flap"
                            value="Yes"
                            class="hidden peer"
                            {{ old('overcoat_pockets_with_flap') == 'Yes' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pockets_with_flap/yes.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Yes</p>
                        </div>
                    </label>

                    <!-- No -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_pockets_with_flap"
                            value="No"
                            class="hidden peer"
                            {{ old('overcoat_pockets_with_flap') == 'No' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pockets_with_flap/no.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">No</p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('overcoat_pockets_with_flap')" class="mt-2" />
            </div>

            <!-- Overcoat Italian Pockets Radio Buttons -->
            <div class="mt-20">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="overcoat_italian_pockets" :value="__('Overcoat Italian Pockets')" />

                <div class="mt-4 grid grid-cols-2 gap-4">
                    <!-- Yes -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_italian_pockets"
                            value="Yes"
                            class="hidden peer"
                            {{ old('overcoat_italian_pockets') == 'Yes' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/italian_pockets/yes.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Yes</p>
                        </div>
                    </label>

                    <!-- No -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_italian_pockets"
                            value="No"
                            class="hidden peer"
                            {{ old('overcoat_italian_pockets') == 'No' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/italian_pockets/no.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">No</p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('overcoat_italian_pockets')" class="mt-2" />
            </div>

            <!-- Overcoat Patch Pockets Radio Buttons -->
            <div class="mt-20">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="overcoat_patch_pockets" :value="__('Overcoat Patch Pockets')" />

                <div class="mt-4 grid grid-cols-2 gap-4">
                    <!-- Yes -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_patch_pockets"
                            value="Yes"
                            class="hidden peer"
                            {{ old('overcoat_patch_pockets') == 'Yes' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/patch_pockets/yes.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Yes</p>
                        </div>
                    </label>

                    <!-- No -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_patch_pockets"
                            value="No"
                            class="hidden peer"
                            {{ old('overcoat_patch_pockets') == 'No' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/patch_pockets/no.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">No</p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('overcoat_patch_pockets')" class="mt-2" />
            </div>

            <!-- Overcoat Pockets Satin Piping Radio Buttons -->
            <div class="mt-20">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="overcoat_pockets_satin_piping" :value="__('Overcoat Pockets Satin Piping')" />

                <div class="mt-4 grid grid-cols-2 gap-4">
                    <!-- Yes -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_pockets_satin_piping"
                            value="Yes"
                            class="hidden peer"
                            {{ old('overcoat_pockets_satin_piping') == 'Yes' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pockets_satin_piping/yes.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Yes</p>
                        </div>
                    </label>

                    <!-- No -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_pockets_satin_piping"
                            value="No"
                            class="hidden peer"
                            {{ old('overcoat_pockets_satin_piping') == 'No' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/pockets_satin_piping/no.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">No</p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('overcoat_pockets_satin_piping')" class="mt-2" />
            </div>

            <!-- Overcoat Chest Pocket Type Radio Buttons -->
            <div class="mt-20">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="overcoat_chest_pocket_type" :value="__('Overcoat Chest Pocket Type')" />

                <div class="mt-4 grid grid-cols-3 gap-4">
                    <!-- Curved -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_chest_pocket_type"
                            value="Curved Chest Pocket"
                            class="hidden peer"
                            {{ old('overcoat_chest_pocket_type') == 'Curved Chest Pocket' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/chest_pocket/curved.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Curved Chest Pocket</p>
                        </div>
                    </label>

                    <!-- Patch -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_chest_pocket_type"
                            value="Patch Chest Pocket"
                            class="hidden peer"
                            {{ old('overcoat_chest_pocket_type') == 'Patch Chest Pocket' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/chest_pocket/patch.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Patch Chest Pocket</p>
                        </div>
                    </label>

                    <!-- Satin -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_chest_pocket_type"
                            value="Satin Chest Pocket"
                            class="hidden peer"
                            {{ old('overcoat_chest_pocket_type') == 'Satin Chest Pocket' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/chest_pocket/satin.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Satin Chest Pocket</p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('overcoat_chest_pocket_type')" class="mt-2" />
            </div>

            <!-- Overcoat Vents Radio Buttons -->
            <div class="mt-20">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="overcoat_vents" :value="__('Overcoat Vents')" />

                <div class="mt-4 grid grid-cols-3 gap-4">
                    <!-- No Vent -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_vents"
                            value="No Vent"
                            class="hidden peer"
                            {{ old('overcoat_vents') == 'No Vent' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/vents/no_vent.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">No Vent</p>
                        </div>
                    </label>

                    <!-- Single Vent -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_vents"
                            value="Single Vent"
                            class="hidden peer"
                            {{ old('overcoat_vents') == 'Single Vent' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/vents/single_vent.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Single Vent</p>
                        </div>
                    </label>

                    <!-- Double Vent -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_vents"
                            value="Double Vent"
                            class="hidden peer"
                            {{ old('overcoat_vents') == 'Double Vent' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/vents/double_vent.png') }}');">
                            </div>
                            <p class="text-center text-sm mt-2">Double Vent</p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('overcoat_vents')" class="mt-2" />
            </div>

            <br><br>
            <h2 class="text-3xl font-semibold text-gray-800 leading-tight text-center mt-20">
                Fabric / Button Codes
            </h2>

            <br><br>
            <!-- Code Overcoat -->
            <div class="mt-2">
                <x-input-label for="code_overcoat" :value="__('Code Overcoat')" />
                <x-text-input
                    id="code_overcoat"
                    class="block mt-1 w-full uppercase"
                    type="text"
                    name="code_overcoat"
                    :value="old('code_overcoat')"
                    required
                    autocomplete="code_overcoat"
                    pattern="[A-Za-z0-9]+"
                    title="Only letters and numbers are allowed"
                />
                <x-input-error :messages="$errors->get('code_overcoat')" class="mt-2" />
            </div>

            <!-- Code Overcoat Lining -->
            <div class="mt-2">
                <x-input-label for="code_overcoat_lining" :value="__('Code Overcoat Lining')" />
                <x-text-input
                    id="code_overcoat_lining"
                    class="block mt-1 w-full uppercase"
                    type="text"
                    name="code_overcoat_lining"
                    :value="old('code_overcoat_lining')"
                    required
                    autocomplete="code_overcoat_lining"
                    pattern="[A-Za-z0-9]+"
                    title="Only letters and numbers are allowed"
                />
                <x-input-error :messages="$errors->get('code_overcoat_lining')" class="mt-2" />
            </div>

            <!-- Code Overcoat Button -->
            <div class="mt-2">
                <x-input-label for="code_overcoat_button" :value="__('Code Overcoat Button')" />
                <x-text-input
                    id="code_overcoat_button"
                    class="block mt-1 w-full uppercase"
                    type="text"
                    name="code_overcoat_button"
                    :value="old('code_overcoat_button')"
                    required
                    autocomplete="code_overcoat_button"
                    pattern="[A-Za-z0-9]+"
                    title="Only letters and numbers are allowed"
                />
                <x-input-error :messages="$errors->get('code_overcoat_button')" class="mt-2" />
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
                    :value="old('code_satin_lapel')"
                    autocomplete="code_satin_lapel"
                    pattern="[A-Za-z0-9]+"
                    title="Only letters and numbers are allowed"
                />
                <p class="text-xs text-gray-500 mt-1">This is only needed if satin elements have been selected.</p>
                <x-input-error :messages="$errors->get('code_satin_lapel')" class="mt-2" />
            </div>

            <div class="mt-2">
                <x-input-label for="code_colour_on_last_button_hole" :value="__('Code Colour on Last Button Hole')" />
                <x-text-input
                    id="code_colour_on_last_button_hole"
                    class="block mt-1 w-full uppercase"
                    type="text"
                    name="code_colour_on_last_button_hole"
                    :value="old('code_colour_on_last_button_hole')"
                    autocomplete="code_colour_on_last_button_hole"
                    pattern="[A-Za-z0-9]+"
                    title="Only letters and numbers are allowed"
                />
                <p class="text-xs text-gray-500 mt-1">This is only needed if contrast colour on last button hole has been selected.</p>
                <x-input-error :messages="$errors->get('code_colour_on_last_button_hole')" class="mt-2" />
            </div>

            <div class="mt-20 flex justify-end">
                <x-primary-button class="ms-4">
                    {{ __('Create Overcoat') }}
                </x-primary-button>
            </div>

            <br><br>
    </div>
        </form>
    </div>

</x-app-layout>
