<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\RaspiService;

/**
 * DashboardController: Menangani tampilan dashboard
 * Menggunakan RaspiService untuk komunikasi dengan hardware
 */
class DashboardController extends Controller
{
    /**
     * @var RaspiService
     */
    private RaspiService $raspiService;

    public function __construct(RaspiService $raspiService)
    {
        $this->raspiService = $raspiService;
    }

    /**
     * Show dashboard view
     */
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } else {
            return view('operator.dashboard');
        }
    }

    /**
     * Fetch data dari Raspberry Pi
     */
    public function fetchData()
    {
        return response()->json($this->raspiService->getLatestData());
    }

    /**
     * Check camera status
     */
    public function cameraStatus()
    {
        return response()->json($this->raspiService->getCameraStatus());
    }
}
