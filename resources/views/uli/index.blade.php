@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto mt-10">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Data Uli (Stok Uli)</h2>
            <div class="flex gap-2">
                <a href="{{ route('uli.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Lihat Stock
                </a>
                <a href="{{ route('tukaruli.index') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                    Lihat Tukar Uli
                </a>
                <a href="{{ route('uli.create') }}" class="px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600">
                    Tambah Uli
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kategori</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Uli 2.5
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Uli 5
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Uli 10
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Total
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($data as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $item->tanggal }}</td>
                            <td class="px-6 py-4 text-center">{{ $item->kategori }}</td>
                            <td class="px-6 py-4 text-center">{{ $item->uli_25 }}</td>
                            <td class="px-6 py-4 text-center">{{ $item->uli_5 }}</td>
                            <td class="px-6 py-4 text-center">{{ $item->uli_10 }}</td>
                            <td class="px-6 py-4 text-center font-semibold">{{ $item->total }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('uli.edit', $item->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('uli.destroy', $item->id) }}" method="POST"
                                    class="inline-block ml-2" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($data->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">Tidak ada data Uli.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
