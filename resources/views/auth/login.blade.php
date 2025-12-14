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
    </head>
    <body class="font-sans text-white antialiased ">

        <!-- Content -->
        <div class="  ">

          
<!-- Div for content -->
<div class="w-full pt-0 px-0 overflow-hidden">
    <div class="flex h-screen">
        
        <!-- reg_image div -->
        <div name="reg_image" class="w-1/2  rounded-none h-full  bg-cover bg-center" style="background-image: url('{{ asset('images/login.JPG') }}');"></div> 

        <!-- form_section div -->
        <div name="form_section" class="w-1/2  h-full flex items-center justify-center flex-col bg-emerald-950">
        <div class="logo mb-5">
        <img class='h-24 w-auto' src="{{ asset('images/logo4.png') }}" alt="Logo">
    </div>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="w-full max-w-sm">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label-dark for="email" :value="__('Email')" />
                    <x-text-input-dark id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label-dark class="" for="password" :value="__('Password')" />
                    <x-text-input-dark id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-white">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <!-- Forgot Password & Login Button -->
                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-white hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-primary-button-dark class="ms-3">
                        {{ __('Log in') }}
                    </x-primary-button-dark>
                </div>
            </form>
            <div class="mt-4 text-center">
        <p class="text-sm text-white">
            Don’t have an account?
            <a href="{{ route('register') }}"
               class="underline text-white hover:text-gray-300">
                Register here
            </a>
        </p>
    </div>
        </div>
    </div>
</div>

        </div>
    </body>
</html>











   

