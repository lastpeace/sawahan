<?php
namespace App\Http\Controllers;

use App\Models\Uli;
use Illuminate\Http\Request;

class UliController extends Controller
{
    public function index()
    {
        $data = Uli::orderBy('tanggal', 'desc')->get();
        $ulis = Uli::all();
        return view('uli.index', compact('data','ulis'));
    }

    public function create()
    {
        return view('uli.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'kategori' => 'required',
            'uli_25' => 'required|integer',
            'uli_5' => 'required|integer',
            'uli_10' => 'required|integer',
        ]);

        $validated['total'] = $validated['uli_25'] + $validated['uli_5'] + $validated['uli_10'];

        Uli::create($validated);

        return redirect()->route('uli.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(Uli $uli)
    {
        return view('uli.edit', compact('uli'));
    }

    public function update(Request $request, Uli $uli)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'kategori' => 'required',
            'uli_25' => 'required|integer',
            'uli_5' => 'required|integer',
            'uli_10' => 'required|integer',
        ]);

        $validated['total'] = $validated['uli_25'] + $validated['uli_5'] + $validated['uli_10'];

        $uli->update($validated);

        return redirect()->route('uli.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy(Uli $uli)
    {
        $uli->delete();
        return redirect()->route('uli.index')->with('success', 'Data berhasil dihapus.');
    }
}
