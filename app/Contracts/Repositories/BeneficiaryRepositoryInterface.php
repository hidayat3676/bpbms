<?php

namespace App\Contracts\Repositories;

use App\Models\Beneficiary;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * Interface BeneficiaryRepositoryInterface
 *
 * Adheres to Interface Segregation and Dependency Inversion Principles.
 */
interface BeneficiaryRepositoryInterface
{
    /**
     * Get paginated beneficiaries with optional filters.
     */
    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    /**
     * Retrieve all beneficiaries.
     */
    public function all(): Collection;

    /**
     * Find a beneficiary by ID.
     */
    public function findById(int $id): ?Beneficiary;

    /**
     * Find a beneficiary by Application Number.
     */
    public function findByApplicationNo(string $applicationNo): ?Beneficiary;

    /**
     * Create a new beneficiary record.
     */
    public function create(array $attributes): Beneficiary;

    /**
     * Get aggregate statistics for global dashboard and impact report.
     */
    public function getStatistics(): array;

    /**
     * Get aggregate statistics scoped to a specific KP District.
     */
    public function getDistrictStatistics(string $district): array;

    /**
     * Get submitted form counts grouped by all KP districts.
     */
    public function getCountsByAllDistricts(): array;

    /**
     * Get counts broken down by tehsils for a specific KP District.
     */
    public function getTehsilBreakdown(string $district): array;

    /**
     * Paginate beneficiaries strictly scoped to a specific district.
     */
    public function paginateByDistrict(string $district, int $perPage = 15, array $filters = []): LengthAwarePaginator;
}
