<?php

namespace App\Contracts\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface DistrictOfficerServiceInterface
 *
 * Defines business operations scoped to a specific KP District.
 */
interface DistrictOfficerServiceInterface
{
    /**
     * Get dashboard summary metrics scoped to the officer's district.
     */
    public function getDistrictDashboardMetrics(string $district): array;

    /**
     * Get paginated beneficiaries submitted strictly in the officer's district.
     */
    public function getDistrictBeneficiaries(string $district, int $perPage = 15, array $filters = []): LengthAwarePaginator;

    /**
     * Get distribution summary broken down by tehsils within the officer's district.
     */
    public function getTehsilBreakdown(string $district): array;
}
