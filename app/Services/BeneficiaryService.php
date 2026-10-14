<?php

namespace App\Services;

use App\Contracts\Repositories\BeneficiaryRepositoryInterface;
use App\Contracts\Services\BeneficiaryServiceInterface;
use App\Models\Beneficiary;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

/**
 * Class BeneficiaryService
 *
 * Implements BeneficiaryServiceInterface.
 * Coordinates business logic, input normalization, and persistence.
 */
class BeneficiaryService implements BeneficiaryServiceInterface
{
    public function __construct(
        protected BeneficiaryRepositoryInterface $repository,
        protected KpLocationService $locationService
    ) {}

    /**
     * Register a new beneficiary from validated form input.
     */
    public function registerBeneficiary(array $data): Beneficiary
    {
        // Generate application number if not manually provided
        $applicationNo = !empty($data['application_no']) 
            ? trim($data['application_no']) 
            : $this->generateNextApplicationNo();

        // Process vulnerability checklist values: Headed, widow, homeless, poor
        $vulnerabilities = $data['vulnerabilities'] ?? [];
        if (is_string($vulnerabilities)) {
            $vulnerabilities = [$vulnerabilities];
        }

        $isHeaded = in_array('headed', $vulnerabilities, true);
        $isWidow = in_array('widow', $vulnerabilities, true);
        $isHomeless = in_array('homeless', $vulnerabilities, true);
        $isPoor = in_array('poor', $vulnerabilities, true);

        // Normalize CNIC format: XXXXX-XXXXXXX-X
        $rawCnic = preg_replace('/[^0-9]/', '', (string)($data['cnic_no'] ?? ''));
        if (strlen($rawCnic) === 13) {
            $formattedCnic = substr($rawCnic, 0, 5) . '-' . substr($rawCnic, 5, 7) . '-' . substr($rawCnic, 12, 1);
        } else {
            $formattedCnic = trim($data['cnic_no'] ?? '');
        }

        // Amount received per unit (default 1050 if empty)
        $amountReceived = isset($data['amount_received_per_unit']) 
            ? (float) $data['amount_received_per_unit'] 
            : 1050.00;

        $recordData = [
            'application_no' => $applicationNo,
            'beneficiary_name' => trim($data['beneficiary_name']),
            'gender' => 'female', // Beneficiary Name (female only)
            'wife_or_widow_of' => trim($data['wife_or_widow_of']),
            'cnic_no' => $formattedCnic,
            'district' => trim($data['district']),
            'tehsil' => trim($data['tehsil']),
            'village' => trim($data['village']),
            'address' => trim($data['address']),
            'contact_no' => trim($data['contact_no']),
            'one_unit_given' => !empty($data['one_unit_given']),
            'vulnerabilities' => array_values(array_unique($vulnerabilities)),
            'is_headed' => $isHeaded,
            'is_widow' => $isWidow,
            'is_homeless' => $isHomeless,
            'is_poor' => $isPoor,
            'amount_received_per_unit' => $amountReceived,
            'status' => 'verified',
            'remarks' => $data['remarks'] ?? 'One unit (12 birds) poultry package issued.',
        ];

        return $this->repository->create($recordData);
    }

    /**
     * Generate next sequential Application / Farm No.
     */
    public function generateNextApplicationNo(): string
    {
        $year = date('Y');
        $random = strtoupper(Str::random(4));
        $count = Beneficiary::count() + 1;
        $padded = str_pad((string)$count, 4, '0', STR_PAD_LEFT);

        return "BPBMS-{$year}-{$padded}-{$random}";
    }

    /**
     * Get paginated beneficiaries with search and filters.
     */
    public function getBeneficiaries(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $filters);
    }

    /**
     * Get beneficiary by id.
     */
    public function getBeneficiaryById(int $id): ?Beneficiary
    {
        return $this->repository->findById($id);
    }

    /**
     * Get overall statistics for BPBMS.
     */
    public function getDashboardStats(): array
    {
        return $this->repository->getStatistics();
    }
}
