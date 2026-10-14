<?php

namespace App\Http\Controllers\Officer;

use App\Contracts\Services\DistrictOfficerServiceInterface;
use App\Http\Controllers\Controller;
use App\Services\KpLocationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

/**
 * Class DistrictOfficerDashboardController
 *
 * Single Responsibility: Handling District Officer Panel HTTP requests and district-scoped data.
 */
class DistrictOfficerDashboardController extends Controller
{
    public function __construct(
        protected DistrictOfficerServiceInterface $officerService,
        protected KpLocationService $locationService
    ) {}

    /**
     * Display the District Officer Dashboard with summary for their assigned district.
     */
    public function index(): View
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $district = $user->district;

        $summary = $this->officerService->getDistrictDashboardMetrics($district);
        $tehsilBreakdown = $this->officerService->getTehsilBreakdown($district);
        $recentBeneficiaries = $this->officerService->getDistrictBeneficiaries($district, 6);
        $tehsils = $this->locationService->getTehsilsByDistrict($district);

        return view('officer.dashboard', compact('summary', 'tehsilBreakdown', 'recentBeneficiaries', 'district', 'tehsils'));
    }

    /**
     * Display list of forms submitted strictly in the officer's district.
     */
    public function beneficiaries(Request $request): View
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $district = $user->district;

        $filters = [
            'search' => $request->query('search'),
            'tehsil' => $request->query('tehsil'),
            'vulnerability' => $request->query('vulnerability'),
        ];

        $beneficiaries = $this->officerService->getDistrictBeneficiaries($district, 15, $filters);
        $tehsils = $this->locationService->getTehsilsByDistrict($district);
        $summary = $this->officerService->getDistrictDashboardMetrics($district);

        return view('officer.beneficiaries', compact('beneficiaries', 'district', 'tehsils', 'filters', 'summary'));
    }
}
