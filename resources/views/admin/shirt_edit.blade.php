<x-admin-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-3xl text-white leading-tight">
      Edit Shirt
    </h2>
  </x-slot>


    <!-- SPACING / MARGINS -->
    <div class="mt-16 mx-40">

      <h2 class="font-semibold text-m text-gray-800 leading-tight mb-10 text-center">
        Order Number: (#{{ $orders->order_number }})
      </h2>

      <!-- Session Status -->
      <x-auth-session-status class="mb-4" :status="session('status')" />

      <form method="POST" action="{{ route('shirt.update', $selectedshirt->id) }}">
        @csrf
        @method('PUT')

        <!-- Measurement Dropdown with Emerald-950 background -->
        <div class="p-4 rounded-xl mt-8">
          <div class="mt-0 flex items-center space-x-4">
            <x-input-label for="measurement_id" :value="__('For')" class="text-lg font-semibold text-black" />

            @php
              $currentMeasurementId = old('measurement_id', $selectedshirt->measurement_id ?? '');
            @endphp

            <select
              id="measurement_id"
              name="measurement_id"
              class="block w-full p-4 border-gray-300 bg-white focus:text-black focus:font-bold focus:bg-white focus:bg-opacity-10 focus:border-gray-300 rounded-xl focus:ring-white"
              required
            >
              <!-- Placeholder option (acts like placeholder) -->
              <option value="" disabled {{ $currentMeasurementId === '' ? 'selected' : '' }}>
                {{ __('Select Measurement') }}
              </option>

              @foreach ($measurements as $measurement)
                <option value="{{ $measurement->id }}" {{ (string)$currentMeasurementId === (string)$measurement->id ? 'selected' : '' }}>
                  {{ $measurement->name }}
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

          @php
            $currentCollar = old('collar', $selectedshirt->collar ?? '');
          @endphp

          <div class="mt-4 grid grid-cols-4 gap-4">
            <!-- Classic -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="collar" value="Classic" class="hidden peer" {{ $currentCollar === 'Classic' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collars/classic.png') }}');"></div>
                <p class="text-center text-sm mt-2">Classic</p>
              </div>
            </label>

            <!-- Cutaway -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="collar" value="Cutaway" class="hidden peer" {{ $currentCollar === 'Cutaway' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collars/cutaway.png') }}');"></div>
                <p class="text-center text-sm mt-2">Cutaway</p>
              </div>
            </label>

            <!-- Italian Spread -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="collar" value="Italian Spread" class="hidden peer" {{ $currentCollar === 'Italian Spread' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collars/italian-spread.png') }}');"></div>
                <p class="text-center text-sm mt-2">Italian Spread</p>
              </div>
            </label>

            <!-- Special 1 -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="collar" value="Special 1" class="hidden peer" {{ $currentCollar === 'Special 1' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collars/special1.png') }}');"></div>
                <p class="text-center text-sm mt-2">Special 1</p>
              </div>
            </label>

            <!-- Special 2 -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="collar" value="Special 2" class="hidden peer" {{ $currentCollar === 'Special 2' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collars/special2.png') }}');"></div>
                <p class="text-center text-sm mt-2">Special 2</p>
              </div>
            </label>
          </div>
        </div>

        <!-- Collar Buttons Radio Buttons -->
        <div class="mt-20 border-emerald-950">
          <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="collar_buttons" :value="__('Collar Buttons')" />

          @php
            $currentCollarButtons = old('collar_buttons', $selectedshirt->collar_buttons ?? '');
          @endphp

          <div class="mt-4 grid grid-cols-4 gap-4">
            <!-- 1 Button -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="collar_buttons" value="1 Button" class="hidden peer" {{ $currentCollarButtons === '1 Button' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collar_buttons/1_button.png') }}');"></div>
                <p class="text-center text-sm mt-2">1 Button</p>
              </div>
            </label>

            <!-- 2 Buttons Classic -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="collar_buttons" value="2 Buttons Classic" class="hidden peer" {{ $currentCollarButtons === '2 Buttons Classic' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collar_buttons/2_buttons_classic.png') }}');"></div>
                <p class="text-center text-sm mt-2">2 Buttons Classic</p>
              </div>
            </label>

            <!-- 2 Buttons Tall -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="collar_buttons" value="2 Buttons Tall" class="hidden peer" {{ $currentCollarButtons === '2 Buttons Tall' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collar_buttons/2_buttons_tall.png') }}');"></div>
                <p class="text-center text-sm mt-2">2 Buttons Tall</p>
              </div>
            </label>

            <!-- 3 Buttons -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="collar_buttons" value="3 Buttons" class="hidden peer" {{ $currentCollarButtons === '3 Buttons' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collar_buttons/3_buttons.png') }}');"></div>
                <p class="text-center text-sm mt-2">3 Buttons</p>
              </div>
            </label>
          </div>

          <x-input-error :messages="$errors->get('collar_buttons')" class="mt-2" />
        </div>

        <!-- Collar Button Down Radio Buttons -->
        <div class="mt-20 border-emerald-950">
          <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="collar_button_down" :value="__('Collar Button Down')" />

          @php
            $currentCollarButtonDown = old('collar_button_down', $selectedshirt->collar_button_down ?? '');
          @endphp

          <div class="mt-4 grid grid-cols-3 gap-4">
            <!-- No Button Down -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="collar_button_down" value="No Button Down" class="hidden peer" {{ $currentCollarButtonDown === 'No Button Down' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collar_buttons/no_button_down.png') }}');"></div>
                <p class="text-center text-sm mt-2">No Button Down</p>
              </div>
            </label>

            <!-- Button Down -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="collar_button_down" value="Button Down" class="hidden peer" {{ $currentCollarButtonDown === 'Button Down' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collar_buttons/button_down.png') }}');"></div>
                <p class="text-center text-sm mt-2">Button Down</p>
              </div>
            </label>

            <!-- Hidden Button Down -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="collar_button_down" value="Hidden Button Down" class="hidden peer" {{ $currentCollarButtonDown === 'Hidden Button Down' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/collar_buttons/hidden_button_down.png') }}');"></div>
                <p class="text-center text-sm mt-2">Hidden Button Down</p>
              </div>
            </label>
          </div>

          <x-input-error :messages="$errors->get('collar_button_down')" class="mt-2" />
        </div>

        <!-- Cuff Radio Buttons -->
        <div class="mt-20 border-emerald-950">
          <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="cuff" :value="__('Cuff')" />

          @php
            $currentCuff = old('cuff', $selectedshirt->cuff ?? '');
          @endphp

          <div class="mt-4 grid grid-cols-4 gap-4">
            <!-- 1 Button Round -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="cuff" value="1 Button Round" class="hidden peer" {{ $currentCuff === '1 Button Round' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/cuffs/1_button_round.png') }}');"></div>
                <p class="text-center text-sm mt-2">1 Button Round</p>
              </div>
            </label>

            <!-- 2 Button Round -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="cuff" value="2 Button Round" class="hidden peer" {{ $currentCuff === '2 Button Round' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/cuffs/2_button_round.png') }}');"></div>
                <p class="text-center text-sm mt-2">2 Button Round</p>
              </div>
            </label>

            <!-- 1 Button Angle -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="cuff" value="1 Button Angle" class="hidden peer" {{ $currentCuff === '1 Button Angle' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/cuffs/1_button_angle.png') }}');"></div>
                <p class="text-center text-sm mt-2">1 Button Angle</p>
              </div>
            </label>

            <!-- 2 Button Angle -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="cuff" value="2 Button Angle" class="hidden peer" {{ $currentCuff === '2 Button Angle' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/cuffs/2_button_angle.png') }}');"></div>
                <p class="text-center text-sm mt-2">2 Button Angle</p>
              </div>
            </label>

            <!-- French Square -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="cuff" value="French Square" class="hidden peer" {{ $currentCuff === 'French Square' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/cuffs/french_square.png') }}');"></div>
                <p class="text-center text-sm mt-2">French Square</p>
              </div>
            </label>

            <!-- French Angle -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="cuff" value="French Angle" class="hidden peer" {{ $currentCuff === 'French Angle' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/cuffs/french_angle.png') }}');"></div>
                <p class="text-center text-sm mt-2">French Angle</p>
              </div>
            </label>

            <!-- Cocktail -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="cuff" value="Cocktail" class="hidden peer" {{ $currentCuff === 'Cocktail' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/cuffs/cocktail.png') }}');"></div>
                <p class="text-center text-sm mt-2">Cocktail</p>
              </div>
            </label>
          </div>

          <x-input-error :messages="$errors->get('cuff')" class="mt-2" />
        </div>

        <!-- Contrast Radio Buttons -->
        <div class="mt-20 border-emerald-950">
          <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="contrast" :value="__('Contrast')" />

          @php
            $currentContrast = old('contrast', $selectedshirt->contrast ?? '');
          @endphp

          <div class="mt-4 grid grid-cols-3 gap-4">
            <!-- No Contrast -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="contrast" value="No Contrast" class="hidden peer" {{ $currentContrast === 'No Contrast' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/contrasts/no_contrast.png') }}');"></div>
                <p class="text-center text-sm mt-2">No Contrast</p>
              </div>
            </label>

            <!-- Contrast 1 -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="contrast" value="Contrast 1" class="hidden peer" {{ $currentContrast === 'Contrast 1' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/contrasts/contrast_1.png') }}');"></div>
                <p class="text-center text-sm mt-2">Contrast 1</p>
              </div>
            </label>

            <!-- Contrast 2 -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="contrast" value="Contrast 2" class="hidden peer" {{ $currentContrast === 'Contrast 2' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/contrasts/contrast_2.png') }}');"></div>
                <p class="text-center text-sm mt-2">Contrast 2</p>
              </div>
            </label>
          </div>

          <x-input-error :messages="$errors->get('contrast')" class="mt-2" />
        </div>

        <!-- Placket Radio Buttons -->
        <div class="mt-20 border-emerald-950">
          <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="placket" :value="__('Placket')" />

          @php
            $currentPlacket = old('placket', $selectedshirt->placket ?? '');
          @endphp

          <div class="mt-4 grid grid-cols-3 gap-4">
            <!-- Standard Placket -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="placket" value="Standard Placket" class="hidden peer" {{ $currentPlacket === 'Standard Placket' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/placket/standard.png') }}');"></div>
                <p class="text-center text-sm mt-2">Standard Placket</p>
              </div>
            </label>

            <!-- No Placket -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="placket" value="No Placket" class="hidden peer" {{ $currentPlacket === 'No Placket' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/placket/no.png') }}');"></div>
                <p class="text-center text-sm mt-2">No Placket</p>
              </div>
            </label>

            <!-- Concealed Placket -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="placket" value="Concealed Placket" class="hidden peer" {{ $currentPlacket === 'Concealed Placket' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/placket/concealed.png') }}');"></div>
                <p class="text-center text-sm mt-2">Concealed Placket</p>
              </div>
            </label>
          </div>

          <x-input-error :messages="$errors->get('placket')" class="mt-2" />
        </div>

        <!-- Pleat Radio Buttons -->
        <div class="mt-20 border-emerald-950">
          <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="pleat" :value="__('Pleat')" />

          @php
            $currentPleat = old('pleat', $selectedshirt->pleat ?? '');
          @endphp

          <div class="mt-4 grid grid-cols-3 gap-4">
            <!-- Two Side Pleat -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="pleat" value="Two Side Pleat" class="hidden peer" {{ $currentPleat === 'Two Side Pleat' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/pleat/two_side.png') }}');"></div>
                <p class="text-center text-sm mt-2">Two Side Pleat</p>
              </div>
            </label>

            <!-- Center Pleat -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="pleat" value="Center Pleat" class="hidden peer" {{ $currentPleat === 'Center Pleat' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/pleat/center.png') }}');"></div>
                <p class="text-center text-sm mt-2">Center Pleat</p>
              </div>
            </label>

            <!-- No Pleat -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="pleat" value="No Pleat" class="hidden peer" {{ $currentPleat === 'No Pleat' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/pleat/no.png') }}');"></div>
                <p class="text-center text-sm mt-2">No Pleat</p>
              </div>
            </label>
          </div>

          <x-input-error :messages="$errors->get('pleat')" class="mt-2" />
        </div>

        <!-- Bottom Radio Buttons -->
        <div class="mt-20 border-emerald-950">
          <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="bottom" :value="__('Bottom')" />

          @php
            $currentBottom = old('bottom', $selectedshirt->bottom ?? '');
          @endphp

          <div class="mt-4 grid grid-cols-4 gap-4">
            <!-- Round Bottom -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="bottom" value="Round Bottom" class="hidden peer" {{ $currentBottom === 'Round Bottom' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/bottom/round.png') }}');"></div>
                <p class="text-center text-sm mt-2">Round Bottom</p>
              </div>
            </label>

            <!-- Straight Bottom -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="bottom" value="Straight Bottom" class="hidden peer" {{ $currentBottom === 'Straight Bottom' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/bottom/straight.png') }}');"></div>
                <p class="text-center text-sm mt-2">Straight Bottom</p>
              </div>
            </label>
          </div>

          <x-input-error :messages="$errors->get('bottom')" class="mt-2" />
        </div>

        <!-- Pocket Radio Buttons -->
        <div class="mt-20 border-emerald-950">
          <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="pocket" :value="__('Pocket')" />

          @php
            $currentPocket = old('pocket', $selectedshirt->pocket ?? '');
          @endphp

          <div class="mt-4 grid grid-cols-4 gap-4">
            <!-- Round -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="pocket" value="Round" class="hidden peer" {{ $currentPocket === 'Round' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/pocket/round.png') }}');"></div>
                <p class="text-center text-sm mt-2">Round</p>
              </div>
            </label>

            <!-- Angle -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="pocket" value="Angle" class="hidden peer" {{ $currentPocket === 'Angle' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/pocket/angle.png') }}');"></div>
                <p class="text-center text-sm mt-2">Angle</p>
              </div>
            </label>

            <!-- Pointed -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="pocket" value="Pointed" class="hidden peer" {{ $currentPocket === 'Pointed' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/pocket/pointed.png') }}');"></div>
                <p class="text-center text-sm mt-2">Pointed</p>
              </div>
            </label>

            <!-- No Pocket -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="pocket" value="No Pocket" class="hidden peer" {{ $currentPocket === 'No Pocket' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/pocket/no.png') }}');"></div>
                <p class="text-center text-sm mt-2">No Pocket</p>
              </div>
            </label>
          </div>

          <x-input-error :messages="$errors->get('pocket')" class="mt-2" />
        </div>

        <!-- Fit Radio Buttons -->
        <div class="mt-20 border-emerald-950">
          <x-input-label class="text-l text-center py-2 px-4 rounded-t-lg bg-emerald-950 text-white" for="fit" :value="__('Fit')" />

          @php
            $currentFit = old('fit', $selectedshirt->fit ?? '');
          @endphp

          <div class="mt-4 grid grid-cols-3 gap-4">
            <!-- Regular -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="fit" value="Regular" class="hidden peer" {{ $currentFit === 'Regular' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/fit/regular.png') }}');"></div>
                <p class="text-center text-sm mt-2">Regular</p>
              </div>
            </label>

            <!-- Fitted -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="fit" value="Fitted" class="hidden peer" {{ $currentFit === 'Fitted' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/fit/fitted.png') }}');"></div>
                <p class="text-center text-sm mt-2">Fitted</p>
              </div>
            </label>

            <!-- Slim Fit -->
            <label class="inline-flex flex-col items-center cursor-pointer">
              <input type="radio" name="fit" value="Slim Fit" class="hidden peer" {{ $currentFit === 'Slim Fit' ? 'checked' : '' }}>
              <div class="w-64 h-80 p-5 bg-cover bg-center rounded-xl border-2 peer-checked:border-emerald-950 flex flex-col items-center justify-center">
                <div class="w-full h-full bg-cover bg-center rounded-lg" style="background-image: url('{{ asset('images/shirt/fit/slim.png') }}');"></div>
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
            :value="old('shirt_fabric_code', $selectedshirt->shirt_fabric_code ?? '')"
            placeholder="e.g. SF123"
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
            :value="old('shirt_button_code', $selectedshirt->shirt_button_code ?? '')"
            placeholder="e.g. BTN45"
            required
            autocomplete="shirt_button_code"
            pattern="[A-Za-z0-9]+"
            title="Only letters and numbers are allowed"
          />
          <x-input-error :messages="$errors->get('shirt_button_code')" class="mt-2" />
        </div>

        <!-- Shirt Contrast Code -->
        <div class="mt-2">
          <x-input-label for="shirt_contrast_code" :value="__('Shirt Contrast Code')" />
          <x-text-input
            id="shirt_contrast_code"
            class="block mt-1 w-full uppercase"
            type="text"
            name="shirt_contrast_code"
            :value="old('shirt_contrast_code', $selectedshirt->shirt_contrast_code ?? '')"
            placeholder="e.g. CT09 (only if selected)"
            autocomplete="shirt_contrast_code"
            pattern="[A-Za-z0-9]+"
            title="Only letters and numbers are allowed"
          />
          <p class="text-xs text-gray-500 mt-1">Only needed if contrast colour option has been selected.</p>
          <x-input-error :messages="$errors->get('shirt_contrast_code')" class="mt-2" />
        </div>

        <div class="mt-20 flex justify-end">
          <x-primary-button class="ms-4">
            {{ __('Update Shirt') }}
          </x-primary-button>
        </div>

        <br><br>
      </form>
    </div>

</x-admin-layout>
