<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;
use Illuminate\Auth\Access\Response;

/**
 * ReportPolicy: Menangani authorization untuk Report
 * Mengikuti principle of least privilege
 */
class ReportPolicy
{
    /**
     * User biasa bisa lihat report mereka sendiri
     * Admin bisa lihat semua report
     */
    public function view(User $user, Report $report): bool
    {
        return $user->isAdmin() || $user->id === $report->user_id;
    }

    /**
     * Hanya user yang membuat report bisa lihat
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * User biasa bisa create report
     * Admin tidak bisa create report (pakai route admin saja)
     */
    public function create(User $user): Response
    {
        return $user->isAdmin()
            ? Response::deny('Admin tidak dapat membuat report melalui route ini')
            : Response::allow();
    }

    /**
     * Owner bisa update report mereka
     */
    public function update(User $user, Report $report): Response
    {
        return $user->id === $report->user_id
            ? Response::allow()
            : Response::deny('Anda tidak memiliki akses');
    }

    /**
     * Owner bisa delete report mereka
     */
    public function delete(User $user, Report $report): Response
    {
        return $user->id === $report->user_id
            ? Response::allow()
            : Response::deny('Anda tidak memiliki akses');
    }

    /**
     * Hanya admin/supervisor bisa approve
     */
    public function approve(User $user, Report $report): Response
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny('Hanya admin yang dapat approve report');
    }

    /**
     * Hanya admin/supervisor bisa reject
     */
    public function reject(User $user, Report $report): Response
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny('Hanya admin yang dapat reject report');
    }
}
