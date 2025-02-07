<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BKM Alumni') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <!-- Header Section -->

    <header>

        <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            @include('layouts.partials.nav')
        </nav>

    </header>

    @include('layouts.partials.sidebar')

    <!-- Sidebar Section -->

    <div class="p-4 my-3 sm:ml-64">
        <div class="p-4 border-2 border-gray-200  rounded-lg dark:border-gray-700 mt-14">
            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            @include('layouts.partials.footer')
        </div>
    </div>








    @stack('modals')

    @livewireScripts

    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</body>

</html>
