<?php

namespace App\Http\Controllers;

use App\Contracts\Services\BeneficiaryServiceInterface;
use App\Http\Requests\StoreBeneficiaryRequest;
use App\Models\Beneficiary;
use App\Services\KpLocationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class BeneficiaryController
 *
 * Single Responsibility: Handling HTTP flows for Beneficiary operations.
 * Adheres to Dependency Inversion by injecting interfaces.
 */
class BeneficiaryController extends Controller
{
    public function __construct(
        protected BeneficiaryServiceInterface $beneficiaryService,
        protected KpLocationService $locationService
    ) {}

    /**
     * Display a listing of registered beneficiaries.
     */
    public function index(Request $request): View
    {
        $filters = [
            'search' => $request->query('search'),
            'district' => $request->query('district'),
            'tehsil' => $request->query('tehsil'),
            'vulnerability' => $request->query('vulnerability'),
        ];

        $beneficiaries = $this->beneficiaryService->getBeneficiaries(15, $filters);
        $districts = $this->locationService->getDistricts();
        $districtsWithTehsils = $this->locationService->getAllDistrictsWithTehsils();
        $stats = $this->beneficiaryService->getDashboardStats();

        return view('beneficiaries.index', compact('beneficiaries', 'districts', 'districtsWithTehsils', 'filters', 'stats'));
    }

    /**
     * Show the registration form for adding a new beneficiary.
     */
    public function create(): View
    {
        $nextApplicationNo = $this->beneficiaryService->generateNextApplicationNo();
        $districts = $this->locationService->getDistricts();
        $districtsWithTehsils = $this->locationService->getAllDistrictsWithTehsils();

        return view('beneficiaries.create', compact('nextApplicationNo', 'districts', 'districtsWithTehsils'));
    }

    /**
     * Store a newly created beneficiary in storage.
     */
    public function store(StoreBeneficiaryRequest $request): RedirectResponse
    {
        $beneficiary = $this->beneficiaryService->registerBeneficiary($request->validated());

        return redirect()
            ->route('beneficiaries.show', $beneficiary)
            ->with('success', "Beneficiary {$beneficiary->beneficiary_name} (App No: {$beneficiary->application_no}) successfully registered! One unit of 12 poultry birds has been allocated.");
    }

    /**
     * Display the specified beneficiary (Receipt / Verification Card).
     */
    public function show(Beneficiary $beneficiary): View
    {
        return view('beneficiaries.show', compact('beneficiary'));
    }

    /**
     * Display the 80mm thermal print slip for POS / field camp printers.
     */
    public function thermal(Beneficiary $beneficiary): View
    {
        return view('beneficiaries.thermal', compact('beneficiary'));
    }
}
