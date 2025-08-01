@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-200">

        {{-- 🔹 Tombol Aksi --}}
        <div class="flex flex-wrap gap-3 mb-6">
            <a href="{{ route('uli.create') }}"
                class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-lg shadow-md transition">
                ➕ Tambah Data
            </a>
            <a href="{{ route('uli.createtukar.tukar') }}"
                class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white font-medium rounded-lg shadow-md transition">
                🔄 Tukar Uli
            </a>
            <a href="{{ route('uli.createkembali.kembali') }}"
                class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-medium rounded-lg shadow-md transition">
                🔙 Uli Kembali
            </a>
        </div>

        {{-- 🔹 Filter Tanggal --}}
        <form method="GET" action="{{ route('uli.index') }}" class="mb-5 flex items-center gap-3">
            <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                class="border rounded-lg p-2 focus:ring-2 focus:ring-blue-400 focus:outline-none shadow-sm">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md transition">
                🔍 Filter
            </button>
            <a href="{{ route('uli.index') }}"
                class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg shadow-md transition">
                🔄 Reset
            </a>
        </form>

        {{-- 🔹 Tabel Scroll --}}
        <div class="overflow-x-auto">
            <div class="max-h-[450px] overflow-y-auto border rounded-xl shadow-inner">
                <table class="min-w-full border-collapse text-sm">
                    <thead
                        class="bg-gradient-to-r from-gray-100 to-gray-200 sticky top-0 z-10 text-gray-700 uppercase text-xs tracking-wider">
                        <tr>
                            <th class="px-4 py-3 text-left border-b">Tanggal</th>
                            <th class="px-4 py-3 text-left border-b">Kategori</th>
                            <th class="px-4 py-3 text-left border-b">Uli 2.5 (Kps)</th>
                            <th class="px-4 py-3 text-left border-b">Uli 5 (Kps)</th>
                            <th class="px-4 py-3 text-left border-b">Uli 10 (Kps)</th>
                            <th class="px-4 py-3 text-right border-b">Total</th>
                            <th class="px-4 py-3 text-center border-b">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse ($ulis as $uli)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-4 py-2">{{ $uli->tanggal }}</td>
                                <td class="px-4 py-2 font-medium text-gray-800">{{ $uli->kategori }}</td>
                                <td class="px-4 py-2">
                                    <span class="font-medium text-green-700">Rp
                                        {{ number_format($uli->uli_25, 0, ',', '.') }}</span>
                                    <span class="text-gray-500 text-xs">({{ $uli->kps_25 }})</span>
                                </td>
                                <td class="px-4 py-2">
                                    <span class="font-medium text-green-700">Rp
                                        {{ number_format($uli->uli_5, 0, ',', '.') }}</span>
                                    <span class="text-gray-500 text-xs">({{ $uli->kps_5 }})</span>
                                </td>
                                <td class="px-4 py-2">
                                    <span class="font-medium text-green-700">Rp
                                        {{ number_format($uli->uli_10, 0, ',', '.') }}</span>
                                    <span class="text-gray-500 text-xs">({{ $uli->kps_10 }})</span>
                                </td>
                                <td class="px-4 py-2 text-right font-semibold text-blue-700">
                                    Rp {{ number_format($uli->uli_25 + $uli->uli_5 + $uli->uli_10, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 text-center space-x-1">
                                    <a href="{{ route('uli.edit', $uli->id) }}"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs shadow-md transition">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('uli.destroy', $uli->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs shadow-md transition">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-gray-500 italic">❌ Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>

                    {{-- 🔹 Total Uli Beredar --}}
                    @if ($stok)
                        <tfoot class="bg-yellow-50 font-semibold">
                            <tr>
                                <td colspan="7" class="px-4 py-3 text-sm">
                                    💰 Total Uli Beredar:
                                    <span class="text-green-700 font-bold">
                                        Rp {{ number_format($stok->uli_25 + $stok->uli_5 + $stok->uli_10, 0, ',', '.') }}
                                    </span>
                                    &nbsp;|&nbsp;
                                    🔢 2.5: <strong>{{ $stok->kps_25 }}</strong> |
                                    5: <strong>{{ $stok->kps_5 }}</strong> |
                                    10: <strong>{{ $stok->kps_10 }}</strong>
                                </td>
                            </tr>
                        </tfoot>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection
