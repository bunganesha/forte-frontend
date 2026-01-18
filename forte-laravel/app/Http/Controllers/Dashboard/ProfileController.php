<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\CreditScoreService;
use App\Models\CreditScoreLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * ProfileController: Menangani halaman profile user
 */
class ProfileController extends Controller
{
    private CreditScoreService $creditScoreService;

    public function __construct(CreditScoreService $creditScoreService)
    {
        $this->creditScoreService = $creditScoreService;
    }

    /**
     * Display profile page dengan credit score
     */
    public function index()
    {
        $user = auth()->user();
        $creditScoreInfo = $this->creditScoreService->getCreditScoreInfo($user);
        $recentActivities = $this->creditScoreService->getCreditScoreHistory($user, 10);
        
        // Get last 7 days score data untuk chart
        $sevenDaysAgo = Carbon::now()->subDays(6)->startOfDay();
        $scoreHistory = CreditScoreLog::where('user_id', $user->id)
            ->where('created_at', '>=', $sevenDaysAgo)
            ->orderBy('created_at')
            ->get();

        // Prepare chart data: label hari dan score changes
        $chartLabels = [];
        $chartData = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dayLabel = $date->format('D');
            $chartLabels[] = $dayLabel;
            
            // Sum semua perubahan score dalam hari itu
            $dailyChange = $scoreHistory
                ->filter(fn($log) => $log->created_at->format('Y-m-d') === $date->format('Y-m-d'))
                ->sum('change_amount');
            
            $chartData[] = $dailyChange;
        }

        return view('landing.lp-setting-profile', compact(
            'user',
            'creditScoreInfo',
            'recentActivities',
            'chartLabels',
            'chartData'
        ));
    }

    /**
     * Get credit score info via API (JSON)
     */
    public function getCreditScoreData()
    {
        $user = auth()->user();
        $creditScoreInfo = $this->creditScoreService->getCreditScoreInfo($user);

        return response()->json([
            'success' => true,
            'data' => $creditScoreInfo,
        ]);
    }
}
