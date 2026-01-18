<?php

namespace App\Services;

use App\Models\User;
use App\Models\CreditScoreLog;

/**
 * CreditScoreService: Service untuk mengelola credit score user
 * Mengimplementasikan business logic untuk credit scoring system
 */
class CreditScoreService
{
    /**
     * Min dan max credit score
     */
    private const MIN_SCORE = 0;
    private const MAX_SCORE = 100;

    /**
     * Credit score rules
     */
    private const SCORE_RULES = [
        'report_submitted' => 5,          // Report berhasil submit
        'report_approved' => 5,           // Report di-approve
        'report_rejected' => -5,          // Report di-reject
        'data_verified' => 8,             // Data terverifikasi
        'high_accuracy' => 12,            // Akurasi laporan tinggi
        'late_submission' => -5,          // Submisi terlambat
        'false_report' => -20,            // Laporan palsu/tidak akurat
        'compliance_check' => 3,          // Lolos compliance check
    ];

    /**
     * Update credit score user
     */
    public function updateCreditScore(
        User $user,
        int $changeAmount,
        string $reason,
        string $actionType,
        array $metadata = []
    ): CreditScoreLog {
        $previousScore = $user->credit_score;
        $newScore = max(self::MIN_SCORE, min(self::MAX_SCORE, $previousScore + $changeAmount));

        // Update user credit score
        $user->credit_score = $newScore;
        $user->save();

        // Log the change
        $log = CreditScoreLog::create([
            'user_id' => $user->id,
            'previous_score' => $previousScore,
            'new_score' => $newScore,
            'change_amount' => $changeAmount,
            'reason' => $reason,
            'action_type' => $actionType,
            'metadata' => $metadata,
        ]);

        return $log;
    }

    /**
     * Add points untuk action tertentu
     */
    public function addPoints(User $user, string $actionType, array $metadata = []): CreditScoreLog
    {
        $points = self::SCORE_RULES[$actionType] ?? 0;
        $reason = $this->getActionDescription($actionType);

        return $this->updateCreditScore($user, $points, $reason, $actionType, $metadata);
    }

    /**
     * Get credit score category
     */
    public function getCreditScoreCategory(int $score): array
    {
        if ($score >= 90) {
            return [
                'category' => 'Excellent',
                'color' => 'success',
                'description' => 'Pengguna sangat terpercaya',
            ];
        } elseif ($score >= 75) {
            return [
                'category' => 'Good',
                'color' => 'info',
                'description' => 'Pengguna terpercaya',
            ];
        } elseif ($score >= 50) {
            return [
                'category' => 'Fair',
                'color' => 'warning',
                'description' => 'Pengguna cukup terpercaya',
            ];
        } elseif ($score >= 25) {
            return [
                'category' => 'Poor',
                'color' => 'danger',
                'description' => 'Pengguna perlu peningkatan kredibilitas',
            ];
        } else {
            return [
                'category' => 'Critical',
                'color' => 'danger',
                'description' => 'Pengguna memiliki risiko kredibilitas tinggi',
            ];
        }
    }

    /**
     * Get user credit score info lengkap
     */
    public function getCreditScoreInfo(User $user): array
    {
        $category = $this->getCreditScoreCategory($user->credit_score);

        return [
            'score' => $user->credit_score,
            'category' => $category['category'],
            'color' => $category['color'],
            'description' => $category['description'],
            'percentage' => ($user->credit_score / self::MAX_SCORE) * 100,
            'last_activity' => $user->creditScoreLogs()
                ->latest()
                ->first(),
        ];
    }

    /**
     * Get credit score history
     */
    public function getCreditScoreHistory(User $user, int $limit = 10): array
    {
        return $user->creditScoreLogs()
            ->latest()
            ->take($limit)
            ->get()
            ->toArray();
    }

    /**
     * Get action description dari action type
     */
    private function getActionDescription(string $actionType): string
    {
        $descriptions = [
            'report_submitted' => 'Laporan berhasil disubmit',
            'report_approved' => 'Laporan disetujui admin (+5 poin)',
            'report_rejected' => 'Laporan ditolak admin (-5 poin)',
            'data_verified' => 'Data laporan terverifikasi',
            'high_accuracy' => 'Laporan memiliki akurasi tinggi',
            'late_submission' => 'Submisi laporan terlambat',
            'false_report' => 'Laporan tidak akurat atau palsu',
            'compliance_check' => 'Lolos compliance check',
        ];

        return $descriptions[$actionType] ?? 'Perubahan credit score';
    }

    /**
     * Check apakah user dapat submit report baru
     */
    public function canSubmitReport(User $user): bool
    {
        // User dengan score < 20 tidak bisa submit
        return $user->credit_score >= 20;
    }

    /**
     * Get penalty/reward configuration
     */
    public static function getScoreRules(): array
    {
        return self::SCORE_RULES;
    }

    /**
     * Reset credit score ke default (untuk admin)
     */
    public function resetCreditScore(User $user, string $reason = 'Admin reset'): CreditScoreLog
    {
        return $this->updateCreditScore(
            $user,
            100 - $user->credit_score,
            $reason,
            'admin_reset'
        );
    }
}
