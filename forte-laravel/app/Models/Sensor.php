<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Sensor Model
 *
 * @property int $id
 * @property float $latitude
 * @property float $longitude
 * @property float|null $daya
 * @property float|null $accelx
 * @property float|null $accely
 * @property float|null $accelz
 * @property string|null $zone
 * @property bool|null $anomaly
 * @property string|null $description
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Sensor extends Model
{
    use HasFactory;

    protected $fillable = [
        'latitude',
        'longitude',
        'daya',
        'accelx',
        'accely',
        'accelz',
        'zone',
        'anomaly',
        'description',
        'user_id',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'daya' => 'float',
        'accelx' => 'float',
        'accely' => 'float',
        'accelz' => 'float',
        'anomaly' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get user yang memiliki sensor ini
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get logs untuk sensor ini
     */
    public function logs(): HasMany
    {
        return $this->hasMany(SensorLog::class);
    }

    /**
     * Get latest log dari sensor
     */
    public function latestLog()
    {
        return $this->hasOne(SensorLog::class)->latest();
    }

    /**
     * Check apakah sensor memiliki anomaly
     */
    public function hasAnomaly(): bool
    {
        return $this->anomaly === true;
    }
}
