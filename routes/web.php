<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UliController;
use App\Http\Controllers\PengunjungController;
use App\Http\Controllers\PedagangController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\LaporanController;


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/uli/create/tukar', [UliController::class, 'createTukar'])->name('uli.createtukar.tukar');
    Route::get('/uli/create/kembali', [UliController::class, 'createKembali'])->name('uli.createkembali.kembali');
    Route::resource('uli', UliController::class);
    Route::resource('pengunjung', PengunjungController::class);
    Route::resource('pedagang', PedagangController::class);
    Route::resource('pengeluaran', PengeluaranController::class);
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');


});

require __DIR__ . '/auth.php';
