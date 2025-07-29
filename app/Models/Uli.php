<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uli extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'kategori',
        'uli_25',
        'kps_25',
        'uli_5',
        'kps_5',
        'uli_10',
        'kps_10',
        'total'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($uli) {
            $uli->total = $uli->uli_25 + $uli->uli_5 + $uli->uli_10;
        });
    }
}
