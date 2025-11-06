<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-white leading-tight leading-tight">
       Add Measurement
        </h2>
    </x-slot>

    <x-guest-layout>

<!-- SPACING / MARGINS -->
<div class=" mt-11 mx-96">

    <h2 class="font-semibold text-m text-gray-800 leading-tight mb-10 text-center">
            Order Number: (#{{ $orders->order_number }})
        </h2>

        <br><br>
<h2 class="text-3xl font-semibold text-gray-800 leading-tight text-center">
    Measurments
</h2>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
   
    <form method="POST" action="{{ route('measurments.store',['id' => $orders->id]) }}">
        @csrf
    
         <!-- Name -->
         <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
     
         <!-- DOB -->
         <div class="mt-4">
    <x-input-label for="dob" :value="__('Date of Birth')" />
    <x-text-input 
        id="dob" 
        class="block mt-1 w-full" 
        type="date" 
        name="dob" 
        :value="old('dob')" 
        required 
        autofocus 
        autocomplete="bday" 
    />
    <x-input-error :messages="$errors->get('dob')" class="mt-2" />
</div>

<!-- Gender -->
<div class="mt-4">
    <x-input-label for="gender" :value="__('Gender')" />

    <div class="mt-2">
        <label for="male" class="inline-flex items-center">
            <input type="radio" id="male" name="gender" value="male" class="form-radio bg focus:ring-emerald-950"  :checked="old('gender') == 'male'" />
            <span class="ml-2">{{ __('Male') }}</span>
        </label>

        <label for="female" class="inline-flex items-center ml-6">
            <input type="radio" id="female" name="gender" value="female" class="form-radio focus:ring-emerald-950" :checked="old('gender') == 'female'" />
            <span class="ml-2">{{ __('Female') }}</span>
        </label>
    </div>

    <!-- Error message styled as an alert with emerald-950 background -->
    <x-input-error :messages="$errors->get('gender')" class="  p-2 rounded-md" />
</div>

<!-- Height -->
<div class="mt-4">
    <x-input-label for="height" :value="__('Height (in cm)')" />
    <div class="flex items-center mt-1">
        <x-text-input 
            id="height" 
            class="block w-full" 
            type="number" 
            name="height" 
            :value="old('height')" 
            required 
            autofocus 
            autocomplete="height" 
            placeholder="Enter height"
        />
        <span class="ml-2 text-gray-500">cm</span>
    </div>
    <x-input-error :messages="$errors->get('height')" class="mt-2" />
</div>


<!-- Weight -->
<div class="mt-4">
    <x-input-label for="weight" :value="__('Weight (in kg)')" />
    <div class="flex items-center mt-1">
        <x-text-input 
            id="weight" 
            class="block w-full" 
            type="number" 
            name="weight" 
            :value="old('weight')" 
            required 
            autofocus 
            autocomplete="weight" 
            placeholder="Enter weight"
        />
        <span class="ml-2 text-gray-500">kg</span>
    </div>
    <x-input-error :messages="$errors->get('weight')" class="mt-2" />
</div>

<!-- Shoulders -->
<div class="mt-4">
    <x-input-label for="shoulders" :value="__('Shoulders (in cm)')" />
    <div class="flex items-center mt-1">
        <x-text-input 
            id="shoulders" 
            class="block w-full" 
            type="number" 
            name="shoulders" 
            :value="old('shoulders')" 
            required 
            autofocus 
            autocomplete="shoulders" 
            placeholder="Enter shoulder width"
        />
        <span class="ml-2 text-gray-500">cm</span>
    </div>
    <x-input-error :messages="$errors->get('shoulders')" class="mt-2" />
</div>

<!-- Sleeve Length -->
<div class="mt-4">
    <x-input-label for="sleeve_length" :value="__('Sleeve Length (in cm)')" />
    <div class="flex items-center mt-1">
        <x-text-input 
            id="sleeve_length" 
            class="block w-full" 
            type="number" 
            name="sleeve_length" 
            :value="old('sleeve_length')" 
            required 
            autofocus 
            autocomplete="sleeve_length" 
            placeholder="Enter sleeve_length"
        />
        <span class="ml-4 text-gray-500">cm</span>
    </div>
    <x-input-error :messages="$errors->get('sleeve_length')" class="mt-2" />
</div>

<!-- Bicep -->
<div class="mt-4">
    <x-input-label for="bicep" :value="__('Bicep (in cm)')" />
    <div class="flex items-center mt-1">
        <x-text-input 
            id="bicep" 
            class="block w-full" 
            type="number" 
            name="bicep" 
            :value="old('bicep')" 
            required 
            autofocus 
            autocomplete="bicep" 
            placeholder="Enter bicep size"
        />
        <span class="ml-4 text-gray-500">cm</span>
    </div>
    <x-input-error :messages="$errors->get('bicep')" class="mt-2" />
</div>

<!-- Wrist -->
<div class="mt-4">
    <x-input-label for="wrist" :value="__('Wrist (in cm)')" />
    <div class="flex items-center mt-1">
        <x-text-input 
            id="wrist" 
            class="block w-full" 
            type="number" 
            name="wrist" 
            :value="old('wrist')" 
            required 
            autofocus 
            autocomplete="wrist" 
            placeholder="Enter wrist size"
        />
        <span class="ml-4 text-gray-500">cm</span>
    </div>
    <x-input-error :messages="$errors->get('wrist')" class="mt-2" />
</div>

<!-- Chest -->
<div class="mt-4">
    <x-input-label for="chest" :value="__('Chest (in cm)')" />
    <div class="flex items-center mt-1">
        <x-text-input 
            id="chest" 
            class="block w-full" 
            type="number" 
            name="chest" 
            :value="old('chest')" 
            required 
            autofocus 
            autocomplete="chest" 
            placeholder="Enter chest size"
        />
        <span class="ml-4 text-gray-500">cm</span>
    </div>
    <x-input-error :messages="$errors->get('chest')" class="mt-2" />
</div>

<!-- Belly -->
<div class="mt-4">
    <x-input-label for="belly" :value="__('Belly (in cm)')" />
    <div class="flex items-center mt-1">
        <x-text-input 
            id="belly" 
            class="block w-full" 
            type="number" 
            name="belly" 
            :value="old('belly')" 
            required 
            autofocus 
            autocomplete="belly" 
            placeholder="Enter belly size"
        />
        <span class="ml-4 text-gray-500">cm</span>
    </div>
    <x-input-error :messages="$errors->get('belly')" class="mt-2" />
</div>

<!-- Waist -->
<div class="mt-4">
    <x-input-label for="waist" :value="__('Waist (in cm)')" />
    <div class="flex items-center mt-1">
        <x-text-input 
            id="waist" 
            class="block w-full" 
            type="number" 
            name="waist" 
            :value="old('waist')" 
            required 
            autofocus 
            autocomplete="waist" 
            placeholder="Enter waist size"
        />
        <span class="ml-4 text-gray-500">cm</span>
    </div>
    <x-input-error :messages="$errors->get('waist')" class="mt-2" />
</div>

<!-- Hip -->
<div class="mt-4">
    <x-input-label for="hip" :value="__('Hip (in cm)')" />
    <div class="flex items-center mt-1">
        <x-text-input 
            id="hip" 
            class="block w-full" 
            type="number" 
            name="hip" 
            :value="old('hip')" 
            required 
            autofocus 
            autocomplete="hip" 
            placeholder="Enter hip size"
        />
        <span class="ml-4 text-gray-500">cm</span>
    </div>
    <x-input-error :messages="$errors->get('hip')" class="mt-2" />
</div>

<!-- Thigh -->
<div class="mt-4">
    <x-input-label for="thigh" :value="__('Thigh (in cm)')" />
    <div class="flex items-center mt-1">
        <x-text-input 
            id="thigh" 
            class="block w-full" 
            type="number" 
            name="thigh" 
            :value="old('thigh')" 
            required 
            autofocus 
            autocomplete="thigh" 
            placeholder="Enter thigh size"
        />
        <span class="ml-4 text-gray-500">cm</span>
    </div>
    <x-input-error :messages="$errors->get('thigh')" class="mt-2" />
</div>

<!-- Knee -->
<div class="mt-4">
    <x-input-label for="knee" :value="__('Knee (in cm)')" />
    <div class="flex items-center mt-1">
        <x-text-input 
            id="knee" 
            class="block w-full" 
            type="number" 
            name="knee" 
            :value="old('knee')" 
            required 
            autofocus 
            autocomplete="knee" 
            placeholder="Enter knee size"
        />
        <span class="ml-4 text-gray-500">cm</span>
    </div>
    <x-input-error :messages="$errors->get('knee')" class="mt-2" />
</div>

<!-- Cuff -->
<div class="mt-4">
    <x-input-label for="cuff" :value="__('Cuff (in cm)')" />
    <div class="flex items-center mt-1">
        <x-text-input 
            id="cuff" 
            class="block w-full" 
            type="number" 
            name="cuff" 
            :value="old('cuff')" 
            required 
            autofocus 
            autocomplete="cuff" 
            placeholder="Enter cuff size"
        />
        <span class="ml-4 text-gray-500">cm</span>
    </div>
    <x-input-error :messages="$errors->get('cuff')" class="mt-2" />
</div>

<!-- Outside Leg Length -->
<div class="mt-4">
    <x-input-label for="outside_leg_length" :value="__('Outside Leg Length (in cm)')" />
    <div class="flex items-center mt-1">
        <x-text-input 
            id="outside_leg_length" 
            class="block w-full" 
            type="number" 
            name="outside_leg_length" 
            :value="old('outside_leg_length')" 
            required 
            autofocus 
            autocomplete="outside_leg_length" 
            placeholder="Enter outside leg length"
        />
        <span class="ml-4 text-gray-500">cm</span>
    </div>
    <x-input-error :messages="$errors->get('outside_leg_length')" class="mt-2" />
</div>

<!-- Neck -->
<div class="mt-4">
    <x-input-label for="neck" :value="__('Neck (in cm)')" />
    <div class="flex items-center mt-1">
        <x-text-input 
            id="neck" 
            class="block w-full" 
            type="number" 
            name="neck" 
            :value="old('neck')" 
            required 
            autofocus 
            autocomplete="neck" 
            placeholder="Enter neck size"
        />
        <span class="ml-4 text-gray-500">cm</span>
    </div>
    <x-input-error :messages="$errors->get('neck')" class="mt-2" />
</div>

<!-- Additional Measurements Heading -->
<div class="mt-6">
    <h2 class="text-lg font-semibold text-gray-700">Additional Measurements</h2>
    <p class="text-sm text-gray-500">Please provide additional measurements below:</p>
</div>

<!-- Crotch -->
<div class="mt-4">
    <x-input-label for="crotch" :value="__('Crotch (in cm)')" />
    <div class="flex items-center mt-1">
        <x-text-input 
            id="crotch" 
            class="block w-full" 
            type="number" 
            name="crotch" 
            :value="old('crotch')" 
            autofocus 
            autocomplete="crotch" 
            placeholder="Enter crotch size"
        />
        <span class="ml-4 text-gray-500">cm</span>
    </div>
    <x-input-error :messages="$errors->get('crotch')" class="mt-2" />
</div>

<!-- Inside Leg Length -->
<div class="mt-4">
    <x-input-label for="inside_leg_length" :value="__('Inside Leg Length (in cm)')" />
    <div class="flex items-center mt-1">
        <x-text-input 
            id="inside_leg_length" 
            class="block w-full" 
            type="number" 
            name="inside_leg_length" 
            :value="old('inside_leg_length')" 
            autofocus 
            autocomplete="inside_leg_length" 
            placeholder="Enter inside leg length"
        />
        <span class="ml-4 text-gray-500">cm</span>
    </div>
    <x-input-error :messages="$errors->get('inside_leg_length')" class="mt-2" />
</div>

<!-- Inside Sleeve Length -->
<div class="mt-4">
    <x-input-label for="inside_sleeve_length" :value="__('Inside Sleeve Length (in cm)')" />
    <div class="flex items-center mt-1">
        <x-text-input 
            id="inside_sleeve_length" 
            class="block w-full" 
            type="number" 
            name="inside_sleeve_length" 
            :value="old('inside_sleeve_length')" 
            autofocus 
            autocomplete="inside_sleeve_length" 
            placeholder="Enter inside sleeve length"
        />
        <span class="ml-4 text-gray-500">cm</span>
    </div>
    <x-input-error :messages="$errors->get('inside_sleeve_length')" class="mt-2" />
</div>

<!-- Pants Cuff Width -->
<div class="mt-4">
    <x-input-label for="pants_cuff_width" :value="__('Pants Cuff Width (in cm)')" />
    <div class="flex items-center mt-1">
        <x-text-input 
            id="pants_cuff_width" 
            class="block w-full" 
            type="number" 
            name="pants_cuff_width" 
            :value="old('pants_cuff_width')" 
            autofocus 
            autocomplete="pants_cuff_width" 
            placeholder="Enter pants cuff width"
        />
        <span class="ml-4 text-gray-500">cm</span>
    </div>
    <x-input-error :messages="$errors->get('pants_cuff_width')" class="mt-2" />
</div>

<!-- Jacket Length Front -->
<div class="mt-4">
    <x-input-label for="jacket_length_front" :value="__('Jacket Length Front (in cm)')" />
    <div class="flex items-center mt-1">
        <x-text-input 
            id="jacket_length_front" 
            class="block w-full" 
            type="number" 
            name="jacket_length_front" 
            :value="old('jacket_length_front')" 
            autofocus 
            autocomplete="jacket_length_front" 
            placeholder="Enter jacket length front"
        />
        <span class="ml-4 text-gray-500">cm</span>
    </div>
    <x-input-error :messages="$errors->get('jacket_length_front')" class="mt-2" />
</div>
</div>


     <!-- SPACING / MARGINS -->
     <div class=" mt-16 mx-40">
<!-- Body Shape -->
<div class="mt-6">
<br><br>
<h2 class="text-3xl font-semibold text-gray-800 leading-tight text-center">
    Body Shape
</h2>
</div>

<!-- Shoulders -->
<div class="mt-6 border-emerald-950">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="bs_shoulders" :value="__('Shoulder Type')" />
    
    <div class="mt-4 grid grid-cols-3 gap-6">
        <!-- Normal -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input type="radio" name="bs_shoulders" value="Normal" class="hidden peer" @checked(old('bs_shoulders') == 'Normal') />
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" 
                     style="background-image: url('{{ asset('images/bodyshape/shoulders/normal.png') }}');">
                </div>
                <p class="text-center text-sm mt-2">Normal</p>
            </div>
        </label>

        <!-- Sloping -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input type="radio" name="bs_shoulders" value="Sloping" class="hidden peer" @checked(old('bs_shoulders') == 'Sloping') />
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" 
                     style="background-image: url('{{ asset('images/bodyshape/shoulders/sloping.png') }}');">
                </div>
                <p class="text-center text-sm mt-2">Sloping</p>
            </div>
        </label>

        <!-- Square -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input type="radio" name="bs_shoulders" value="Square" class="hidden peer" @checked(old('bs_shoulders') == 'Square') />
            
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" 
                     style="background-image: url('{{ asset('images/bodyshape/shoulders/square.png') }}');">
                </div>
                <p class="text-center text-sm mt-2">Square</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('bs_shoulders')" class="mt-2" />
</div>


<!-- Chest -->
<div class="mt-20 border-emerald-950">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="bs_chest" :value="__('Chest Type')" />
    
    <div class="mt-4 grid grid-cols-3 gap-6">
        <!-- Normal -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input type="radio" name="bs_chest" value="Normal" class="hidden peer" @checked(old('bs_chest') == 'Normal') />
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/bodyshape/chest/normal.png') }}');"></div>
                <p class="text-center text-sm mt-2">Normal</p>
            </div>
        </label>

        <!-- Muscular -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input type="radio" name="bs_chest" value="Muscular" class="hidden peer" @checked(old('bs_chest') == 'Muscular') />
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/bodyshape/chest/muscular.png') }}');"></div>
                <p class="text-center text-sm mt-2">Muscular</p>
            </div>
        </label>

        <!-- Husky -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input type="radio" name="bs_chest" value="Husky" class="hidden peer" @checked(old('bs_chest') == 'Husky') />
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/bodyshape/chest/husky.png') }}');"></div>
                <p class="text-center text-sm mt-2">Husky</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('bs_chest')" class="mt-2" />
