<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ URL::asset('/minotaur.png') }}" type="image/x-icon" class="rounded-lg"/>
        <!-- Add Font Awesome CDN link in your layout's head section -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <!-- Font Awesome CDN -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


        <title>{{ config('app.name', 'AR Minotauring') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <x-footer>
            <div class="bg-gray-100 py-2 text-center w-full mx-auto">
                <h1 class="text-gray-700 font-medium text-sm">
                    Developed by <strong>Gwen Bautista</strong>
                    (<a href="https://www.instagram.com/_aka.gen" target="_blank" rel="noopener noreferrer" class="text-blue-500 hover:text-blue-700">
                       <i class="fab fa-instagram"></i> _aka.gen
                    </a>)
                </h1>
                <h1 class="text-gray-500 font-medium text-sm mt-2">
                    &copy; 2024 Edition.
                </h1>
            </div>
        </x-footer> 
    </body>
</html>
