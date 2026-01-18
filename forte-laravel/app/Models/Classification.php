<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Classification Model
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Classification extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    /**
     * Get reports yang memiliki classification ini
     */
    public function reports(): BelongsToMany
    {
        return $this->belongsToMany(Report::class, 'classification_report');
    }
}
