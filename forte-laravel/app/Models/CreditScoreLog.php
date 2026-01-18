<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * CreditScoreLog Model
 * Track semua perubahan credit score user
 */
class CreditScoreLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'previous_score',
        'new_score',
        'change_amount',
        'reason',
        'action_type',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    /**
     * Get user yang memiliki log ini
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
