<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    protected $fillable = ['report_id', 'admin_id', 'note', 'validated_at'];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}

