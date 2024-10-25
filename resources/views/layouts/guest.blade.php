<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistema de gestión de tiendas de la aplicación Kairapp.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kairapp') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen justify-center flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-transparent relative" style="background-image: url('{{ asset('/images/fondos-regalos-gris.svg') }}');">
        {{-- <img class="w-full max-h-full absolute object-cover" src="{{ asset('/images/fondos-regalos-gris.svg') }}"/> --}}
        <div>
            <a href="/">
                <x-application-logo class="relative w-10 h-10 fill-current" />
            </a>
        </div>

        <div class="w-10/12 rounded-lg relative sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg shadow-[0px_3px_10px_0px_#2d3748]">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
