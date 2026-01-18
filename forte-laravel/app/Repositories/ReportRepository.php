<?php

namespace App\Repositories;

use App\Models\Report;
use Illuminate\Database\Eloquent\Collection;

/**
 * ReportRepository: Repository untuk Report model
 */
class ReportRepository extends AbstractRepository
{
    public function __construct(Report $model)
    {
        parent::__construct($model);
    }

    /**
     * Get reports dari user tertentu
     */
    public function getByUser(int $userId): Collection
    {
        return $this->model
            ->where('user_id', $userId)
            ->latest()
            ->get();
    }

    /**
     * Get reports dengan status tertentu
     */
    public function getByStatus(string $status): Collection
    {
        return $this->model
            ->where('status', $status)
            ->latest()
            ->get();
    }

    /**
     * Get pending reports
     */
    public function getPending(): Collection
    {
        return $this->getByStatus('pending');
    }

    /**
     * Get approved reports
     */
    public function getApproved(): Collection
    {
        return $this->getByStatus('approved');
    }

    /**
     * Get rejected reports
     */
    public function getRejected(): Collection
    {
        return $this->getByStatus('rejected');
    }
}
