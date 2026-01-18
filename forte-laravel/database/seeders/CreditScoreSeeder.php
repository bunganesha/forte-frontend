<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CreditScoreLog;

class CreditScoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Initialize credit score untuk semua existing users
        $users = User::all();

        foreach ($users as $user) {
            // Set default credit score jika belum ada
            if ($user->credit_score === 0 || is_null($user->credit_score)) {
                $user->credit_score = 100;
                $user->save();

                // Log initial score
                CreditScoreLog::create([
                    'user_id' => $user->id,
                    'previous_score' => 0,
                    'new_score' => 100,
                    'change_amount' => 100,
                    'reason' => 'Initial credit score setup',
                    'action_type' => 'system_init',
                    'metadata' => ['initialized_at' => now()],
                ]);
            }
        }
    }
}
