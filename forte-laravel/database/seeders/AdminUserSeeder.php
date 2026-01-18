<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'username' => 'Zahratu',
            'email' => 'admin@forte.com',
            'password' => bcrypt('password123'), // Ganti sesuai mau lo
        ]);

        // 3. Tempelkan Role ke User
        $user->assignRole('admin');

        $supervisor = User::firstOrCreate(
            ['email' => 'supervisor@forte.com'],
            [
                'username' => 'Supervisor01',
                'password' => Hash::make('password123'),
            ]
        );
        $supervisor->assignRole('supervisor');

        $users = [
            ['username' => 'Aulia',   'email' => 'aulia@forte.com',   'role' => 'user'],
            ['username' => 'Bima',    'email' => 'bima@forte.com',    'role' => 'user'],
            ['username' => 'Cahya',   'email' => 'cahya@forte.com',   'role' => 'user'],
            ['username' => 'Dimas',   'email' => 'dimas@forte.com',   'role' => 'user'],
            ['username' => 'Eka',     'email' => 'eka@forte.com',     'role' => 'user'],
            ['username' => 'Fajar',   'email' => 'fajar@forte.com',   'role' => 'user'],
            ['username' => 'Gilang',  'email' => 'gilang@forte.com',  'role' => 'user'],
            ['username' => 'Hana',    'email' => 'hana@forte.com',    'role' => 'user'],
            ['username' => 'Indra',   'email' => 'indra@forte.com',   'role' => 'user'],
            ['username' => 'Joko',    'email' => 'joko@forte.com',    'role' => 'user'],
            ['username' => 'Kirana',  'email' => 'kirana@forte.com',  'role' => 'user'],
            ['username' => 'Laras',   'email' => 'laras@forte.com',   'role' => 'user'],
            ['username' => 'Maya',    'email' => 'maya@forte.com',    'role' => 'user'],
            ['username' => 'Nanda',   'email' => 'nanda@forte.com',   'role' => 'user'],
            ['username' => 'Oktavia', 'email' => 'oktavia@forte.com', 'role' => 'user'],
        ];

        foreach ($users as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'username' => $data['username'],
                    'password' => Hash::make('password123'),
                ]
            );

            $user->assignRole($data['role']);
        }
    }
}
