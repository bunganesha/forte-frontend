<?php

namespace App\Services;

use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

/**
 * ReportService: Menangani semua business logic terkait Report
 */
class ReportService
{
    /**
     * @var CreditScoreService
     */
    private CreditScoreService $creditScoreService;

    public function __construct(CreditScoreService $creditScoreService)
    {
        $this->creditScoreService = $creditScoreService;
    }

    /**
     * Get reports untuk user
     */
    public function getUserReports(int $userId): Collection
    {
        return Report::where('user_id', $userId)
            ->latest()
            ->get();
    }

    /**
     * Get semua reports (untuk admin)
     */
    public function getAllReports(): Collection
    {
        return Report::latest()->get();
    }

    /**
     * Create report baru
     */
    public function createReport(int $userId, array $data): Report
    {
        $imagePath = null;

        if (isset($data['image']) && !empty($data['image'])) {
            $imagePath = $this->storeImage($data['image']);
        }

        return Report::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'image_path' => $imagePath,
            'latitude' => $data['latitude'] ?? null,
            'longitude' => $data['longitude'] ?? null,
            'user_id' => $userId,
            'status' => 'pending',
        ]);
    }

    /**
     * Approve report dan update credit score
     */
    public function approveReport(Report $report): Report
    {
        $report->update(['status' => 'approved']);

        // Tambah 5 poin credit score ke user
        $this->creditScoreService->addPoints(
            $report->user,
            'report_approved',
            [
                'report_id' => $report->id,
                'report_title' => $report->title,
            ]
        );

        return $report;
    }

    /**
     * Reject report dan update credit score
     */
    public function rejectReport(Report $report): Report
    {
        $report->update(['status' => 'rejected']);

        // Kurang 5 poin credit score ke user
        $this->creditScoreService->updateCreditScore(
            $report->user,
            -5,
            'Laporan ditolak oleh admin',
            'report_rejected',
            [
                'report_id' => $report->id,
                'report_title' => $report->title,
            ]
        );

        return $report;
    }

    /**
     * Store image dari base64
     */
    private function storeImage(string $imageData): string
    {
        $imageData = preg_replace('#^data:image/\w+;base64,#i', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $imageBinary = base64_decode($imageData);

        $filename = 'reports/' . uniqid() . '.png';
        Storage::disk('public')->put($filename, $imageBinary);

        return $filename;
    }
}