</div>



<!-- Stomach -->
<div class="mt-20 border-emerald-950">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="bs_stomach" :value="__('Stomach Type')" />
    
    <div class="mt-4 grid grid-cols-3 gap-6">
        <!-- Normal -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input type="radio" name="bs_stomach" value="Normal" class="hidden peer" @checked(old('bs_stomach') == 'Normal') />
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/bodyshape/stomach/normal.png') }}');"></div>
                <p class="text-center text-sm mt-2">Normal</p>
            </div>
        </label>

        <!-- Flat -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input type="radio" name="bs_stomach" value="Flat" class="hidden peer" @checked(old('bs_stomach') == 'Flat') />
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/bodyshape/stomach/flat.png') }}');"></div>
                <p class="text-center text-sm mt-2">Flat</p>
            </div>
        </label>

        <!-- Rounded -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input type="radio" name="bs_stomach" value="Rounded" class="hidden peer" @checked(old('bs_stomach') == 'Rounded') />
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/bodyshape/stomach/rounded.png') }}');"></div>
                <p class="text-center text-sm mt-2">Rounded</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('bs_stomach')" class="mt-2" />
</div>


<!-- Posture -->
<div class="mt-20 border-emerald-950">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="bs_posture" :value="__('Posture Type')" />
    
    <div class="mt-4 grid grid-cols-4 gap-6">
        <!-- Scapular Protrusion -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input type="radio" name="bs_posture" value="Scapular Protrusion" class="hidden peer" @checked(old('bs_posture') == 'Scapular Protrusion') />
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" 
                     style="background-image: url('{{ asset('images/bodyshape/posture/scapular_protrusion.png') }}');">
                </div>
                <p class="text-center text-sm mt-2">Scapular Protrusion</p>
            </div>
        </label>

        <!-- Normal -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input type="radio" name="bs_posture" value="Normal" class="hidden peer" @checked(old('bs_posture') == 'Normal') />
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" 
                     style="background-image: url('{{ asset('images/bodyshape/posture/normal.png') }}');">
                </div>
                <p class="text-center text-sm mt-2">Normal</p>
            </div>
        </label>

        <!-- Chest Out -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input type="radio" name="bs_posture" value="Chest Out" class="hidden peer" @checked(old('bs_posture') == 'Chest Out') />
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" 
                     style="background-image: url('{{ asset('images/bodyshape/posture/chest_out.png') }}');">
                </div>
                <p class="text-center text-sm mt-2">Chest Out</p>
            </div>
        </label>

        <!-- Hunch Back -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input type="radio" name="bs_posture" value="Hunch Back" class="hidden peer" @checked(old('bs_posture') == 'Hunch Back') />
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" 
                     style="background-image: url('{{ asset('images/bodyshape/posture/hunch_back.png') }}');">
                </div>
                <p class="text-center text-sm mt-2">Hunch Back</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('bs_posture')" class="mt-2" />
