@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">📜 Data Pedagang</h1>

    <div class="flex justify-between items-center mb-4">
        <form method="GET" action="{{ route('pedagang.index') }}" class="flex gap-2">
            <input type="date" name="tanggal" value="{{ request('tanggal') }}" 
                   class="border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                🔍 Filter
            </button>
            <a href="{{ route('pedagang.index') }}" 
               class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg shadow">
                🔄 Reset
            </a>
        </form>

        <a href="{{ route('pedagang.create') }}" 
           class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow">
            ➕ Tambah Data
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 text-gray-700 text-sm">
                <tr>
                    <th class="border p-3">No</th>
                    <th class="border p-3">Tanggal</th>
                    <th class="border p-3">Nama Pedagang</th>
                    <th class="border p-3">Pendapatan</th>
                    <th class="border p-3">Potongan</th>
                    <th class="border p-3">Kebersihan</th>
                    <th class="border p-3">Total</th>
                    <th class="border p-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse ($pedagangs as $index => $p)
                    <tr class="text-center border-b hover:bg-gray-50">
                        <td class="border p-2">{{ $index + 1 }}</td>
                        <td class="border p-2">{{ $p->tanggal }}</td>
                        <td class="border p-2 font-medium">{{ $p->nama_pedagang }}</td>
                        <td class="border p-2 text-center">Rp {{ number_format($p->pendapatan, 0, ',', '.') }}</td>
                        <td class="border p-2 text-center">Rp {{ number_format($p->potongan, 0, ',', '.') }}</td>
                        <td class="border p-2 text-center">Rp {{ number_format($p->kebersihan, 0, ',', '.') }}</td>
                        <td class="border p-2 font-bold text-center">Rp {{ number_format($p->total, 0, ',', '.') }}</td>
                        <td class="border p-2 space-x-1">
                            <a href="{{ route('pedagang.edit', $p->id) }}" 
                               class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs shadow">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('pedagang.destroy', $p->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Yakin hapus?')" 
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs shadow">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-gray-500">❌ Belum ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
