<?php

namespace App\Providers;

use App\Contracts\Repositories\BeneficiaryRepositoryInterface;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\AdminServiceInterface;
use App\Contracts\Services\BeneficiaryServiceInterface;
use App\Contracts\Services\DistrictOfficerServiceInterface;
use App\Repositories\BeneficiaryRepository;
use App\Repositories\UserRepository;
use App\Services\AdminService;
use App\Services\BeneficiaryService;
use App\Services\DistrictOfficerService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BeneficiaryRepositoryInterface::class, BeneficiaryRepository::class);
        $this->app->bind(BeneficiaryServiceInterface::class, BeneficiaryService::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AdminServiceInterface::class, AdminService::class);
        $this->app->bind(DistrictOfficerServiceInterface::class, DistrictOfficerService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
