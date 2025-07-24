@extends('layouts.app')
@section('content')
    <div class="p-4">
        <form action="{{ route('pengunjung.store') }}" method="POST"
            class="bg-white p-6 rounded shadow w-full max-w-lg mx-auto space-y-4">
            @csrf

            <x-input-label value="Tanggal" />
            <x-text-input type="date" name="tanggal" class="w-full" required />

            <x-input-label value="Waktu Kedatangan" />
            <x-text-input type="time" name="waktu_kedatangan" class="w-full" required />

            <x-input-label value="Jumlah Pengunjung" />
            <x-text-input type="number" name="jumlah_pengunjung" class="w-full" required />

            <x-input-label value="Jenis Kendaraan" />
            <x-text-input name="jenis_kendaraan" class="w-full" required />

            <div class="grid grid-cols-3 gap-2">
                <div>
                    <x-input-label value="Uli 2.5" />
                    <x-text-input type="number" name="uli_25" class="w-full" required />
                </div>
                <div>
                    <x-input-label value="Uli 5" />
                    <x-text-input type="number" name="uli_5" class="w-full" required />
                </div>
                <div>
                    <x-input-label value="Uli 10" />
                    <x-text-input type="number" name="uli_10" class="w-full" required />
                </div>
            </div>

            <div class="flex justify-end">
                <x-primary-button>Simpan</x-primary-button>
            </div>
        </form>
    </div>
@endsection
