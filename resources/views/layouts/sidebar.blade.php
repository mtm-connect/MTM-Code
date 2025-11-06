<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/css/app.css') <!-- This assumes you are using Vite for asset compilation -->
</head>
<body class="font-sans bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 h-screen bg-gray-800 text-white">
            <!-- Logo Section -->
            <div class="p-6 flex items-center space-x-4">
                <img src="{{ asset('images/logo.svg') }}" alt="Logo" class="w-8 h-8">
                <span class="text-2xl font-bold">My App</span>
            </div>
    <!-- Navigation Links -->
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                        {{ __('Orders') }}
                    </x-nav-link>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            @yield('content')
        </div>
    </div>
</body>
</html>
