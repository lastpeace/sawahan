<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TukarUli extends Model
{
    protected $fillable = [
        'tanggal', 'uli_25', 'uli_5', 'uli_10', 'total',
    ];
}
