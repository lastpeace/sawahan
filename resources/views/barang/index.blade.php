@extends('layouts.app')

@section('content')
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Data Barang</h2>

        <a href="{{ route('barang.create') }}" class="bg-green-500 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah
            Barang</a>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-2">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full table-auto border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Harga</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $i => $b)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $i + 1 }}</td>
                        <td class="px-4 py-2">{{ $b->nama }}</td>
                        <td class="px-4 py-2">{{ $b->harga }}</td>
                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('barang.edit', $b) }}" class="text-blue-500">Edit</a>
                            <form action="{{ route('barang.destroy', $b) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
