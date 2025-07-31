@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">📋 Data Pengunjung</h1>

    {{-- 🔹 Filter & Tambah Data --}}
    <div class="flex flex-wrap justify-between items-center mb-5 gap-3">
        <form method="GET" action="{{ route('pengunjung.index') }}" class="flex flex-wrap gap-3">
            <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                class="border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                🔍 Filter
            </button>
            <a href="{{ route('pengunjung.index') }}"
                class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg shadow">
                🔄 Reset
            </a>
        </form>

        <a href="{{ route('pengunjung.create') }}"
            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">
            ➕ Tambah Data
        </a>
    </div>

    {{-- 🔹 Tabel --}}
    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-gray-100 text-gray-700 text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3 border-b">Tanggal</th>
                        <th class="px-4 py-3 border-b">Sumbangan Motor</th>
                        <th class="px-4 py-3 border-b">Sumbangan Mobil</th>
                        <th class="px-4 py-3 border-b">Jumlah Pengunjung</th>
                        <th class="px-4 py-3 border-b">Total Sumbangan</th>
                        <th class="px-4 py-3 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengunjungs as $p)
                        <tr class="hover:bg-gray-50 border-b transition">
                            <td class="px-4 py-3">{{ $p->tanggal }}</td>
                            <td class="px-4 py-3 text-center"> {{ number_format($p->sumbangan_motor, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-center"> {{ number_format($p->sumbangan_mobil, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-center">{{ $p->total_pengunjung }}</td>
                            <td class="px-4 py-3 font-semibold">Rp {{ number_format($p->total_sumbangan, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-center space-x-2">
                                <a href="{{ route('pengunjung.edit',$p->id) }}"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs shadow">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('pengunjung.destroy',$p->id) }}" method="POST" class="inline">
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
                            <td colspan="6" class="text-center py-4 text-gray-500">❌ Tidak ada data pengunjung</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
