<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="h-screen flex overflow-hidden">
        {{-- Sidebar --}}
        @include('layouts.navigation')

        {{-- Konten Utama --}}
        <main class="flex-1 ml-64 p-6 overflow-hidden">
            @yield('content')
        </main>
    </div>
</body>

</html>
