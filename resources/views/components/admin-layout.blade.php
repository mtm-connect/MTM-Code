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
        <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@300;400;500;700&display=swap" rel="stylesheet">

    

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-emerald-950  ">
            @include('layouts.admin_navigation')
            

         

            <!-- Page Content -->
            <main class="ml-72 h-screen   pt-24 bg-white">
            <div class="bg-white shadow-lg shadow-white rounded-tl-3xl w-full p-2 h-9 fixed z-50"> </div>
               
                {{ $slot }}
           
            </main>
        </div>
    </body>
</html>
