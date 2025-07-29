@extends('layouts.app')

@section('content')
    <div class="p-6">
        <h1 class="text-xl font-bold mb-4">Tambah Data Uli</h1>

        <form action="{{ route('uli.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="border p-2 w-full" required>
            </div>

            <div>
                <label>Kategori</label>
                <select name="kategori" class="border p-2 w-full" {{ isset($kategori) ? 'disabled' : '' }}>
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

            @foreach ([['uli_25', 'Uli 2.5'], ['uli_5', 'Uli 5'], ['uli_10', 'Uli 10']] as $field)
                <div>
                    <label>{{ $field[1] }}</label>
                    <input type="number" name="{{ $field[0] }}" class="border p-2 w-full" step="0.01"
                        value="0">
                </div>
            @endforeach

            <button class="px-4 py-2 bg-green-500 text-white rounded">Simpan</button>
            <a href="{{ route('uli.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded">Batal</a>
        </form>
    </div>
@endsection
