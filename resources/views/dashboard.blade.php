@extends('layouts.app')

@section('content')
    <div class="relative flex items-center justify-center min-h-screen">
        <div class="absolute inset-0 bg-gradient-to-br "></div>

        <div class="relative text-center p-6 bg-white/70 backdrop-blur-md rounded-xl shadow-xl max-w-lg">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-3">Selamat Datang,</h1>
            <p class="text-xl font-semibold text-gray-800">
                di Pencatatan Keuangan <br> LokaJaya
            </p>

            <div class="mt-6 flex justify-center gap-4">
                <a href="{{ route('laporan.index') }}"
                    class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                    📄 Lihat Laporan
                </a>
                <a href="{{ route('pengunjung.index') }}"
                    class="px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">
                    ➕ Tambah Data
                </a>
            </div>
        </div>
    </div>
@endsection
