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
    <body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-pink-300 via-purple-300 to-sky-300">
        <div class="mt-8">
            <a href="/" >
            <div class=" p-4 rounded-3xl bg-white/40 backdrop-blur-md shadow-lg">
    <x-application-logo class="w-full text-pink-600 fill-current" />
</div>
</a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white/90 shadow-lg overflow-hidden sm:rounded-2xl border border-pink-200">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
