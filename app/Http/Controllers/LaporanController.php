<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengunjung;
use App\Models\Pedagang;
use App\Models\Pengeluaran;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        if (!$start || !$end) {
            return view('laporan.index', [
                'start' => null,
                'end' => null,
                'laporanHarian' => [],
                'totalPengunjung' => '-',
                'totalPemasukan' => '-',
                'totalPengeluaran' => '-',
                'saldo' => '-'
            ]);
        }

        $laporanHarian = [];

        // Ambil semua tanggal dalam range
        $tanggalList = Pengunjung::whereBetween('tanggal', [$start, $end])
            ->pluck('tanggal')
            ->merge(Pedagang::whereBetween('tanggal', [$start, $end])->pluck('tanggal'))
            ->merge(Pengeluaran::whereBetween('tanggal', [$start, $end])->pluck('tanggal'))
            ->unique()
            ->sort();

        foreach ($tanggalList as $tanggal) {
            $pengunjung = Pengunjung::whereDate('tanggal', $tanggal)->get();
            $pedagang = Pedagang::whereDate('tanggal', $tanggal)->get();
            $pengeluaran = Pengeluaran::whereDate('tanggal', $tanggal)->get();

            $jumlahPengunjung = $pengunjung->sum('total_pengunjung');
            $pemasukanPengunjung = $pengunjung->sum('total_sumbangan');
            $pemasukanPedagang = $pedagang->sum('potongan') + $pedagang->sum('kebersihan');
            $totalPengeluaran = $pengeluaran->sum('total');

            $totalPemasukan = $pemasukanPengunjung + $pemasukanPedagang;
            $saldo = $totalPemasukan - $totalPengeluaran;

            $laporanHarian[] = [
                'tanggal' => $tanggal,
                'jumlah_pengunjung' => $jumlahPengunjung,
                'pemasukan' => $totalPemasukan,
                'pengeluaran' => $totalPengeluaran,
                'saldo' => $saldo
            ];
        }

        // Hitung total seluruh range
        $totalPengunjung = array_sum(array_column($laporanHarian, 'jumlah_pengunjung'));
        $totalPemasukan = array_sum(array_column($laporanHarian, 'pemasukan'));
        $totalPengeluaran = array_sum(array_column($laporanHarian, 'pengeluaran'));
        $saldo = $totalPemasukan - $totalPengeluaran;

        return view('laporan.index', compact(
            'start',
            'end',
            'laporanHarian',
            'totalPengunjung',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo'
        ));
    }
}
