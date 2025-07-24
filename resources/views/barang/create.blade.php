<x-app-layout>
    <div class="p-6">
        <h2 class="text-xl font-bold mb-4">Tambah Barang</h2>

        <form method="POST" action="{{ route('barang.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block">Nama Barang</label>
                <input type="text" name="nama" class="w-full border rounded p-2">
            </div>
            <div>
                <label class="block">Harga</label>
                <input type="text" name="harga" class="w-full border rounded p-2">
            </div>
            <button class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>
