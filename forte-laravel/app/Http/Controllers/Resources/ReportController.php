<?php

namespace App\Http\Controllers\Resources;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * ReportController: Menangani HTTP requests untuk Report
 * Menggunakan ReportService untuk business logic
 */
class ReportController extends Controller
{
    /**
     * @var ReportService
     */
    private ReportService $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * Display user's reports
     */
    public function index()
    {
        // Hanya user biasa yang bisa akses
        $this->authorize('viewAny', Report::class);

        $reports = $this->reportService->getUserReports(Auth::id());
        return view('user.reports.index', compact('reports'));
    }

    /**
     * Store report baru
     */
    public function store(Request $request)
    {
        // Hanya user biasa yang bisa akses
        $this->authorize('create', Report::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $this->reportService->createReport(Auth::id(), $validated);

        return redirect()->back()->with('success', 'Laporan berhasil disimpan!');
    }

    /**
     * Display all reports (admin only)
     */
    public function adminIndex()
    {
        // Hanya admin/supervisor yang bisa akses
        $this->authorize('viewAny', Report::class);

        $reports = $this->reportService->getAllReports();
        return view('admin.reports', compact('reports'));
    }

    /**
     * Approve report (admin only)
     */
    public function approve(Report $report)
    {
        $this->authorize('approve', $report);

        $this->reportService->approveReport($report);

        return redirect()->back()->with('success', 'Laporan disetujui!');
    }

    /**
     * Reject report (admin only)
     */
    public function reject(Report $report)
    {
        $this->authorize('reject', $report);

        $this->reportService->rejectReport($report);

        return redirect()->back()->with('success', 'Laporan ditolak!');
    }
}
