<?php

namespace App\Services;

use App\Contracts\Repositories\BeneficiaryRepositoryInterface;
use App\Contracts\Services\DistrictOfficerServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class DistrictOfficerService
 *
 * Implements DistrictOfficerServiceInterface.
 * Single Responsibility: Operations and metrics strictly scoped to an officer's assigned KP District.
 */
class DistrictOfficerService implements DistrictOfficerServiceInterface
{
    public function __construct(
        protected BeneficiaryRepositoryInterface $beneficiaryRepo,
        protected KpLocationService $locationService
    ) {}

    /**
     * Get dashboard summary metrics scoped to the officer's district.
     */
    public function getDistrictDashboardMetrics(string $district): array
    {
        $stats = $this->beneficiaryRepo->getDistrictStatistics($district);
        $allTehsils = $this->locationService->getTehsilsByDistrict($district);
        $stats['total_tehsils_in_district'] = count($allTehsils);

        return $stats;
    }

    /**
     * Get paginated beneficiaries submitted strictly in the officer's district.
     */
    public function getDistrictBeneficiaries(string $district, int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->beneficiaryRepo->paginateByDistrict($district, $perPage, $filters);
    }

    /**
     * Get distribution summary broken down by tehsils within the officer's district.
     */
    public function getTehsilBreakdown(string $district): array
    {
        $allTehsils = $this->locationService->getTehsilsByDistrict($district);
        $recordedTehsils = $this->beneficiaryRepo->getTehsilBreakdown($district);

        $breakdown = [];
        foreach ($allTehsils as $tehsil) {
            $record = $recordedTehsils[$tehsil] ?? null;
            $breakdown[$tehsil] = [
                'tehsil' => $tehsil,
                'forms_count' => $record['count'] ?? 0,
                'units_count' => $record['units_count'] ?? 0,
                'total_amount' => (float)($record['total_amount'] ?? 0),
            ];
        }

        // Sort by forms count descending
        uasort($breakdown, function ($a, $b) {
            return $b['forms_count'] <=> $a['forms_count'];
        });

        return $breakdown;
    }
}
