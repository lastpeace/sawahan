@extends('layouts.app')

@section('content')
    <div class="p-6">
        <h1 class="text-xl font-bold mb-4">Edit Data Uli</h1>

        <form action="{{ route('uli.update', $uli->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="border p-2 w-full" value="{{ old('tanggal', $uli->tanggal) }}"
                    required>
            </div>

            <div>
                <label>Kategori</label>
                <select name="kategori" class="border p-2 w-full">
                    <option value="Uli Beredar" {{ old('kategori', $uli->kategori) == 'Uli Beredar' ? 'selected' : '' }}>Uli
                        Beredar</option>
                    <option value="Uli Cadangan" {{ old('kategori', $uli->kategori) == 'Uli Cadangan' ? 'selected' : '' }}>
                        Uli Cadangan</option>
                    <option value="Uli Kembali" {{ old('kategori', $uli->kategori) == 'Uli Kembali' ? 'selected' : '' }}>Uli
                        Kembali</option>
                    <option value="Tukar Uli" {{ old('kategori', $uli->kategori) == 'Tukar Uli' ? 'selected' : '' }}>Tukar
                        Uli</option>
                </select>
            </div>

            <div>
                <label>Uli 2.5</label>
                <input type="number" step="0.01" name="uli_25" class="border p-2 w-full"
                    value="{{ old('uli_25', $uli->uli_25) }}">
            </div>

            <div>
                <label>Uli 5</label>
                <input type="number" step="0.01" name="uli_5" class="border p-2 w-full"
                    value="{{ old('uli_5', $uli->uli_5) }}">
            </div>

            <div>
                <label>Uli 10</label>
                <input type="number" step="0.01" name="uli_10" class="border p-2 w-full"
                    value="{{ old('uli_10', $uli->uli_10) }}">
            </div>

            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded">Update</button>
            <a href="{{ route('uli.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded">Batal</a>
        </form>
    </div>
@endsection
