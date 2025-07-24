<?php

namespace App\Http\Controllers;

use App\Models\Pengunjung;
use Illuminate\Http\Request;

class PengunjungController extends Controller
{
    public function index()
    {
        $pengunjungs = Pengunjung::all();
        return view('pengunjung.index', compact('pengunjungs'));
    }

    public function create()
    {
        return view('pengunjung.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'waktu_kedatangan' => 'required',
            'jumlah_pengunjung' => 'required|integer',
            'jenis_kendaraan' => 'required',
            'uli_25' => 'required|integer',
            'uli_5' => 'required|integer',
            'uli_10' => 'required|integer',
        ]);

        $data['total'] = $data['uli_25'] + $data['uli_5'] + $data['uli_10'];

        Pengunjung::create($data);

        return redirect()->route('pengunjung.index')->with('success', 'Data berhasil ditambahkan.');
    }
}
