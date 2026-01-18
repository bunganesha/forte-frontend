<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Services\RoleService;

/**
 * RoleController: Menangani HTTP requests untuk Role management
 * Menggunakan RoleService untuk business logic
 */
class RoleController extends Controller
{
    /**
     * @var RoleService
     */
    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    /**
     * Display list roles dengan pagination
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $roles = $this->roleService->getAllRoles($search);

        return view('admin.roles', compact('roles', 'search'));
    }

    /**
     * Store role baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'description' => 'nullable|string|max:500',
        ]);

        $this->roleService->createRole($validated);

        return back()->with('success', 'Role berhasil ditambahkan');
    }

    /**
     * Update role
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'description' => 'nullable|string|max:500',
        ]);

        $this->roleService->updateRole($role, $validated);

        return back()->with('success', 'Role berhasil diupdate');
    }

    /**
     * Delete role
     */
    public function destroy(Role $role)
    {
        // Cegah penghapusan role yang masih digunakan
        if ($role->users()->exists()) {
            return back()->with('error', 'Role tidak dapat dihapus karena masih digunakan oleh pengguna');
        }

        $this->roleService->deleteRole($role);
        return back()->with('success', 'Role berhasil dihapus');
    }

    /**
     * Show role details
     */
    public function show(Role $role)
    {
        $role->load('users');
        return view('admin.role-detail', compact('role'));
    }
}
