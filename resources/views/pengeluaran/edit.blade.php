@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">✏️ Edit Data Pengeluaran</h1>

    <div class="bg-white p-6 rounded-xl shadow-lg">
        <form action="{{ route('pengeluaran.update', $pengeluaran->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-semibold mb-1">📅 Tanggal</label>
                <input type="date" name="tanggal" value="{{ $pengeluaran->tanggal }}" 
                       class="border p-2 w-full rounded-lg focus:ring-2 focus:ring-blue-400" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">🎭 Hiburan</label>
                <input type="number" name="hiburan" value="{{ $pengeluaran->hiburan }}" 
                       class="border p-2 w-full rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block font-semibold mb-1">🍳 Sarapan</label>
                <input type="number" name="sarapan" value="{{ $pengeluaran->sarapan }}" 
                       class="border p-2 w-full rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block font-semibold mb-1">☕ Kopi</label>
                <input type="number" name="kopi" value="{{ $pengeluaran->kopi }}" 
                       class="border p-2 w-full rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block font-semibold mb-1">💰 Simpanan Wajib</label>
                <input type="number" name="simpanan_wajib" value="{{ $pengeluaran->simpanan_wajib }}" 
                       class="border p-2 w-full rounded-lg focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="flex gap-2">
                <button type="submit" 
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                    💾 Update
                </button>
                <a href="{{ route('pengeluaran.index') }}" 
                   class="flex-1 bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg shadow text-center">
                    ⬅ Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
