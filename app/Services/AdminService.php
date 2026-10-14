<?php

namespace App\Services;

use App\Contracts\Repositories\BeneficiaryRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\AdminServiceInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class AdminService
 *
 * Implements AdminServiceInterface.
 * Single Responsibility: Central Administration, District Officer onboarding & global analytics.
 */
class AdminService implements AdminServiceInterface
{
    public function __construct(
        protected BeneficiaryRepositoryInterface $beneficiaryRepo,
        protected UserRepositoryInterface $userRepo,
        protected KpLocationService $locationService
    ) {}

    /**
     * Get aggregate statistics across all KP districts.
     */
    public function getGlobalDashboardMetrics(): array
    {
        $stats = $this->beneficiaryRepo->getStatistics();
        $stats['total_officers'] = $this->userRepo->countDistrictOfficers();
        $stats['total_districts_kp'] = count($this->locationService->getDistricts());

        return $stats;
    }

    /**
     * Create and onboard a new District Officer user.
     */
    public function createDistrictOfficer(array $data): User
    {
        return $this->userRepo->createDistrictOfficer($data);
    }

    /**
     * List all registered District Officers.
     */
    public function listDistrictOfficers(): Collection
    {
        return $this->userRepo->getDistrictOfficers();
    }

    /**
     * Get submitted form counts and unit allocations grouped by district.
     */
    public function getDistrictWiseCounts(): array
    {
        $allDistricts = $this->locationService->getDistricts();
        $recordedCounts = $this->beneficiaryRepo->getCountsByAllDistricts();

        $result = [];
        foreach ($allDistricts as $district) {
            $record = $recordedCounts[$district] ?? null;
            $result[$district] = [
                'district' => $district,
                'forms_count' => $record['count'] ?? 0,
                'units_count' => $record['units_count'] ?? 0,
                'total_amount' => (float)($record['total_amount'] ?? 0),
            ];
        }

        // Sort by forms_count descending, then district name
        uasort($result, function ($a, $b) {
            if ($b['forms_count'] === $a['forms_count']) {
                return strcmp($a['district'], $b['district']);
            }
            return $b['forms_count'] <=> $a['forms_count'];
        });

        return $result;
    }
}
