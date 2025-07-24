@extends('layouts.app')
@section('content')
    <x-slot name="header">Pengunjung</x-slot>

    <div class="p-4">
        <a href="{{ route('pengunjung.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">+
            Tambah Data</a>
        <div class="bg-white rounded shadow p-4 overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th>Tanggal</th>
                        <th>Datang</th>
                        <th>Jml Pengunjung</th>
                        <th>Kendaraan</th>
                        <th>Uli 2.5</th>
                        <th>Uli 5</th>
                        <th>Uli 10</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengunjungs as $p)
                        <tr class="border-t">
                            <td>{{ $p->tanggal }}</td>
                            <td>{{ $p->waktu_kedatangan }}</td>
                            <td>{{ $p->jumlah_pengunjung }}</td>
                            <td>{{ $p->jenis_kendaraan }}</td>
                            <td>{{ $p->uli_25 }}</td>
                            <td>{{ $p->uli_5 }}</td>
                            <td>{{ $p->uli_10 }}</td>
                            <td>{{ $p->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
