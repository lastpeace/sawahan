<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokUli extends Model
{
    protected $fillable = [
        'uli_25', 'kps_25',
        'uli_5', 'kps_5',
        'uli_10', 'kps_10'
    ];
}
