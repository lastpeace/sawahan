<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengunjung extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'sumbangan_motor',
        'sumbangan_mobil',
        'total_sumbangan',
        'total_pengunjung'
    ];
}
