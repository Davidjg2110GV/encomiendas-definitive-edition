<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark"> <!-- Añadido 'dark' para que Tailwind lo reconozca por defecto -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Canguro Express') }}</title> <!-- Personalizado -->

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" /> <!-- Cambiado a Inter para un look más moderno -->

    <!-- Favicon (Opcional, pero recomendado) -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Estilos en línea para una mejor apariencia inicial -->
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-900 text-gray-300">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen flex">
        <!-- ================== SIDEBAR ================== -->
        @include('layouts.partials.sidebar')

        <!-- ================== MAIN CONTENT ================== -->
        <div class="flex-1 flex flex-col w-full">
            <!-- Top Navigation -->
            @include('layouts.navigation')

            <!-- Page Heading (si existe) -->
            @if (isset($header))
                <header class="bg-gray-800/50 backdrop-blur-sm shadow-lg border-b border-gray-700">
                    <div class="max-w-full mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-grow p-4 sm:p-6 lg:p-8">
                {{-- Aquí se inyectará el contenido de tus vistas (ej. dashboard.blade.php) --}}
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- =============== SCRIPTS AL FINAL DEL BODY =============== -->
    <!-- Esto permite que la página se cargue más rápido -->
    <!-- Y aquí se inyectarán los scripts de vistas específicas como el gráfico -->
    @stack('scripts')
</body>
</html>