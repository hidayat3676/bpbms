<?php

namespace App\Repositories;

use App\Contracts\Repositories\BeneficiaryRepositoryInterface;
use App\Models\Beneficiary;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class BeneficiaryRepository
 *
 * Implements data persistence for Beneficiaries.
 */
class BeneficiaryRepository implements BeneficiaryRepositoryInterface
{
    public function __construct(
        protected Beneficiary $model
    ) {}

    /**
     * Get paginated beneficiaries with optional filters.
     */
    public function paginate(int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if (!empty($filters['search'])) {
            $query->search($filters['search']);
        }

        if (!empty($filters['district'])) {
            $query->inDistrict($filters['district']);
        }

        if (!empty($filters['tehsil'])) {
            $query->where('tehsil', $filters['tehsil']);
        }

        if (!empty($filters['vulnerability'])) {
            $vulnerability = $filters['vulnerability'];
            if (in_array($vulnerability, ['headed', 'widow', 'homeless', 'poor'])) {
                $column = 'is_' . $vulnerability;
                $query->where($column, true);
            }
        }

        return $query->latest('id')->paginate($perPage)->withQueryString();
    }

    /**
     * Retrieve all beneficiaries.
     */
    public function all(): Collection
    {
        return $this->model->latest('id')->get();
    }

    /**
     * Find a beneficiary by ID.
     */
    public function findById(int $id): ?Beneficiary
    {
        return $this->model->find($id);
    }

    /**
     * Find a beneficiary by Application Number.
     */
    public function findByApplicationNo(string $applicationNo): ?Beneficiary
    {
        return $this->model->where('application_no', $applicationNo)->first();
    }

    /**
     * Create a new beneficiary record.
     */
    public function create(array $attributes): Beneficiary
    {
        return $this->model->create($attributes);
    }

    /**
     * Get aggregate statistics for global BPBMS admin dashboard.
     */
    public function getStatistics(): array
    {
        $totalBeneficiaries = $this->model->count();
        $totalUnits = $this->model->where('one_unit_given', true)->count();
        $totalBirds = $totalUnits * 12;
        $totalAmount = (float) $this->model->sum('amount_received_per_unit');

        $widowCount = $this->model->where('is_widow', true)->count();
        $headedCount = $this->model->where('is_headed', true)->count();
        $homelessCount = $this->model->where('is_homeless', true)->count();
        $poorCount = $this->model->where('is_poor', true)->count();

        $districtsCount = $this->model->distinct('district')->count('district');

        return [
            'total_beneficiaries' => $totalBeneficiaries,
            'total_units' => $totalUnits,
            'total_birds' => $totalBirds,
            'total_amount_received' => $totalAmount,
            'widow_count' => $widowCount,
            'female_headed_count' => $headedCount,
            'homeless_count' => $homelessCount,
            'poor_count' => $poorCount,
            'districts_covered' => $districtsCount > 0 ? $districtsCount : 0,
        ];
    }

    /**
     * Get aggregate statistics scoped to a specific KP District.
     */
    public function getDistrictStatistics(string $district): array
    {
        $query = $this->model->where('district', $district);

        $totalBeneficiaries = (clone $query)->count();
        $totalUnits = (clone $query)->where('one_unit_given', true)->count();
        $totalBirds = $totalUnits * 12;
        $totalAmount = (float) (clone $query)->sum('amount_received_per_unit');

        $widowCount = (clone $query)->where('is_widow', true)->count();
        $headedCount = (clone $query)->where('is_headed', true)->count();
        $homelessCount = (clone $query)->where('is_homeless', true)->count();
        $poorCount = (clone $query)->where('is_poor', true)->count();

        $tehsilsCount = (clone $query)->distinct('tehsil')->count('tehsil');

        return [
            'district' => $district,
            'total_beneficiaries' => $totalBeneficiaries,
            'total_units' => $totalUnits,
            'total_birds' => $totalBirds,
            'total_amount_received' => $totalAmount,
            'widow_count' => $widowCount,
            'female_headed_count' => $headedCount,
            'homeless_count' => $homelessCount,
            'poor_count' => $poorCount,
            'tehsils_covered' => $tehsilsCount,
        ];
    }

    /**
     * Get submitted form counts grouped by all KP districts.
     */
    public function getCountsByAllDistricts(): array
    {
        return $this->model
            ->select('district', DB::raw('count(*) as count'), DB::raw('sum(case when one_unit_given then 1 else 0 end) as units_count'), DB::raw('sum(amount_received_per_unit) as total_amount'))
            ->groupBy('district')
            ->orderBy('count', 'desc')
            ->get()
            ->keyBy('district')
            ->toArray();
    }

    /**
     * Get counts broken down by tehsils for a specific KP District.
     */
    public function getTehsilBreakdown(string $district): array
    {
        return $this->model
            ->where('district', $district)
            ->select('tehsil', DB::raw('count(*) as count'), DB::raw('sum(case when one_unit_given then 1 else 0 end) as units_count'), DB::raw('sum(amount_received_per_unit) as total_amount'))
            ->groupBy('tehsil')
            ->orderBy('count', 'desc')
            ->get()
            ->keyBy('tehsil')
            ->toArray();
    }

    /**
     * Paginate beneficiaries strictly scoped to a specific district.
     */
    public function paginateByDistrict(string $district, int $perPage = 15, array $filters = []): LengthAwarePaginator
    {
        $query = $this->model->where('district', $district);

        if (!empty($filters['search'])) {
            $query->search($filters['search']);
        }

        if (!empty($filters['tehsil'])) {
            $query->where('tehsil', $filters['tehsil']);
        }

        if (!empty($filters['vulnerability'])) {
            $vulnerability = $filters['vulnerability'];
            if (in_array($vulnerability, ['headed', 'widow', 'homeless', 'poor'])) {
                $column = 'is_' . $vulnerability;
                $query->where($column, true);
            }
        }

        return $query->latest('id')->paginate($perPage)->withQueryString();
    }
}
