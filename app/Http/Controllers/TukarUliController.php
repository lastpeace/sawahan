<?php

namespace App\Http\Controllers;

use App\Models\Uli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TukarUliController extends Controller
{
    public function index()
    {
        return view('tukaruli.index');
    }

   public function store(Request $request)
{
    $request->validate([
        'tanggal' => 'required|date',
        'uli_25' => 'nullable|integer|min:0',
        'uli_5' => 'nullable|integer|min:0',
        'uli_10' => 'nullable|integer|min:0',
    ]);

    $tanggal = $request->input('tanggal');
    $jumlah_25 = (int) $request->input('uli_25');
    $jumlah_5 = (int) $request->input('uli_5');
    $jumlah_10 = (int) $request->input('uli_10');

    if ($jumlah_25 === 0 && $jumlah_5 === 0 && $jumlah_10 === 0) {
        return back()->with('error', 'Harap isi minimal satu jenis uli untuk ditukar.');
    }

    DB::beginTransaction();
    try {
        $beredar = Uli::where('tanggal', $tanggal)->where('kategori', 'Beredar')->first();

        if (!$beredar) {
            return back()->with('error', 'Data Beredar tidak ditemukan.');
        }

        if ($beredar->uli_25 < $jumlah_25 || $beredar->uli_5 < $jumlah_5 || $beredar->uli_10 < $jumlah_10) {
            return back()->with('error', 'Jumlah Beredar tidak mencukupi.');
        }

        // Update Beredar
        $beredar->uli_25 -= $jumlah_25;
        $beredar->uli_5 -= $jumlah_5;
        $beredar->uli_10 -= $jumlah_10;
        $beredar->total = $beredar->uli_25 + $beredar->uli_5 + $beredar->uli_10;
        $beredar->save();

        // Update Cadangan
        $cadangan = Uli::firstOrCreate(
            ['tanggal' => $tanggal, 'kategori' => 'Cadangan'],
            ['uli_25' => 0, 'uli_5' => 0, 'uli_10' => 0, 'total' => 0]
        );

        $cadangan->uli_25 += $jumlah_25;
        $cadangan->uli_5 += $jumlah_5;
        $cadangan->uli_10 += $jumlah_10;
        $cadangan->total = $cadangan->uli_25 + $cadangan->uli_5 + $cadangan->uli_10;
        $cadangan->save();

        DB::commit();
        return back()->with('success', 'Penukaran berhasil dilakukan.');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Terjadi kesalahan saat menukar data.');
    }
}

}
