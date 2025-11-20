<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased h-full">
    <div class="dark:bg-slate-900 bg-gray-100 flex flex-col justify-center items-center min-h-screen">
        <div class="w-full sm:max-w-md">
            <a href="/" class="flex justify-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <i class="fas fa-store mr-2"></i> Kantin Sekolah
            </a>
            <div class="relative bg-white rounded-lg shadow-md dark:bg-gray-800">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>