<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startTime = Carbon::create(2026, 1, 10, 0, 0, 0);
        $energyWh = 0;

        for ($i = 0; $i < 120; $i++) { // 120 data (2 jam, interval 1 menit)

            $voltage = rand(215, 230);             // Tegangan PLN normal
            $current = rand(3, 8) / 10;            // 0.3A – 0.8A
            $power   = round($voltage * $current); // Watt

            // Energi per menit (Wh)
            $energyIncrement = $power / 60;
            $energyWh += $energyIncrement;

            DB::table('powers')->insert([
                'voltage'     => $voltage,
                'current'     => $current,
                'power'       => $power,
                'energy_wh'   => round($energyWh, 2),
                'energy_kwh'  => round($energyWh / 1000, 4),
                'created_at'  => $startTime->copy()->addMinutes($i),
                'updated_at'  => null,
            ]);
        }
    }
}
