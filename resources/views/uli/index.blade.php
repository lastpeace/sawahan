@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-5">

        {{-- 🔹 Tombol Aksi --}}
        <div class="flex gap-3 mb-4">
            <a href="{{ route('uli.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                + Tambah Data
            </a>
            <a href="{{ route('uli.create.tukar') }}" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded">
                + Tukar Uli
            </a>
            <a href="{{ route('uli.create.kembali') }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded">
                + Uli Kembali
            </a>
        </div>

        {{-- 🔹 Filter Tanggal --}}
        <form method="GET" action="{{ route('uli.index') }}" class="mb-4 flex items-center gap-2">
            <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="border rounded p-2">
            <button type="submit" class="bg-blue-500 text-white px-3 py-2 rounded">Filter</button>
            <a href="{{ route('uli.index') }}" class="bg-gray-400 text-white px-3 py-2 rounded">Reset</a>
        </form>

        {{-- 🔹 Tabel dengan Scroll --}}
        <div class="overflow-x-auto">
            <div class="h-[450px] overflow-y-auto border rounded-lg">
                <table class="min-w-full border-collapse">
                    <thead class="bg-gray-100 sticky top-0 z-10 text-gray-700 text-sm">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold border-b">Tanggal</th>
                            <th class="px-4 py-3 text-left font-semibold border-b">Kategori</th>
                            <th class="px-4 py-3 text-left font-semibold border-b">Uli 2.5 (Kps)</th>
                            <th class="px-4 py-3 text-left font-semibold border-b">Uli 5 (Kps)</th>
                            <th class="px-4 py-3 text-left font-semibold border-b">Uli 10 (Kps)</th>
                            <th class="px-4 py-3 text-right font-semibold border-b">Total</th>
                            <th class="px-4 py-3 text-center font-semibold border-b">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-sm text-gray-700">
                        @forelse ($ulis as $uli)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2">{{ $uli->tanggal }}</td>
                                <td class="px-4 py-2">{{ $uli->kategori }}</td>
                                <td class="px-4 py-2">
                                    Rp {{ number_format($uli->uli_25, 0, ',', '.') }}
                                    <span class="text-gray-500 text-xs">({{ $uli->kps_25 }})</span>
                                </td>
                                <td class="px-4 py-2">
                                    Rp {{ number_format($uli->uli_5, 0, ',', '.') }}
                                    <span class="text-gray-500 text-xs">({{ $uli->kps_5 }})</span>
                                </td>
                                <td class="px-4 py-2">
                                    Rp {{ number_format($uli->uli_10, 0, ',', '.') }}
                                    <span class="text-gray-500 text-xs">({{ $uli->kps_10 }})</span>
                                </td>
                                <td class="px-4 py-2 text-right font-bold">
                                    Rp {{ number_format($uli->uli_25 + $uli->uli_5 + $uli->uli_10, 0, ',', '.') }}
                                </td>
                                <td class="px-4 py-2 text-center space-x-1">
                                    <a href="{{ route('uli.edit', $uli->id) }}"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs">Edit</a>
                                    <form action="{{ route('uli.destroy', $uli->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-gray-500">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>

                    {{-- 🔹 Total Stok Uli di bawah tabel --}}
                    @if ($stok)
                        <tfoot class="bg-yellow-50 font-semibold">
                            <tr>
                                <td colspan="7" class="px-4 py-3">
                                    💰 Total Uli Beredar:
                                    <strong>Rp
                                        {{ number_format($stok->uli_25 + $stok->uli_5 + $stok->uli_10, 0, ',', '.') }}</strong>
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
