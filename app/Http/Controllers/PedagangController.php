<?php
namespace App\Http\Controllers;

use App\Models\Pedagang;
use Illuminate\Http\Request;

class PedagangController extends Controller
{
    public function index(Request $request)
    {
        $query = Pedagang::query();

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $pedagangs = $query->orderBy('tanggal', 'desc')->get();

        return view('pedagang.index', compact('pedagangs'));
    }


    public function create()
    {
        return view('pedagang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama_pedagang' => 'required|string|max:255',
            'pendapatan' => 'required|numeric|min:0',
            'kebersihan' => 'nullable|numeric|min:0',
        ]);

        $potongan = $request->pendapatan * 0.10;
        $total = $request->pendapatan - $potongan - ($request->kebersihan ?? 0);

        Pedagang::create([
            'tanggal' => $request->tanggal,
            'nama_pedagang' => $request->nama_pedagang,
            'pendapatan' => $request->pendapatan,
            'potongan' => $potongan,
            'kebersihan' => $request->kebersihan ?? 0,
            'total' => $total
        ]);

        return redirect()->route('pedagang.index')->with('success', 'Data Pedagang berhasil ditambahkan.');
    }

    public function edit(Pedagang $pedagang)
    {
        return view('pedagang.edit', compact('pedagang'));
    }

    public function update(Request $request, Pedagang $pedagang)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama_pedagang' => 'required|string|max:255',
            'pendapatan' => 'required|numeric|min:0',
            'kebersihan' => 'nullable|numeric|min:0',
        ]);

        $potongan = $request->pendapatan * 0.10;
        $total = $request->pendapatan - $potongan - ($request->kebersihan ?? 0);

        $pedagang->update([
            'tanggal' => $request->tanggal,
            'nama_pedagang' => $request->nama_pedagang,
            'pendapatan' => $request->pendapatan,
            'potongan' => $potongan,
            'kebersihan' => $request->kebersihan ?? 0,
            'total' => $total
        ]);

        return redirect()->route('pedagang.index')->with('success', 'Data Pedagang berhasil diperbarui.');
    }

    public function destroy(Pedagang $pedagang)
    {
        $pedagang->delete();
        return redirect()->route('pedagang.index')->with('success', 'Data Pedagang berhasil dihapus.');
    }
}
