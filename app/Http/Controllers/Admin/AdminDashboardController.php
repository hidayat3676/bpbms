<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\Services\AdminServiceInterface;
use App\Contracts\Services\BeneficiaryServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDistrictOfficerRequest;
use App\Services\KpLocationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class AdminDashboardController
 *
 * Single Responsibility: Handling Central Admin Panel HTTP requests and metrics.
 */
class AdminDashboardController extends Controller
{
    public function __construct(
        protected AdminServiceInterface $adminService,
        protected BeneficiaryServiceInterface $beneficiaryService,
        protected KpLocationService $locationService
    ) {}

    /**
     * Display the Central Admin Dashboard with aggregate counts.
     */
    public function index(): View
    {
        $metrics = $this->adminService->getGlobalDashboardMetrics();
        $districtCounts = $this->adminService->getDistrictWiseCounts();
        $recentBeneficiaries = $this->beneficiaryService->getBeneficiaries(6);
        $officersCount = $this->adminService->listDistrictOfficers()->count();

        return view('admin.dashboard', compact('metrics', 'districtCounts', 'recentBeneficiaries', 'officersCount'));
    }

    /**
     * Display all submitted forms across all KP districts.
     */
    public function beneficiaries(Request $request): View
    {
        $filters = [
            'search' => $request->query('search'),
            'district' => $request->query('district'),
            'tehsil' => $request->query('tehsil'),
            'vulnerability' => $request->query('vulnerability'),
        ];

        $beneficiaries = $this->beneficiaryService->getBeneficiaries(20, $filters);
        $districts = $this->locationService->getDistricts();
        $metrics = $this->adminService->getGlobalDashboardMetrics();

        return view('admin.beneficiaries', compact('beneficiaries', 'districts', 'filters', 'metrics'));
    }

    /**
     * Display listing of District Officers.
     */
    public function officers(): View
    {
        $officers = $this->adminService->listDistrictOfficers();
        $districts = $this->locationService->getDistricts();

        return view('admin.officers.index', compact('officers', 'districts'));
    }

    /**
     * Show form to create a new District Officer.
     */
    public function createOfficer(): View
    {
        $districts = $this->locationService->getDistricts();

        return view('admin.officers.create', compact('districts'));
    }

    /**
     * Store newly created District Officer.
     */
    public function storeOfficer(StoreDistrictOfficerRequest $request): RedirectResponse
    {
        $officer = $this->adminService->createDistrictOfficer($request->validated());

        return redirect()
            ->route('admin.officers.index')
            ->with('success', "District Officer '{$officer->name}' successfully onboarded for District {$officer->district}!");
    }
}
