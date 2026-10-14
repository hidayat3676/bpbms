<?php

namespace App\Contracts\Services;

use App\Models\Beneficiary;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface BeneficiaryServiceInterface
 *
 * Defines business operations for Beneficiary Management.
 */
interface BeneficiaryServiceInterface
{
    /**
     * Register a new beneficiary from validated form input.
     */
    public function registerBeneficiary(array $data): Beneficiary;

    /**
     * Generate next sequential Application / Farm No.
     */
    public function generateNextApplicationNo(): string;

    /**
     * Get paginated beneficiaries with search and filters.
     */
    public function getBeneficiaries(int $perPage = 15, array $filters = []): LengthAwarePaginator;

    /**
     * Get beneficiary by id.
     */
    public function getBeneficiaryById(int $id): ?Beneficiary;

    /**
     * Get overall statistics for BPBMS.
     */
    public function getDashboardStats(): array;
}
