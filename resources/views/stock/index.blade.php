@extends('layouts.app')
@section('content')
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <h2 class="text-xl font-semibold mb-4">Stock Uli</h2>

        <div class="mb-4">
            <a href="{{ route('stock.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">+ Tambah Data</a>
        </div>

        <table class="table-auto w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Kategori Uli</th>
                    <th class="px-4 py-2">Uli 2.5</th>
                    <th class="px-4 py-2">Uli 5</th>
                    <th class="px-4 py-2">Uli 10</th>
                    <th class="px-4 py-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ulis as $uli)
                    <tr>
                        <td class="border px-4 py-2">{{ $uli->tanggal->format('d/m/Y') }}</td>
                        <td class="border px-4 py-2">{{ $uli->kategori }}</td>
                        <td class="border px-4 py-2">{{ number_format($uli->uli_25) }}</td>
                        <td class="border px-4 py-2">{{ number_format($uli->uli_5) }}</td>
                        <td class="border px-4 py-2">{{ number_format($uli->uli_10) }}</td>
                        <td class="border px-4 py-2 font-bold">
                            {{ number_format($uli->uli_25 + $uli->uli_5 + $uli->uli_10) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
