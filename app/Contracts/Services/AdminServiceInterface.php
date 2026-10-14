<?php

namespace App\Contracts\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface AdminServiceInterface
 *
 * Defines Central Administration business capabilities.
 */
interface AdminServiceInterface
{
    /**
     * Get aggregate statistics across all KP districts.
     */
    public function getGlobalDashboardMetrics(): array;

    /**
     * Create and onboard a new District Officer user.
     */
    public function createDistrictOfficer(array $data): User;

    /**
     * List all registered District Officers.
     */
    public function listDistrictOfficers(): Collection;

    /**
     * Get submitted form counts and unit allocations grouped by district.
     */
    public function getDistrictWiseCounts(): array;
}
