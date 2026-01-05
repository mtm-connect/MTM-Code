<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white  leading-tight">
            Edit Overcoat
        </h2>
    </x-slot>

    <!-- SPACING / MARGINS -->
    <div class=" mt-16 mx-40">

        <h2 class="font-semibold text-m text-gray-800 leading-tight mb-10 text-center">
            Order Number: (#{{ $orders->order_number }})
        </h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('overcoats.update', $selectedovercoat->id) }}">
            @csrf
            @method('PUT')

            <!-- Measurement Dropdown -->
            <div class="p-4 rounded-xl mt-8">
                <div class="mt-0 flex items-center space-x-4">
                    <x-input-label for="measurement_id" :value="__('For')" class="text-lg font-semibold text-black" />
                    <select id="measurement_id" name="measurement_id" class="block mt-3 w-full p-4 border border-gray-300 bg-gray-300 bg-opacity-10
                       focus:font-bold focus:bg-emerald-950 focus:bg-opacity-10
                       focus:border-emerald-950 rounded-lg focus:ring-emerald-950" required>
                        <option value="" disabled selected>{{ __('Select Measurement') }}</option>
                        @foreach ($measurements as $measurement)
                            <option value="{{ $measurement->id }}"
                                {{ old('measurement_id') == $measurement->id || (isset($selectedmeasurement) && $selectedmeasurement->id == $measurement->id) ? 'selected' : ''  }}>
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
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="overcoat_type" :value="__('Overcoat Type')" />

                <div class="mt-4 grid grid-cols-4 gap-4">
                    <!-- Single 1 Button -->
                    <label class="inline-flex flex-col items-center cursor-pointer group">
                        <input
                            type="radio"
                            name="overcoat_type"
                            value="Single 1 Button"
                            class="hidden peer"
                            {{ old('overcoat_type', $selectedovercoat->overcoat_type ?? '') == 'Single 1 Button' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center relative group">
                            <div class="w-full h-full bg-cover bg-center rounded-lg transition-all duration-300 ease-in-out"
                                style="background-image: url({{ asset('images/jacket_type/jacket_type_1.png') }});"></div>
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
                            {{ old('overcoat_type', $selectedovercoat->overcoat_type ?? '') == 'Single 2 Buttons' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center relative group">
                            <div class="w-full h-full bg-cover bg-center rounded-lg transition-all duration-300 ease-in-out"
                                style="background-image: url({{ asset('images/jacket_type/jacket_type_2.png') }});"></div>
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
                            {{ old('overcoat_type', $selectedovercoat->overcoat_type ?? '') == 'Single 3 Buttons' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center relative group">
                            <div class="w-full h-full bg-cover bg-center rounded-lg transition-all duration-300 ease-in-out"
                                style="background-image: url({{ asset('images/jacket_type/jacket_type_3.png') }});"></div>
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
                            {{ old('overcoat_type', $selectedovercoat->overcoat_type ?? '') == 'Single 4 Buttons' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center relative group">
                            <div class="w-full h-full bg-cover bg-center rounded-lg transition-all duration-300 ease-in-out"
                                style="background-image: url({{ asset('images/jacket_type/jacket_type_4.png') }});"></div>
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
                            {{ old('overcoat_type', $selectedovercoat->overcoat_type ?? '') == 'Double Breast 4 on 1' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg"
                                style="background-image: url({{ asset('images/jacket_type/jacket_type_9.png') }});"></div>
                            <p class="text-center text-sm mt-2">Double Breast 4 on 1</p>
                        </div>
                    </label>

                    <!-- Double Breast 6 on 3 -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_type"
                            value="Double Breast 6 on 3"
                            class="hidden peer"
                            {{ old('overcoat_type', $selectedovercoat->overcoat_type ?? '') == 'Double Breast 6 on 3' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg"
                                style="background-image: url({{ asset('images/jacket_type/jacket_type_8.png') }});"></div>
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
                            {{ old('overcoat_type', $selectedovercoat->overcoat_type ?? '') == '3 Roll 2' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg"
                                style="background-image: url({{ asset('images/jacket_type/jacket_type_5.png') }});"></div>
                            <p class="text-center text-sm mt-2">3 Roll 2</p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('overcoat_type')" class="mt-2" />
            </div>

            <!-- Overcoat Construction Radio Buttons -->
            <div class="mt-20 border-emerald-950">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="overcoat_construction" :value="__('Overcoat Construction')" />

                <div class="mt-4 grid grid-cols-2 gap-4">
                    <!-- Full Canvas -->
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input
                            type="radio"
                            name="overcoat_construction"
                            value="Full Canvas"
                            class="hidden peer"
                            {{ old('overcoat_construction', $selectedovercoat->overcoat_construction ?? '') == 'Full Canvas' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url({{ asset('images/canvas/full.png') }});"></div>
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
                            {{ old('overcoat_construction', $selectedovercoat->overcoat_construction ?? '') == 'Half Canvas' ? 'checked' : '' }}>

                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/canvas/half.png') }}');"></div>
                            <p class="text-center text-sm mt-2">Half Canvas</p>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Everything below stays identical visually (same images) — only field names changed -->

            <!-- Overcoat Lapel Type -->
            <div class="mt-20">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="overcoat_lapel_type" :value="__('Overcoat Lapel Type')" />

                <div class="mt-4 grid grid-cols-3 gap-4">
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input type="radio" name="overcoat_lapel_type" value="Notch Lapel" class="hidden peer"
                            {{ old('overcoat_lapel_type', $selectedovercoat->overcoat_lapel_type ?? '') == 'Notch Lapel' ? 'checked' : '' }}>
                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lapel_type/notch.png') }}');"></div>
                            <p class="text-center text-sm mt-2">Notch Lapel</p>
                        </div>
                    </label>

                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input type="radio" name="overcoat_lapel_type" value="Peak Lapel" class="hidden peer"
                            {{ old('overcoat_lapel_type', $selectedovercoat->overcoat_lapel_type ?? '') == 'Peak Lapel' ? 'checked' : '' }}>
                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lapel_type/peak.png') }}');"></div>
                            <p class="text-center text-sm mt-2">Peak Lapel</p>
                        </div>
                    </label>

                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input type="radio" name="overcoat_lapel_type" value="Shawl Lapel" class="hidden peer"
                            {{ old('overcoat_lapel_type', $selectedovercoat->overcoat_lapel_type ?? '') == 'Shawl Lapel' ? 'checked' : '' }}>
                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/lapel_type/shawl.png') }}');"></div>
                            <p class="text-center text-sm mt-2">Shawl Lapel</p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('overcoat_lapel_type')" class="mt-2" />
            </div>

            <!-- Overcoat Satin Lapel -->
            <div class="mt-20">
                <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="overcoat_satin_lapel" :value="__('Overcoat Satin Lapel Type?')" />

                <div class="mt-4 grid grid-cols-3 gap-4">
                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input type="radio" name="overcoat_satin_lapel" value="No Satin Lapel" class="hidden peer"
                            {{ old('overcoat_satin_lapel', $selectedovercoat->overcoat_satin_lapel ?? '') == 'No Satin Lapel' ? 'checked' : '' }}>
                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/satin_lapel/no_satin.png') }}');"></div>
                            <p class="text-center text-sm mt-2">No Satin Lapel</p>
                        </div>
                    </label>

                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input type="radio" name="overcoat_satin_lapel" value="Satin Front Lapel" class="hidden peer"
                            {{ old('overcoat_satin_lapel', $selectedovercoat->overcoat_satin_lapel ?? '') == 'Satin Front Lapel' ? 'checked' : '' }}>
                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/satin_lapel/front_satin.png') }}');"></div>
                            <p class="text-center text-sm mt-2">Satin Front Lapel</p>
                        </div>
                    </label>

                    <label class="inline-flex flex-col items-center cursor-pointer">
                        <input type="radio" name="overcoat_satin_lapel" value="Satin Front Including Back Collar" class="hidden peer"
                            {{ old('overcoat_satin_lapel', $selectedovercoat->overcoat_satin_lapel ?? '') == 'Satin Front Including Back Collar' ? 'checked' : '' }}>
                        <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                            <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/satin_lapel/front_back_collar_satin.png') }}');"></div>
                            <p class="text-center text-sm mt-2">Satin Front Including Back Collar</p>
                        </div>
                    </label>
                </div>

                <x-input-error :messages="$errors->get('overcoat_satin_lapel')" class="mt-2" />
            </div>

            <!-- CODES -->
            <br><br>
            <h2 class="text-3xl font-semibold text-gray-800 leading-tight text-center mt-20">
                Fabric / Button Codes
            </h2>

            <br><br>
            <div class="mt-2">
                <x-input-label for="code_overcoat" :value="__('Code Overcoat')" />
                <x-text-input
                    id="code_overcoat"
                    class="block mt-1 w-full uppercase"
                    type="text"
                    name="code_overcoat"
                    :value="old('code_overcoat', $selectedovercoat->code_overcoat ?? '')"
                    required
                    autocomplete="code_overcoat"
                    pattern="[A-Za-z0-9]+"
                    title="Only letters and numbers are allowed"
                />
                <x-input-error :messages="$errors->get('code_overcoat')" class="mt-2" />
            </div>

            <div class="mt-2">
                <x-input-label for="code_overcoat_lining" :value="__('Code Overcoat Lining')" />
                <x-text-input
                    id="code_overcoat_lining"
                    class="block mt-1 w-full uppercase"
                    type="text"
                    name="code_overcoat_lining"
                    :value="old('code_overcoat_lining', $selectedovercoat->code_overcoat_lining ?? '')"
                    required
                    autocomplete="code_overcoat_lining"
                    pattern="[A-Za-z0-9]+"
                    title="Only letters and numbers are allowed"
                />
                <x-input-error :messages="$errors->get('code_overcoat_lining')" class="mt-2" />
            </div>

            <div class="mt-2">
                <x-input-label for="code_overcoat_button" :value="__('Code Overcoat Button')" />
                <x-text-input
                    id="code_overcoat_button"
                    class="block mt-1 w-full uppercase"
                    type="text"
                    name="code_overcoat_button"
                    :value="old('code_overcoat_button', $selectedovercoat->code_overcoat_button ?? '')"
                    required
                    autocomplete="code_overcoat_button"
                    pattern="[A-Za-z0-9]+"
                    title="Only letters and numbers are allowed"
                />
                <x-input-error :messages="$errors->get('code_overcoat_button')" class="mt-2" />
            </div>

            <br><br>

            <div class="mt-2">
                <x-input-label for="code_satin_lapel" :value="__('Code Satin Lapel')" />
                <x-text-input
                    id="code_satin_lapel"
                    class="block mt-1 w-full uppercase"
                    type="text"
                    name="code_satin_lapel"
                    :value="old('code_satin_lapel', $selectedovercoat->code_satin_lapel ?? '')"
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
                    :value="old('code_colour_on_last_button_hole', $selectedovercoat->code_colour_on_last_button_hole ?? '')"
                    autocomplete="code_colour_on_last_button_hole"
                    pattern="[A-Za-z0-9]+"
                    title="Only letters and numbers are allowed"
                />
                <p class="text-xs text-gray-500 mt-1">This is only needed if contrast colour on last button hole has been selected.</p>
                <x-input-error :messages="$errors->get('code_colour_on_last_button_hole')" class="mt-2" />
            </div>

            <div class="mt-20 flex justify-end">
                <x-primary-button class="ms-4">
                    {{ __('Update Overcoat') }}
                </x-primary-button>
            </div>

            <br><br>
    </div>
        </form>
    </div>

</x-admin-layout>
