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

<body class="font-sans antialiased">

    <div
        class="min-h-screen flex items-center justify-center relative bg-gradient-to-br from-blue-50 via-white to-blue-100">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('{{ asset('images/background.png') }}');"></div>

        <!-- Konten dengan kotak putih transparan -->
        <div class="relative w-full max-w-md px-6 py-6 rounded-xl shadow-lg"
            style="background-color: rgba(255, 255, 255, 0.85); backdrop-filter: blur(8px); box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
            {{ $slot }}
        </div>
    </div>

</body>

</html>
