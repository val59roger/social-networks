<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Social-Networks') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gradient-to-b from-indigo-50 to-indigo-100 font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex items-center justify-center px-6 sm:px-8">
            <div class="max-w-md w-full bg-white shadow-lg rounded-lg p-8">
                <div class="flex justify-center mb-6">
                    <a href="/" class="text-indigo-600 hover:text-indigo-700">
                        <x-application-logo class="w-16 h-16 fill-current" />
                    </a>
                </div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
