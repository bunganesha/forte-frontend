<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * UserService: Menangani semua business logic terkait User
 * Mengikuti Single Responsibility Principle
 */
class UserService
{
    /**
     * Get users dengan pagination dan search
     */
    public function getAllUsers(string $search = null, int $perPage = 10): LengthAwarePaginator
    {
        return User::when($search, function ($query, $search) {
            return $query->where('username', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Create user baru dengan role
     */
    public function createUser(array $data): User
    {
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if (isset($data['role'])) {
            $user->assignRole($data['role']);
        }

        return $user;
    }

    /**
     * Update user data
     */
    public function updateUser(User $user, array $data): User
    {
        $user->update([
            'username' => $data['username'] ?? $user->username,
            'email' => $data['email'] ?? $user->email,
        ]);

        if (isset($data['password']) && !empty($data['password'])) {
            $user->update(['password' => Hash::make($data['password'])]);
        }

        if (isset($data['role'])) {
            $user->syncRoles([$data['role']]);
        }

        return $user->refresh();
    }

    /**
     * Delete user
     */
    public function deleteUser(User $user): bool
    {
        return $user->delete();
    }

    /**
     * Export users ke CSV format
     */
    public function exportToCSV(): array
    {
        $users = User::all();

        return [
            'headers' => ['ID', 'Username', 'Email', 'Role', 'Joined At'],
            'data' => $users->map(function ($user) {
                return [
                    $user->id,
                    $user->username,
                    $user->email,
                    $user->getRoleNames()->first() ?? 'user',
                    $user->created_at->format('d M Y'),
                ];
            })->toArray(),
            'filename' => 'users_' . date('Ymd_His') . '.csv'
        ];
    }

    /**
     * Import users dari CSV
     */
    public function importFromCSV($file): int
    {
        $handle = fopen($file, 'r');
        $header = fgetcsv($handle);
        $importedCount = 0;

        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            User::updateOrCreate(
                ['email' => $row[2]],
                [
                    'username' => $row[1],
                    'password' => Hash::make('password123'),
                ]
            );
            $importedCount++;
        }

        fclose($handle);

        return $importedCount;
    }
}
