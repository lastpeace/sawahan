<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    protected $fillable = [
        'tanggal', 'waktu_kedatangan', 'jumlah_pengunjung',
        'jenis_kendaraan', 'uli_25', 'uli_5', 'uli_10', 'total'
    ];
}
