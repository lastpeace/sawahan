@extends('layouts.app')

@section('content')
<style>
@media print {
    body {
        font-family: Arial, sans-serif;
        background: white;
        padding: 20px;
    }
    #printArea {
        width: 100%;
        border: 1px solid #000;
        padding: 20px;
        border-radius: 8px;
    }
    #printArea h2 {
        text-align: center;
        margin-bottom: 10px;
        font-size: 20px;
    }
    #printArea table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    #printArea th, #printArea td {
        border: 1px solid #000;
        padding: 8px;
        text-align: center;
    }
    #printArea th {
        background: #f1f1f1;
    }
    .no-print {
        display: none;
    }
    footer {
        margin-top: 20px;
        text-align: right;
        font-size: 12px;
    }
}
</style>

<div class="p-6">
    <h1 class="text-3xl font-bold mb-6">📄 Laporan Parkir</h1>

    <form method="GET" action="{{ route('laporan.index') }}" class="flex flex-wrap items-center gap-3 mb-6">
        <input type="date" name="start_date" value="{{ request('start_date') }}" class="border p-2 rounded">
        <span class="text-gray-700">s/d</span>
        <input type="date" name="end_date" value="{{ request('end_date') }}" class="border p-2 rounded">
        <button class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Filter</button>
        <a href="{{ route('laporan.index') }}" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded">Reset</a>
    </form>

    <div id="print-area" class="bg-white p-6 rounded-xl shadow-lg">
        <p class="text-sm text-gray-600 mb-4">Dicetak oleh: <strong>{{ Auth::user()->name ?? 'Admin' }}</strong></p>

        <table class="w-full border-collapse border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2">Tanggal</th>
                    <th class="border px-4 py-2">Pengunjung</th>
                    <th class="border px-4 py-2">Pemasukan</th>
                    <th class="border px-4 py-2">Pengeluaran</th>
                    <th class="border px-4 py-2">Saldo</th>
                </tr>
            </thead>
            <tbody>
                @forelse($laporanHarian as $laporan)
                    <tr class="text-center hover:bg-gray-50">
                        <td class="border px-4 py-2 text-center">{{ \Carbon\Carbon::parse($laporan['tanggal'])->format('d/m/Y') }}</td>
                        <td class="border px-4 py-2 text-center">{{ $laporan['jumlah_pengunjung'] }}</td>
                        <td class="border px-4 py-2 text-center">Rp {{ number_format($laporan['pemasukan'], 0, ',', '.') }}</td>
                        <td class="border px-4 py-2 text-center">Rp {{ number_format($laporan['pengeluaran'], 0, ',', '.') }}</td>
                        <td class="border px-4 py-2 text-center ">Rp {{ number_format($laporan['saldo'], 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-3 text-gray-500">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
            <tfoot class="bg-yellow-100 font-semibold">
                <tr>
                    <td class="border px-4 py-2 text-center font-bold">TOTAL</td>
                    <td class="border px-4 py-2 text-center font-bold">{{ $totalPengunjung }}</td>
                    <td class="border px-4 py-2 text-center font-bold">
                        Rp {{ is_numeric($totalPemasukan) ? number_format($totalPemasukan, 0, ',', '.') : '-' }}
                    </td>
                    <td class="border px-4 py-2 text-center font-bold">
                        Rp {{ is_numeric($totalPengeluaran) ? number_format($totalPengeluaran, 0, ',', '.') : '-' }}
                    </td>
                    <td class="border px-4 py-2 text-center font-bold">
                        Rp {{ is_numeric($saldo) ? number_format($saldo, 0, ',', '.') : '-' }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="mt-5 flex gap-3">
        <button onclick="window.print()" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded shadow">🖨 Print</button>
        <button onclick="window.history.back()" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded shadow">⬅ Kembali</button>
    </div>
</div>
@endsection
