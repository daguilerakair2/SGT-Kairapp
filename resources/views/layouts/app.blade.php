<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Sistema de gestión de tiendas de la aplicación Kairapp.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kairapp</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('chart')
    @stack('dropzone')
    @livewireStyles
</head>

<body class="font-sans antialiased" style="background-image: url('{{ asset('/images/fondos-regalos-gris.svg') }}');">
    @include('layouts.navigation')
    <main class="sm:ml-64">
        {{ $slot }}
    </main>
    <div class="sm:ml-64">
        @livewire('livewire-ui-modal')
    </div>
    @livewireScripts
    @stack('js')
</body>

</html>
