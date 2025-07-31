@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white shadow-lg rounded-xl p-6">
    <h1 class="text-2xl font-bold text-gray-700 mb-6">✏️ Edit Data Uli</h1>

    <form action="{{ route('uli.update', $uli->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- 📅 Input Tanggal --}}
        <div>
            <label class="block font-medium text-gray-700 mb-1">Tanggal</label>
            <input type="date" name="tanggal" required
                value="{{ old('tanggal', $uli->tanggal) }}"
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
        </div>

        {{-- 📂 Pilih Kategori --}}
        <div>
            <label class="block font-medium text-gray-700 mb-1">Kategori</label>
            <select name="kategori" 
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                <option value="Uli Beredar" {{ old('kategori', $uli->kategori) == 'Uli Beredar' ? 'selected' : '' }}>Uli Beredar</option>
                <option value="Uli Cadangan" {{ old('kategori', $uli->kategori) == 'Uli Cadangan' ? 'selected' : '' }}>Uli Cadangan</option>
                <option value="Uli Kembali" {{ old('kategori', $uli->kategori) == 'Uli Kembali' ? 'selected' : '' }}>Uli Kembali</option>
                <option value="Tukar Uli" {{ old('kategori', $uli->kategori) == 'Tukar Uli' ? 'selected' : '' }}>Tukar Uli</option>
            </select>
        </div>

        {{-- 💰 Input Uli --}}
        @foreach ([['uli_25', 'Uli 2.5'], ['uli_5', 'Uli 5'], ['uli_10', 'Uli 10']] as $field)
            <div>
                <label class="block font-medium text-gray-700 mb-1">{{ $field[1] }}</label>
                <input type="number" step="0.01" name="{{ $field[0] }}" 
                    value="{{ old($field[0], $uli[$field[0]]) }}"
                    class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>
        @endforeach

        {{-- 🔘 Tombol Aksi --}}
        <div class="flex gap-3">
            <button type="submit" 
                class="flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">
                💾 Update
            </button>
            <a href="{{ route('uli.index') }}" 
                class="flex-1 text-center px-4 py-2 bg-gray-400 hover:bg-gray-500 text-white rounded-lg shadow">
                ❌ Batal
            </a>
        </div>
    </form>
</div>
@endsection
