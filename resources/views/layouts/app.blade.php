<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LokaJaya</title>
    @vite('resources/css/app.css')
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
    @media print {
        body * {
            visibility: hidden;
        }

        #print-area, #print-area * {
            visibility: visible;
        }

        #print-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        /* Hilangkan tombol dan elemen lain */
        .no-print {
            display: none !important;
        }
    }
</style>

</head>
<body class="flex min-h-screen bg-cover bg-center"  style="background-image: url('{{ asset('images/background.png') }}');">
    
    {{-- 🔹 Sidebar --}}
    @include('layouts.navigation')

    {{-- 🔹 Konten Halaman --}}
    <main class="ml-64 p-6 w-full  min-h-screen rounded-tl-xl">
        @yield('content')
    </main>

</body>
</html>
