@extends('layouts.app')

@section('content')
    <div class="p-4 max-w-xl mx-auto">
        <h1 class="text-xl font-bold mb-4">Tambah Data Uli</h1>

        <form action="{{ route('uli.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1">Tanggal</label>
                <input type="date" name="tanggal" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block mb-1">Kategori</label>
                <select name="kategori" class="w-full border rounded px-3 py-2" required>
                    <option value="">-- Pilih --</option>
                    <option value="Uli Beredar">Uli Beredar</option>
                    <option value="Uli Cadangan">Uli Cadangan</option>
                </select>
            </div>

            <div>
                <label class="block mb-1">Uli 2.5</label>
                <input type="number" name="uli_25" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block mb-1">Uli 5</label>
                <input type="number" name="uli_5" class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="block mb-1">Uli 10</label>
                <input type="number" name="uli_10" class="w-full border rounded px-3 py-2" required>
            </div>

            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
@endsection
