@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">➕ Tambah Data Pengunjung</h1>

    <form action="{{ route('pengunjung.store') }}" method="POST" 
          class="bg-white p-6 rounded-xl shadow-lg space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-semibold text-gray-700">Tanggal</label>
            <input type="date" name="tanggal" 
                   class="border rounded-lg p-2 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none" 
                   required>
        </div>

        <div>
            <label class="block mb-1 font-semibold text-gray-700">Sumbangan Motor</label>
            <input type="number" id="motor" name="sumbangan_motor" 
                   class="border rounded-lg p-2 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none" 
                   value="0" min="0">
        </div>

        <div>
            <label class="block mb-1 font-semibold text-gray-700">Sumbangan Mobil</label>
            <input type="number" id="mobil" name="sumbangan_mobil" 
                   class="border rounded-lg p-2 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none" 
                   value="0" min="0">
        </div>

        <div>
            <label class="block mb-1 font-semibold text-gray-700">Total Sumbangan (Rp)</label>
            <input type="text" id="total_sumbangan" 
                   class="border rounded-lg p-2 w-full bg-gray-100 font-semibold text-green-700" 
                   readonly>
        </div>

        <div>
            <label class="block mb-1 font-semibold text-gray-700">Total Pengunjung</label>
            <input type="text" id="total_pengunjung" 
                   class="border rounded-lg p-2 w-full bg-gray-100 font-semibold text-blue-700" 
                   readonly>
        </div>

        <div class="flex gap-3">
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
                💾 Simpan
            </button>
            <a href="{{ route('pengunjung.index') }}" 
               class="bg-gray-400 hover:bg-gray-500 text-white px-5 py-2 rounded-lg shadow">
                ↩️ Batal
            </a>
        </div>
    </form>
</div>

<script>
document.querySelectorAll('#motor, #mobil').forEach(input => {
    input.addEventListener('input', updateTotal);
});

function updateTotal() {
    let motor = parseInt(document.getElementById('motor').value) || 0;
    let mobil = parseInt(document.getElementById('mobil').value) || 0;

    let totalSumbangan = (motor * 2000) + (mobil * 4000);
    let totalPengunjung = (motor * 2) + (mobil * 4);

    document.getElementById('total_sumbangan').value = totalSumbangan.toLocaleString('id-ID');
    document.getElementById('total_pengunjung').value = totalPengunjung;
}
</script>
@endsection
