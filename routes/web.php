<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\UliController;
use App\Http\Controllers\TukarUliController;
use App\Http\Controllers\PengunjungController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/barang', BarangController::class);
    Route::resource('/uli', UliController::class);
    Route::resource('/tukaruli', TukarUliController::class);
       Route::resource('pengunjung', PengunjungController::class);
});

require __DIR__.'/auth.php';
