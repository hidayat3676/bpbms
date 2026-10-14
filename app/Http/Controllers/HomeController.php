<?php

namespace App\Http\Controllers;

use App\Contracts\Services\BeneficiaryServiceInterface;
use App\Services\KpLocationService;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class HomeController
 *
 * Single Responsibility: Handling requests for the BPBMS Home Portal.
 */
class HomeController extends Controller
{
    public function __construct(
        protected BeneficiaryServiceInterface $beneficiaryService,
        protected KpLocationService $locationService
    ) {}

    /**
     * Display the BPBMS Home page.
     */
    public function index(): View
    {
        $stats = $this->beneficiaryService->getDashboardStats();
        $recentBeneficiaries = $this->beneficiaryService->getBeneficiaries(5);
        $districts = $this->locationService->getDistricts();

        return view('home', compact('stats', 'recentBeneficiaries', 'districts'));
    }
}
