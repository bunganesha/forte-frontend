<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class MQTTController extends Controller
{
    public function getLatestData()
    {
        return response()->json([
            'energy' => Cache::get('mqtt_energy_data', []),
            'gps'    => Cache::get('mqtt_gps_data', []),
            'imu'    => Cache::get('mqtt_imu_data', []),
            'status' => Cache::get('mqtt_status', []),
            'timestamp' => now()->toDateTimeString(),
        ]);
    }
}
