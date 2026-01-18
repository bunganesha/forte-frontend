<?php

namespace App\Repositories;

use App\Models\Role;

/**
 * RoleRepository: Repository untuk Role model
 * Mengimplementasikan Repository Pattern untuk database operations
 */
class RoleRepository extends AbstractRepository
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    /**
     * Get all roles dengan pagination dan search
     */
    public function getAll($search = null, $perPage = 15)
    {
        $query = $this->model;

        if ($search) {
            $query = $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Find role by name
     */
    public function findByName(string $name): ?Role
    {
        return $this->model->where('name', $name)->first();
    }

    /**
     * Create role baru
     */
    public function create(array $data): Role
    {
        return $this->model->create($data);
    }

    /**
     * Update role
     */
    public function update(Role $role, array $data): Role
    {
        $role->update($data);
        return $role;
    }

    /**
     * Delete role
     */
    public function delete(Role $role): bool
    {
        return $role->delete();
    }
}
