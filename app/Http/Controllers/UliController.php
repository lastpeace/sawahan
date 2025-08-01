<?php
namespace App\Http\Controllers;

use App\Models\Uli;
use Illuminate\Http\Request;

class UliController extends Controller
{
    public function index(Request $request)
    {
        $query = Uli::query();

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $ulis = $query->orderBy('tanggal', 'desc')->get();

        // ✅ Hitung stok per tanggal
        $stok = (object) [
            'uli_25' => $ulis->where('kategori', '!=', 'Uli Cadangan')->sum('uli_25'),
            'uli_5' => $ulis->where('kategori', '!=', 'Uli Cadangan')->sum('uli_5'),
            'uli_10' => $ulis->where('kategori', '!=', 'Uli Cadangan')->sum('uli_10'),
            'kps_25' => $ulis->where('kategori', '!=', 'Uli Cadangan')->sum('kps_25'),
            'kps_5' => $ulis->where('kategori', '!=', 'Uli Cadangan')->sum('kps_5'),
            'kps_10' => $ulis->where('kategori', '!=', 'Uli Cadangan')->sum('kps_10'),
        ];

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
        return view('uli.createtukar', compact('kategori'));
    }

    public function createKembali()
    {
        $kategori = "Uli Kembali";
        return view('uli.createkembali', compact('kategori'));
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

        if (in_array($request->kategori, ['Tukar Uli', 'Uli Kembali'])) {
            $uli_25 *= -1;
            $uli_5 *= -1;
            $uli_10 *= -1;
        }

        Uli::create([
            'tanggal' => $request->tanggal,
            'kategori' => $request->kategori,
            'uli_25' => $uli_25,
            'uli_5' => $uli_5,
            'uli_10' => $uli_10,
            'kps_25' => $uli_25 / 2500,
            'kps_5' => $uli_5 / 5000,
            'kps_10' => $uli_10 / 10000,
        ]);

        return redirect()->route('uli.index', ['tanggal' => $request->tanggal])
            ->with('success', 'Data Uli berhasil ditambahkan.');
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

        $uli_25 = $request->uli_25 ?? 0;
        $uli_5 = $request->uli_5 ?? 0;
        $uli_10 = $request->uli_10 ?? 0;

        if (in_array($request->kategori, ['Tukar Uli', 'Uli Kembali'])) {
            $uli_25 *= -1;
            $uli_5 *= -1;
            $uli_10 *= -1;
        }

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

        return redirect()->route('uli.index', ['tanggal' => $request->tanggal])
            ->with('success', 'Data Uli berhasil diperbarui.');
    }

    public function destroy(Uli $uli)
    {
        $uli->delete();
        return redirect()->route('uli.index')->with('success', 'Data Uli berhasil dihapus.');
    }
}
