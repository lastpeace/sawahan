<?php
namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengeluaran::query();

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $pengeluarans = $query->orderBy('tanggal', 'desc')->get();

        return view('pengeluaran.index', compact('pengeluarans'));
    }

    public function create()
    {
        return view('pengeluaran.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'hiburan' => 'nullable|numeric',
            'sarapan' => 'nullable|numeric',
            'kopi' => 'nullable|numeric',
            'simpanan_wajib' => 'nullable|numeric'
        ]);

        $data['total'] = ($data['hiburan'] ?? 0) + ($data['sarapan'] ?? 0) + ($data['kopi'] ?? 0) + ($data['simpanan_wajib'] ?? 0);

        Pengeluaran::create($data);

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function edit(Pengeluaran $pengeluaran)
    {
        return view('pengeluaran.edit', compact('pengeluaran'));
    }

    public function update(Request $request, Pengeluaran $pengeluaran)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'hiburan' => 'nullable|numeric',
            'sarapan' => 'nullable|numeric',
            'kopi' => 'nullable|numeric',
            'simpanan_wajib' => 'nullable|numeric'
        ]);

        $data['total'] = ($data['hiburan'] ?? 0) + ($data['sarapan'] ?? 0) + ($data['kopi'] ?? 0) + ($data['simpanan_wajib'] ?? 0);

        $pengeluaran->update($data);

        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil diperbarui');
    }

    public function destroy(Pengeluaran $pengeluaran)
    {
        $pengeluaran->delete();
        return redirect()->route('pengeluaran.index')->with('success', 'Pengeluaran berhasil dihapus');
    }
}
