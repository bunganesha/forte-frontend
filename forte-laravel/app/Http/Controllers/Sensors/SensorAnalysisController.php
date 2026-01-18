<?php

namespace App\Http\Controllers\Sensors;

use App\Http\Controllers\Controller;
use App\Models\Sensor;
use Illuminate\Support\Facades\Http;

class SensorAnalysisController extends Controller
{
    public function analyzeLatest()
    {
        $sensor = Sensor::latest()->first();

        if (!$sensor) {
            return redirect()->back()->with('error', 'Data sensor belum tersedia');
        }

        $response = Http::post('http://127.0.0.1:5000/analyze/sensor', [
            'temperature' => $sensor->temperature ?? null,
            'humidity'    => $sensor->humidity ?? null,
            'pressure'    => $sensor->pressure ?? null,
            'light'       => $sensor->light ?? null,
            'voltage'     => $sensor->daya ?? null,
            'accel' => [
                'x' => $sensor->accelx,
                'y' => $sensor->accely,
                'z' => $sensor->accelz,
            ],
        ]);

        if ($response->failed()) {
            return redirect()->back()->with('error', 'Flask service tidak merespons');
        }

        $result = $response->json();

        $sensor->update([
            'anomaly'     => $result['anomaly'],
            'zone'        => $result['zone'],
            'description' => $result['description'],
        ]);

        return redirect()->route('dashboard');
    }
}
