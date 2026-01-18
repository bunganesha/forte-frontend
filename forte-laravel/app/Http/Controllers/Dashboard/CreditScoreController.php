<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\CreditScoreService;

/**
 * CreditScoreController: Menangani credit score operations
 */
class CreditScoreController extends Controller
{
    private CreditScoreService $creditScoreService;

    public function __construct(CreditScoreService $creditScoreService)
    {
        $this->creditScoreService = $creditScoreService;
    }

    /**
     * Display credit score user
     */
    public function show()
    {
        $user = auth()->user();
        $creditScoreInfo = $this->creditScoreService->getCreditScoreInfo($user);
        $history = $this->creditScoreService->getCreditScoreHistory($user, 15);

        return view('dashboard.credit-score', compact('creditScoreInfo', 'history', 'user'));
    }

    /**
     * Get credit score info via API
     */
    public function getScoreInfo()
    {
        $user = auth()->user();
        $creditScoreInfo = $this->creditScoreService->getCreditScoreInfo($user);

        return response()->json([
            'success' => true,
            'data' => $creditScoreInfo,
        ]);
    }

    /**
     * Get credit score history via API
     */
    public function getHistory(Request $request)
    {
        $user = auth()->user();
        $limit = $request->query('limit', 10);
        $history = $this->creditScoreService->getCreditScoreHistory($user, $limit);

        return response()->json([
            'success' => true,
            'data' => $history,
        ]);
    }
}
