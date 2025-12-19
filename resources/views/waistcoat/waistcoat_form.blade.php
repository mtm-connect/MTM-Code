<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-3xl text-white leading-tight leading-tight">
       Create Waistcoat
        </h2>
    </x-slot>

 

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
        <select id="measurement_id" name="measurement_id"class="block mt-3 w-full p-4 border border-gray-300 bg-gray-300 bg-opacity-10
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
    Waistcoat Construction
</h2>

<div class="mt-6">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="waistcoat_type" :value="__('Waistcoat Type')" />

    <div class="mt-4 grid grid-cols-4 gap-4">
        <!-- Q001+DD4 Point Bottom Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="waistcoat_type" 
                value="Q001+DD4 Point Bottom" 
                class="hidden peer"
                {{ old('waistcoat_type') == 'Q001+DD4 Point Bottom' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/waistcoat_types/Q001-DD4-Point-Bottom.png') }}');">
                    <!-- Image set as background for Q001+DD4 Point Bottom -->
                </div>
                <p class="text-center text-sm mt-2">Q001+DD4 Point Bottom</p>
            </div>
        </label>

        <!-- Q003+DD5 Point Bottom Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="waistcoat_type" 
                value="Q003+DD5 Point Bottom" 
                class="hidden peer"
                {{ old('waistcoat_type') == 'Q003+DD5 Point Bottom' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/waistcoat_types/Q003-DD5-Point-Bottom.png') }}');">
                    <!-- Image set as background for Q003+DD5 Point Bottom -->
                </div>
                <p class="text-center text-sm mt-2">Q003+DD5 Point Bottom</p>
            </div>
        </label>

        <!-- Q004+DD4 Round Bottom Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="waistcoat_type" 
                value="Q004+DD4 Round Bottom" 
                class="hidden peer"
                {{ old('waistcoat_type') == 'Q004+DD4 Round Bottom' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/waistcoat_types/Q004-DD4-Round-Bottom.png') }}');">
                    <!-- Image set as background for Q004+DD4 Round Bottom -->
                </div>
                <p class="text-center text-sm mt-2">Q004+DD4 Round Bottom</p>
            </div>
        </label>

        <!-- Q008+DD4 Point Bottom Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="waistcoat_type" 
                value="Q008+DD4 Point Bottom" 
                class="hidden peer"
                {{ old('waistcoat_type') == 'Q008+DD4 Point Bottom' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/waistcoat_types/Q008-DD4-Point-Bottom.png') }}');">
                    <!-- Image set as background for Q008+DD4 Point Bottom -->
                </div>
                <p class="text-center text-sm mt-2">Q008+DD4 Point Bottom</p>
            </div>
        </label>

        <!-- Q009+DD4 Straight Bottom Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="waistcoat_type" 
                value="Q009+DD4 Straight Bottom" 
                class="hidden peer"
                {{ old('waistcoat_type') == 'Q009+DD4 Straight Bottom' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/waistcoat_types/Q009-DD4-Straight-Bottom.png') }}');">
                    <!-- Image set as background for Q009+DD4 Straight Bottom -->
                </div>
                <p class="text-center text-sm mt-2">Q009+DD4 Straight Bottom</p>
            </div>
        </label>

        <!-- Q012+DD4 Point Bottom Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="waistcoat_type" 
                value="Q012+DD4 Point Bottom" 
                class="hidden peer"
                {{ old('waistcoat_type') == 'Q012+DD4 Point Bottom' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/waistcoat_types/Q012-DD4-Point-Bottom.png') }}');">
                    <!-- Image set as background for Q012+DD4 Point Bottom -->
                </div>
                <p class="text-center text-sm mt-2">Q012+DD4 Point Bottom</p>
            </div>
        </label>

        <!-- Q013+DD4 Straight Bottom Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="waistcoat_type" 
                value="Q013+DD4 Straight Bottom" 
                class="hidden peer"
                {{ old('waistcoat_type') == 'Q013+DD4 Straight Bottom' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/waistcoat_types/Q013-DD4-Straight-Bottom.png') }}');">
                    <!-- Image set as background for Q013+DD4 Straight Bottom -->
                </div>
                <p class="text-center text-sm mt-2">Q013+DD4 Straight Bottom</p>
            </div>
        </label>

        <!-- Q011+DD4 Point Bottom Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="waistcoat_type" 
                value="Q011+DD4 Point Bottom" 
                class="hidden peer"
                {{ old('waistcoat_type') == 'Q011+DD4 Point Bottom' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/waistcoat_types/Q011-DD4-Point-Bottom.png') }}');">
                    <!-- Image set as background for Q011+DD4 Point Bottom -->
                </div>
                <p class="text-center text-sm mt-2">Q011+DD4 Point Bottom</p>
            </div>
        </label>

        <!-- Q010+DD4 Point Bottom Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="waistcoat_type" 
                value="Q010+DD4 Point Bottom" 
                class="hidden peer"
                {{ old('waistcoat_type') == 'Q010+DD4 Point Bottom' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/waistcoat_types/Q010-DD4-Point-Bottom.png') }}');">
                    <!-- Image set as background for Q010+DD4 Point Bottom -->
                </div>
                <p class="text-center text-sm mt-2">Q010+DD4 Point Bottom</p>
            </div>
        </label>

        <!-- Q016+DD4 Point Bottom Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="waistcoat_type" 
                value="Q016+DD4 Point Bottom" 
                class="hidden peer"
                {{ old('waistcoat_type') == 'Q016+DD4 Point Bottom' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/waistcoat_types/Q016-DD4-Point-Bottom.png') }}');">
                    <!-- Image set as background for Q016+DD4 Point Bottom -->
                </div>
                <p class="text-center text-sm mt-2">Q016+DD4 Point Bottom</p>
            </div>
        </label>

        <!-- Q018+DD4 Straight Bottom Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="waistcoat_type" 
                value="Q018+DD4 Straight Bottom" 
                class="hidden peer"
                {{ old('waistcoat_type') == 'Q018+DD4 Straight Bottom' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/waistcoat_types/Q018-DD4-Straight-Bottom.png') }}');">
                    <!-- Image set as background for Q018+DD4 Straight Bottom -->
                </div>
                <p class="text-center text-sm mt-2">Q018+DD4 Straight Bottom</p>
            </div>
        </label>

        <!-- Q019+DD4 Straight Bottom Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="waistcoat_type" 
                value="Q019+DD4 Straight Bottom" 
                class="hidden peer"
                {{ old('waistcoat_type') == 'Q019+DD4 Straight Bottom' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/waistcoat_types/Q019-DD4-Straight-Bottom.png') }}');">
                    <!-- Image set as background for Q019+DD4 Straight Bottom -->
                </div>
                <p class="text-center text-sm mt-2">Q019+DD4 Straight Bottom</p>
            </div>
        </label>

        <!-- Q020+DD4 Point Bottom Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="waistcoat_type" 
                value="Q020+DD4 Point Bottom" 
                class="hidden peer"
                {{ old('waistcoat_type') == 'Q020+DD4 Point Bottom' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/waistcoat_types/Q020-DD4-Point-Bottom.png') }}');">
                    <!-- Image set as background for Q020+DD4 Point Bottom -->
                </div>
                <p class="text-center text-sm mt-2">Q020+DD4 Point Bottom</p>
            </div>
        </label>

        <!-- Q021+DD4 Straight Bottom Option -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input 
                type="radio" 
                name="waistcoat_type" 
                value="Q021+DD4 Straight Bottom" 
                class="hidden peer"
                {{ old('waistcoat_type') == 'Q021+DD4 Straight Bottom' ? 'checked' : '' }}>

            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-lg border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/waistcoat_types/Q021-DD4-Straight-Bottom.png') }}');">
                    <!-- Image set as background for Q021+DD4 Straight Bottom -->
                </div>
                <p class="text-center text-sm mt-2">Q021+DD4 Straight Bottom</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('waistcoat_type')" class="mt-2" />
</div>




<br><br>
<h2 class="text-3xl font-semibold text-gray-800 leading-tight text-center mt-20">
Fabric / Button Codes
</h2>


<!-- Code Waistcoat -->
<div class="mt-2">
    <x-input-label for="code_waistcoat" :value="__('Code Waistcoat')" />
    <x-text-input 
        id="code_waistcoat" 
        class="block mt-1 w-full uppercase" 
        type="text" 
        name="code_waistcoat" 
        :value="old('code_waistcoat')" 
        required 
        autocomplete="code_waistcoat" 
        pattern="[A-Za-z0-9]+" 
        title="Only letters and numbers are allowed"
    />
    <x-input-error :messages="$errors->get('code_waistcoat')" class="mt-2" />
</div>

<!-- Code Waistcoat Button -->
<div class="mt-2">
    <x-input-label for="code_waistcoat_buttons" :value="__('Code Waistcoat Button')" />
    <x-text-input 
        id="code_waistcoat_buttons" 
        class="block mt-1 w-full uppercase" 
        type="text" 
        name="code_waistcoat_buttons" 
        :value="old('code_waistcoat_buttons')" 
        required 
        autocomplete="code_waistcoat_buttons" 
        pattern="[A-Za-z0-9]+" 
        title="Only letters and numbers are allowed"
    />
    <x-input-error :messages="$errors->get('code_waistcoat_buttons')" class="mt-2" />
</div>


        








<div class="mt-20 flex justify-end">
    <x-primary-button class="ms-4">
        {{ __('Create Waistcoat') }}
    </x-primary-button>
</div>

        <br><br>
</div>
    </form>

    </div>

</x-app-layout>