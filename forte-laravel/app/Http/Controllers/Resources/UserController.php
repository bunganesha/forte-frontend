<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserService;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * UserController: Menangani HTTP requests untuk User
 * Menggunakan UserService untuk business logic
 */
class UserController extends Controller
{
    /**
     * @var UserService
     */
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display list users dengan pagination
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $users = $this->userService->getAllUsers($search);

        return view('admin.users', compact('users', 'search'));
    }

    /**
     * Store user baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4|string',
            'role' => 'required|in:user,admin',
        ]);

        $this->userService->createUser($validated);

        return back()->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Update user
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:4|string',
            'role' => 'required|in:user,admin',
        ]);

        $this->userService->updateUser($user, $validated);

        return back()->with('success', 'User berhasil diupdate');
    }

    /**
     * Delete user
     */
    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);
        return back()->with('success', 'User berhasil dihapus');
    }

    /**
     * Export users ke CSV
     */
    public function exportCsv(): StreamedResponse
    {
        $csvData = $this->userService->exportToCSV();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$csvData['filename']}\"",
        ];

        $callback = function () use ($csvData) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $csvData['headers']);
            foreach ($csvData['data'] as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Import users dari CSV
     */
    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        $file = $request->file('csv_file')->getRealPath();
        $this->userService->importFromCSV($file);

        return redirect()->back()->with('success', 'Users berhasil diimport!');
    }
}
