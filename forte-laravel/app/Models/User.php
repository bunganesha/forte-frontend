<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * User Model
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property int $credit_score
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'username',
        'email',
        'password',
        'credit_score',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get reports yang dibuat user
     */
    public function reports(): HasMany
    {
        return $this->hasMany(Report::class);
    }

    /**
     * Get sensors yang dimiliki user
     */
    public function sensors(): HasMany
    {
        return $this->hasMany(Sensor::class);
    }

    /**
     * Get transactions user
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get credit score logs user
     */
    public function creditScoreLogs(): HasMany
    {
        return $this->hasMany(CreditScoreLog::class);
    }

    /**
     * Get user permissions sebagai array
     */
    public function getUserPermissions(): array
    {
        return $this->getAllPermissions()
            ->mapWithKeys(fn($permission) => [$permission['name'] => true])
            ->toArray();
    }

    /**
     * Check apakah user adalah admin
     */
    public function isAdmin(): bool
    {
        return $this->hasRole(['admin', 'supervisor']);
    }
}

