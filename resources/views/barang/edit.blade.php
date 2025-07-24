<x-app-layout>
    <div class="p-6">
        <h2 class="text-xl font-bold mb-4">Edit Barang</h2>

        <form method="POST" action="{{ route('barang.update', $barang) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block">Nama Barang</label>
                <input type="text" name="nama" class="w-full border rounded p-2" value="{{ $barang->nama }}">
            </div>
            <div>
                <label class="block">Harga</label>
                <input type="text" name="harga" class="w-full border rounded p-2" value="{{ $barang->harga }}">
            </div>
            <button class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>
