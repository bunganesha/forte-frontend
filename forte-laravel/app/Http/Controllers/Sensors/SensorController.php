<?php

namespace App\Http\Controllers\Sensors;

use App\Http\Controllers\Controller;
use App\Models\Sensor;

class SensorController extends Controller
{
    public function dashboard()
    {
        $sensor = Sensor::latest()->first();

        return view('dashboard', compact('sensor'));
    }
}
