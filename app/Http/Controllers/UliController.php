<?php

namespace App\Http\Controllers;

use App\Models\Uli;
use App\Models\StokUli;
use Illuminate\Http\Request;

class UliController extends Controller
{
    // Ambil stok (selalu 1 baris saja)
    private function getStok()
    {
        return StokUli::firstOrCreate(['id' => 1], [
            'uli_25' => 0, 'kps_25' => 0,
            'uli_5' => 0, 'kps_5' => 0,
            'uli_10' => 0, 'kps_10' => 0
        ]);
    }

   public function index(Request $request)
{
    $query = Uli::query()->orderBy('tanggal', 'desc');

    // Cek apakah ada input tanggal
    if ($request->has('tanggal') && $request->tanggal != null) {
        $query->whereDate('tanggal', $request->tanggal);
    }

    $ulis = $query->get();
    $stok = $this->getStok();

    return view('uli.index', compact('ulis', 'stok'));
}


    public function create()
    {
        $kategori = null;
        return view('uli.create', compact('kategori'));
    }

    public function createTukar()
    {
        $kategori = "Tukar Uli";
        return view('uli.create', compact('kategori'));
    }

    public function createKembali()
    {
        $kategori = "Uli Kembali";
        return view('uli.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kategori' => 'required',
            'uli_25' => 'nullable|numeric',
            'uli_5' => 'nullable|numeric',
            'uli_10' => 'nullable|numeric'
        ]);

        $uli_25 = $request->uli_25 ?? 0;
        $uli_5 = $request->uli_5 ?? 0;
        $uli_10 = $request->uli_10 ?? 0;

        // Simpan transaksi
        $uli = Uli::create([
            'tanggal' => $request->tanggal,
            'kategori' => $request->kategori,
            'uli_25' => $uli_25,
            'uli_5' => $uli_5,
            'uli_10' => $uli_10,
            'kps_25' => $uli_25 / 2500,
            'kps_5' => $uli_5 / 5000,
            'kps_10' => $uli_10 / 10000,
        ]);

        // Update stok
        $stok = $this->getStok();

        if ($uli->kategori == 'Uli Beredar') {
            $stok->uli_25 += $uli_25;
            $stok->uli_5 += $uli_5;
            $stok->uli_10 += $uli_10;
        } elseif (in_array($uli->kategori, ['Tukar Uli', 'Uli Kembali'])) {
            $stok->uli_25 -= $uli_25;
            $stok->uli_5 -= $uli_5;
            $stok->uli_10 -= $uli_10;
        }

        $stok->kps_25 = $stok->uli_25 / 2500;
        $stok->kps_5 = $stok->uli_5 / 5000;
        $stok->kps_10 = $stok->uli_10 / 10000;
        $stok->save();

        return redirect()->route('uli.index')->with('success', 'Data Uli berhasil ditambahkan.');
    }

    public function edit(Uli $uli)
    {
        return view('uli.edit', compact('uli'));
    }

    public function update(Request $request, Uli $uli)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kategori' => 'required',
            'uli_25' => 'nullable|numeric',
            'uli_5' => 'nullable|numeric',
            'uli_10' => 'nullable|numeric'
        ]);

        // Hitung selisih untuk update stok
        $old = $uli->only(['kategori', 'uli_25', 'uli_5', 'uli_10']);
        $uli_25 = $request->uli_25 ?? 0;
        $uli_5 = $request->uli_5 ?? 0;
        $uli_10 = $request->uli_10 ?? 0;

        $uli->update([
            'tanggal' => $request->tanggal,
            'kategori' => $request->kategori,
            'uli_25' => $uli_25,
            'uli_5' => $uli_5,
            'uli_10' => $uli_10,
            'kps_25' => $uli_25 / 2500,
            'kps_5' => $uli_5 / 5000,
            'kps_10' => $uli_10 / 10000,
        ]);

        // Update stok berdasarkan selisih
        $stok = $this->getStok();

        // Jika kategori berubah, kita balikin stok lama dulu
        if ($old['kategori'] == 'Uli Beredar') {
            $stok->uli_25 -= $old['uli_25'];
            $stok->uli_5 -= $old['uli_5'];
            $stok->uli_10 -= $old['uli_10'];
        } elseif (in_array($old['kategori'], ['Tukar Uli', 'Uli Kembali'])) {
            $stok->uli_25 += $old['uli_25'];
            $stok->uli_5 += $old['uli_5'];
            $stok->uli_10 += $old['uli_10'];
        }

        // Tambahkan stok baru sesuai kategori baru
        if ($request->kategori == 'Uli Beredar') {
            $stok->uli_25 += $uli_25;
            $stok->uli_5 += $uli_5;
            $stok->uli_10 += $uli_10;
        } elseif (in_array($request->kategori, ['Tukar Uli', 'Uli Kembali'])) {
            $stok->uli_25 -= $uli_25;
            $stok->uli_5 -= $uli_5;
            $stok->uli_10 -= $uli_10;
        }

        $stok->kps_25 = $stok->uli_25 / 2500;
        $stok->kps_5 = $stok->uli_5 / 5000;
        $stok->kps_10 = $stok->uli_10 / 10000;
        $stok->save();

        return redirect()->route('uli.index')->with('success', 'Data Uli berhasil diperbarui.');
    }

    public function destroy(Uli $uli)
    {
        // Sebelum hapus, kembalikan stok
        $stok = $this->getStok();

        if ($uli->kategori == 'Uli Beredar') {
            $stok->uli_25 -= $uli->uli_25;
            $stok->uli_5 -= $uli->uli_5;
            $stok->uli_10 -= $uli->uli_10;
        } elseif (in_array($uli->kategori, ['Tukar Uli', 'Uli Kembali'])) {
            $stok->uli_25 += $uli->uli_25;
            $stok->uli_5 += $uli->uli_5;
            $stok->uli_10 += $uli->uli_10;
        }

        $stok->kps_25 = $stok->uli_25 / 2500;
        $stok->kps_5 = $stok->uli_5 / 5000;
        $stok->kps_10 = $stok->uli_10 / 10000;
        $stok->save();

        $uli->delete();

        return redirect()->route('uli.index')->with('success', 'Data Uli berhasil dihapus.');
    }
}
