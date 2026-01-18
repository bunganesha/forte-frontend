<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * SensorLog Model
 *
 * @property int $id
 * @property int $sensor_id
 * @property mixed $value
 * @property string|null $status
 * @property \Illuminate\Support\Carbon|null $captured_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class SensorLog extends Model
{
    use HasFactory;

    protected $fillable = ['sensor_id', 'value', 'status', 'captured_at'];

    protected $casts = [
        'captured_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get sensor yang punya log ini
     */
    public function sensor(): BelongsTo
    {
        return $this->belongsTo(Sensor::class);
    }
}
