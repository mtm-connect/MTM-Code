<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    /* Smooth, native-feel scrolling on iOS */
    .scroll-touch { -webkit-overflow-scrolling: touch; }
  </style>
</head>
<body class="font-sans text-white antialiased">

  <!-- Page wrapper -->
  <div class="w-full h-screen overflow-hidden">

    <!-- Exact 50/50 at md+, stacked on mobile -->
    <div class="grid h-full grid-cols-1 md:grid-cols-2">

      <!-- Left image (hidden on mobile) -->
      <div
        class="hidden md:block h-full bg-cover bg-center"
        style="background-image: url('{{ asset('images/reg.jpg') }}');">
      </div>

      <!-- Right: scrollable form column -->
      <div class="h-full overflow-y-auto scroll-touch bg-emerald-950">

        <!-- Sticky header (logo) -->
        <div class="sticky top-0 z-10 bg-emerald-950/95 backdrop-blur px-6 pt-12 pb-3 flex justify-center">
          <img class="h-24 w-auto" src="{{ asset('images/logo4.png') }}" alt="Logo">
        </div>

        <!-- Content -->
        <div class="w-full max-w-sm mx-auto px-0 pb-12">

          <!-- Session Status -->
          <x-auth-session-status class="mb-4" :status="session('status')" />

          <!-- Registration Form -->
          <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
              <x-input-label-dark for="name" :value="__('Name')" />
              <x-text-input-dark id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
              <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Company -->
            <div>
              <x-input-label-dark for="company" :value="__('Company')" />
              <x-text-input-dark id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')" required autocomplete="organization" />
              <x-input-error :messages="$errors->get('company')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
              <x-input-label-dark for="email" :value="__('Email')" />
              <x-text-input-dark id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
              <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Phone Number -->
            <div>
              <x-input-label-dark for="phone_number" :value="__('Phone Number')" />
              <x-text-input-dark id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" value="{{ old('phone_number') }}" required />
              <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            </div>

<!-- Country -->
<div>
  <x-input-label-dark for="country" :value="__('Country')" />

  <div class="relative mt-1">
    <select
      id="country"
      name="country"
      required
      class="block w-full appearance-none rounded-lg bg-transparent text-white font-medium
             border border-white/20 focus:border-white/60 focus:ring-2 focus:ring-emerald-500
             py-3 pl-4 pr-10 leading-6 placeholder-white/60 transition duration-150 ease-in-out"
    >
      <option value="" disabled {{ old('country') ? '' : 'selected' }}>Select a country</option>
      <option class="bg-emerald-950" value="IE" {{ old('country')==='IE'?'selected':'' }}>Ireland</option>
      <option class="bg-emerald-950" value="GB" {{ old('country')==='GB'?'selected':'' }}>United Kingdom</option>
      <option class="bg-emerald-950" value="US" {{ old('country')==='US'?'selected':'' }}>United States</option>
    </select>


  <x-input-error :messages="$errors->get('country')" class="mt-2" />
  <br>
</div>



            <!-- Address 1 -->
            <div>
              <x-input-label-dark for="address_line_1" :value="__('Address Line 1')" />
              <x-text-input-dark id="address_line_1" class="block mt-1 w-full" type="text" name="address_line_1" :value="old('address_line_1')" required autocomplete="address-line1" />
              <x-input-error :messages="$errors->get('address_line_1')" class="mt-2" />
            </div>
            <br>
            <!-- Address 2 (optional) -->
            <div>
              <x-input-label-dark for="address_line_2" :value="__('Address Line 2 (Optional)')" />
              <x-text-input-dark id="address_line_2" class="block mt-1 w-full" type="text" name="address_line_2" :value="old('address_line_2')" autocomplete="address-line2" />
              <x-input-error :messages="$errors->get('address_line_2')" class="mt-2" />
            </div>
            <br>
            <!-- Postcode -->
            <div>
              <x-input-label-dark for="post_code" :value="__('Postcode')" />
              <x-text-input-dark id="post_code" class="block mt-1 w-full" type="text" name="post_code" :value="old('post_code')" required autocomplete="postal-code" pattern="[A-Za-z0-9\s\-]{3,15}" />
              <x-input-error :messages="$errors->get('post_code')" class="mt-2" />
            </div>
            <br>
            <!-- County -->
            <div>
              <x-input-label-dark for="county" :value="__('County')" />
              <x-text-input-dark id="county" class="block mt-1 w-full" type="text" name="county" :value="old('county')" required autocomplete="address-level1" />
              <x-input-error :messages="$errors->get('county')" class="mt-2" />
            </div>
            <br>
            <!-- Password -->
            <div>
              <x-input-label-dark for="password" :value="__('Password')" />
              <x-text-input-dark id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
              <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <br>
            <!-- Confirm Password -->
            <div>
              <x-input-label-dark for="password_confirmation" :value="__('Confirm Password')" />
              <x-text-input-dark id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
              <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            <br>
            <!-- Actions -->
            <div class="flex items-center justify-between pt-2">
              <a class="underline text-sm text-white hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
              </a>
              <x-primary-button-dark class="ms-3">
                {{ __('Register') }}
              </x-primary-button-dark>
            </div>
          </form>

        </div><!-- /content -->
      </div><!-- /right column -->
    </div><!-- /grid -->
  </div><!-- /page wrapper -->

</body>
</html>


