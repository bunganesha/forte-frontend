<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Power extends Model
{
    protected $fillable = [
        'voltage',
        'current',
        'power',
        'energy_wh',
        'energy_kwh',
        'created_at'
    ];
}
