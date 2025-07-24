<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uli extends Model
{
    protected $fillable = [
        'tanggal', 'kategori', 'uli_25', 'uli_5', 'uli_10', 'total'
    ];
}

