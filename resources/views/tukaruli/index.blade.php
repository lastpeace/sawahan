@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded-xl shadow-md space-y-6">
        <h2 class="text-2xl font-semibold text-center">Tukar Uli (Beredar ➝ Cadangan)</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-100 text-red-800 px-4 py-2 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('tukaruli.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="tanggal" class="block font-medium text-gray-700">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="w-full border-gray-300 rounded-md shadow-sm"
                    value="{{ old('tanggal', now()->toDateString()) }}" required>
                @error('tanggal')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-1">Jumlah Uli yang Ditukar</label>
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm block mb-1">Uli 2.5</label>
                        <input type="number" name="uli_25" min="0"
                            class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('uli_25', 0) }}">
                    </div>
                    <div>
                        <label class="text-sm block mb-1">Uli 5</label>
                        <input type="number" name="uli_5" min="0"
                            class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('uli_5', 0) }}">
                    </div>
                    <div>
                        <label class="text-sm block mb-1">Uli 10</label>
                        <input type="number" name="uli_10" min="0"
                            class="w-full border-gray-300 rounded-md shadow-sm" value="{{ old('uli_10', 0) }}">
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Tukar Sekarang
                </button>
            </div>
        </form>

    </div>
@endsection
