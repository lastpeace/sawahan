@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">✏️ Edit Pedagang</h1>

    <div class="bg-white p-6 rounded-xl shadow-lg">
        <form action="{{ route('pedagang.update', $pedagang->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 font-semibold text-gray-700">📅 Tanggal</label>
                <input type="date" name="tanggal" value="{{ $pedagang->tanggal }}" required
                       class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700">👤 Nama Pedagang</label>
                <input type="text" name="nama_pedagang" value="{{ $pedagang->nama_pedagang }}" required
                       class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700">💰 Pendapatan</label>
                <input type="number" name="pendapatan" id="pendapatan" value="{{ $pedagang->pendapatan }}" required
                       class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700">🔻 Potongan (10%)</label>
                <input type="text" id="potongan" value="{{ $pedagang->potongan }}" readonly
                       class="w-full border rounded-lg p-2 bg-gray-100 text-gray-600">
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700">🧹 Kebersihan</label>
                <input type="number" name="kebersihan" id="kebersihan" value="{{ $pedagang->kebersihan }}"
                       class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-700">📊 Total</label>
                <input type="text" id="total" value="{{ $pedagang->total }}" readonly
                       class="w-full border rounded-lg p-2 bg-gray-100 text-gray-700 font-semibold">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" 
                        class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow">
                    💾 Update
                </button>
                <a href="{{ route('pedagang.index') }}" 
                   class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-lg shadow">
                    🔙 Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('pendapatan').addEventListener('input', hitungTotal);
document.getElementById('kebersihan').addEventListener('input', hitungTotal);

function hitungTotal() {
    let pendapatan = parseFloat(document.getElementById('pendapatan').value) || 0;
    let kebersihan = parseFloat(document.getElementById('kebersihan').value) || 0;

    let potongan = pendapatan * 0.10;
    let total = pendapatan - potongan - kebersihan;

    document.getElementById('potongan').value = potongan.toFixed(0);
    document.getElementById('total').value = total.toFixed(0);
}
</script>
@endsection
