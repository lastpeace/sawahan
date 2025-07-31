<?php
namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;

class PengunjungController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengunjung::query();

        // 🔹 Filter berdasarkan tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $pengunjungs = $query->orderBy('tanggal', 'desc')->get();

        return view('pengunjung.index', compact('pengunjungs'));
    }


    public function create()
    {
        return view('pengunjung.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'sumbangan_motor' => 'required|integer|min:0',
            'sumbangan_mobil' => 'required|integer|min:0',
        ]);

        $motor = $request->sumbangan_motor;
        $mobil = $request->sumbangan_mobil;

        $total_sumbangan = ($motor * 2000) + ($mobil * 4000);
        $total_pengunjung = ($motor * 2) + ($mobil * 4);

        Pengunjung::create([
            'tanggal' => $request->tanggal,
            'sumbangan_motor' => $motor,
            'sumbangan_mobil' => $mobil,
            'total_sumbangan' => $total_sumbangan,
            'total_pengunjung' => $total_pengunjung,
        ]);

        return redirect()->route('pengunjung.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit(Pengunjung $pengunjung)
    {
        return view('pengunjung.edit', compact('pengunjung'));
    }

    public function update(Request $request, Pengunjung $pengunjung)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'sumbangan_motor' => 'required|integer|min:0',
            'sumbangan_mobil' => 'required|integer|min:0',
        ]);

        $motor = $request->sumbangan_motor;
        $mobil = $request->sumbangan_mobil;

        $total_sumbangan = ($motor * 2000) + ($mobil * 4000);
        $total_pengunjung = ($motor * 2) + ($mobil * 4);

        $pengunjung->update([
            'tanggal' => $request->tanggal,
            'sumbangan_motor' => $motor,
            'sumbangan_mobil' => $mobil,
            'total_sumbangan' => $total_sumbangan,
            'total_pengunjung' => $total_pengunjung,
        ]);

        return redirect()->route('pengunjung.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Pengunjung $pengunjung)
    {
        $pengunjung->delete();
        return redirect()->route('pengunjung.index')->with('success', 'Data berhasil dihapus!');
    }
}
