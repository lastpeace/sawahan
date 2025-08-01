@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto bg-white shadow-lg rounded-xl p-6">
        <h1 class="text-2xl font-bold text-gray-700 mb-6">Tukar Uli</h1>

        <form action="{{ route('uli.store') }}" method="POST" class="space-y-5">
            @csrf

            {{-- 📅 Input Tanggal --}}
            <div>
                <label class="block font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="date" name="tanggal" required
                    class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>

            {{-- 📂 Kategori --}}
            <div>
                <label class="block font-medium text-gray-700 mb-1">Kategori</label>
                <select name="kategori"
                    class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    {{ isset($kategori) ? 'disabled' : '' }}>
                    <option value="Uli Beredar" {{ isset($kategori) && $kategori == 'Uli Beredar' ? 'selected' : '' }}>Uli
                        Beredar</option>
                    <option value="Uli Cadangan" {{ isset($kategori) && $kategori == 'Uli Cadangan' ? 'selected' : '' }}>Uli
                        Cadangan</option>
                    <option value="Uli Kembali" {{ isset($kategori) && $kategori == 'Uli Kembali' ? 'selected' : '' }}>Uli
                        Kembali</option>
                    <option value="Tukar Uli" {{ isset($kategori) && $kategori == 'Tukar Uli' ? 'selected' : '' }}>Tukar Uli
                    </option>
                </select>
                @if (isset($kategori))
                    <input type="hidden" name="kategori" value="{{ $kategori }}">
                @endif
            </div>

            {{-- 💰 Input Uli --}}
            @foreach ([['uli_25', 'Uli 2.5'], ['uli_5', 'Uli 5'], ['uli_10', 'Uli 10']] as $field)
                <div>
                    <label class="block font-medium text-gray-700 mb-1">{{ $field[1] }}</label>
                    <input type="number" name="{{ $field[0] }}" step="0.01" value="0"
                        class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>
            @endforeach

            {{-- 🔘 Tombol Aksi --}}
            <div class="flex gap-3">
                <button type="submit"
                    class="flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">
                    💾 Simpan
                </button>
                <a href="{{ route('uli.index') }}"
                    class="flex-1 text-center px-4 py-2 bg-gray-400 hover:bg-gray-500 text-white rounded-lg shadow">
                    ❌ Batal
                </a>
            </div>
        </form>
    </div>
@endsection
