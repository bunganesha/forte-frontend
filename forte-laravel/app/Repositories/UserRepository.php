<?php

namespace App\Repositories;

use App\Models\User;

/**
 * UserRepository: Repository untuk User model
 * Mengimplementasikan Repository Pattern untuk database operations
 */
class UserRepository extends AbstractRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Find user by email
     */
    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * Find users dengan role tertentu
     */
    public function findByRole(string $role)
    {
        return $this->model->role($role)->get();
    }

    /**
     * Search users berdasarkan username atau email
     */
    public function search(string $searchTerm, int $perPage = 15)
    {
        return $this->model
            ->where('username', 'like', "%{$searchTerm}%")
            ->orWhere('email', 'like', "%{$searchTerm}%")
            ->paginate($perPage);
    }
}
