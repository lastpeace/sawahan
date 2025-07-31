@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">💸 Data Pengeluaran</h1>

    <div class="flex justify-between items-center mb-4">
        <form method="GET" action="{{ route('pengeluaran.index') }}" class="flex gap-2">
            <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                   class="border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Filter</button>
            <a href="{{ route('pengeluaran.index') }}"
               class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg">Reset</a>
        </form>

        <a href="{{ route('pengeluaran.create') }}"
           class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">
           ➕ Tambah Data
        </a>
    </div>

    <div class="bg-white p-5 rounded-xl shadow-lg overflow-x-auto">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="border p-3">Tanggal</th>
                    <th class="border p-3">Hiburan</th>
                    <th class="border p-3">Sarapan</th>
                    <th class="border p-3">Kopi</th>
                    <th class="border p-3">Simpanan Wajib</th>
                    <th class="border p-3">Total</th>
                    <th class="border p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengeluarans as $p)
                    <tr class="text-center border-b hover:bg-gray-50">
                        <td class="p-3">{{ $p->tanggal }}</td>
                        <td class="p-3">Rp {{ number_format($p->hiburan, 0, ',', '.') }}</td>
                        <td class="p-3">Rp {{ number_format($p->sarapan, 0, ',', '.') }}</td>
                        <td class="p-3">Rp {{ number_format($p->kopi, 0, ',', '.') }}</td>
                        <td class="p-3">Rp {{ number_format($p->simpanan_wajib, 0, ',', '.') }}</td>
                        <td class="p-3 font-bold text-blue-700">Rp {{ number_format($p->total, 0, ',', '.') }}</td>
                        <td class="p-3 flex justify-center gap-2">
                            <a href="{{ route('pengeluaran.edit', $p->id) }}"
                               class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg text-xs">✏️ Edit</a>
                            <form action="{{ route('pengeluaran.destroy', $p->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs">
                                    🗑 Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-gray-500">Belum ada data pengeluaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
