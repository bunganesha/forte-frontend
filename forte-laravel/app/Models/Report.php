<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Report Model
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string|null $image_path
 * @property float|null $latitude
 * @property float|null $longitude
 * @property int $user_id
 * @property string $status (pending, approved, rejected)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'latitude',
        'longitude',
        'user_id',
        'status',
    ];

    protected $casts = [
        'latitude' => 'float',
        'longitude' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get user yang membuat report
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get classifications untuk report ini
     */
    public function classifications(): BelongsToMany
    {
        return $this->belongsToMany(
            Classification::class,
            'classification_report'
        );
    }

    /**
     * Get validation untuk report ini
     */
    public function validation(): HasOne
    {
        return $this->hasOne(Validation::class);
    }

    /**
     * Check apakah report sudah diapprove
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check apakah report di-reject
     */
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    /**
     * Check apakah report masih pending
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
}
