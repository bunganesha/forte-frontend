<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\RoleRepository;

/**
 * RoleService: Business logic untuk Role management
 */
class RoleService
{
    /**
     * @var RoleRepository
     */
    private RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Get all roles dengan pagination dan search
     */
    public function getAllRoles($search = null)
    {
        return $this->roleRepository->getAll($search);
    }

    /**
     * Create role baru
     */
    public function createRole(array $data): Role
    {
        return $this->roleRepository->create($data);
    }

    /**
     * Update role
     */
    public function updateRole(Role $role, array $data): Role
    {
        return $this->roleRepository->update($role, $data);
    }

    /**
     * Delete role
     */
    public function deleteRole(Role $role): bool
    {
        return $this->roleRepository->delete($role);
    }
}
