<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Report;
use App\Models\User;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua user ID
        $userIds = User::pluck('id')->toArray();

        if (empty($userIds)) {
            $this->command->warn('Seeder Report dibatalkan: user belum tersedia.');
            return;
        }

        $statuses = ['pending', 'approved', 'rejected'];

        // Jumlah data (bebas, bisa kamu ubah)
        $totalReports = 25;

        for ($i = 0; $i < $totalReports; $i++) {
            $hasLocation = $faker->boolean(70); // 70% punya lokasi
            $hasImage = $faker->boolean(60);    // 60% punya gambar

            Report::create([
                'title' => ucfirst($faker->words(rand(2, 4), true)),
                'description' => $faker->sentence(rand(8, 15)),
                'image_path' => $hasImage
                    ? 'reports/' . $faker->uuid . '.png'
                    : null,
                'latitude' => $hasLocation
                    ? $faker->latitude(-90, 90)
                    : null,
                'longitude' => $hasLocation
                    ? $faker->longitude(-180, 180)
                    : null,
                'status' => 'pending',
                'user_id' => 8,
                'created_at' => Carbon::now()->subDays(rand(0, 14)),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