</div>


<!-- Seat -->
<div class="mt-20 border-emerald-950">
    <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="bs_seat" :value="__('Seat Type')" />
    
    <div class="mt-4 grid grid-cols-3 gap-6">
        <!-- Normal -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input type="radio" name="bs_seat" value="Normal" class="hidden peer" @checked(old('bs_seat') == 'Normal') />
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" 
                     style="background-image: url('{{ asset('images/bodyshape/seat/normal.png') }}');">
                </div>
                <p class="text-center text-sm mt-2">Normal</p>
            </div>
        </label>

        <!-- Flat Hips -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input type="radio" name="bs_seat" value="Flat Hips" class="hidden peer" @checked(old('bs_seat') == 'Flat Hips') />
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" 
                     style="background-image: url('{{ asset('images/bodyshape/seat/flat_hips.png') }}');">
                </div>
                <p class="text-center text-sm mt-2">Flat Hips</p>
            </div>
        </label>

        <!-- Raised Hips -->
        <label class="inline-flex flex-col items-center cursor-pointer">
            <input type="radio" name="bs_seat" value="Raised Hips" class="hidden peer" @checked(old('bs_seat') == 'Raised Hips') />
            <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" 
                     style="background-image: url('{{ asset('images/bodyshape/seat/raised_hips.png') }}');">
                </div>
                <p class="text-center text-sm mt-2">Raised Hips</p>
            </div>
        </label>
    </div>

    <x-input-error :messages="$errors->get('bs_seat')" class="mt-2" />
</div>


<!-- SPACING / MARGINS -->
<div class="mt-11 mx-32">

<!-- Special Requirements -->
<div class="mt-4">
<br><br>
<h2 class="text-3xl font-semibold text-gray-800 leading-tight text-center">
    Special Requirements
</h2>
<br>
    <x-input-label for="special_requirements" :value="__('')" />
    <div class="mt-1">
        <textarea 
            id="special_requirements" 
            name="special_requirements" 
            class="block w-full h-32 p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:border-indigo-300"
            placeholder="Enter special requirements"
        >{{ old('special_requirements') }}</textarea>
    </div>
    <x-input-error :messages="$errors->get('special_requirements')" class="mt-2" />
</div>












<div class="mt-20 flex justify-end">
            <x-primary-button class="ms-4">
                {{ __('Add Measurement') }}
            </x-primary-button>
        </div>
        <br><br>
</div>
    </form>

    </div>
</x-guest-layout>
</x-app-layout>