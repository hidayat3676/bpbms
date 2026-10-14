<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Officer\DistrictOfficerDashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Backyard Poultry Beneficiary Management System (BPBMS)
|--------------------------------------------------------------------------
*/

// Public Portal Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('beneficiaries')->name('beneficiaries.')->group(function () {
    Route::get('/', [BeneficiaryController::class, 'index'])->name('index');
    Route::get('/register', [BeneficiaryController::class, 'create'])->name('create');
    Route::post('/', [BeneficiaryController::class, 'store'])->name('store');
    Route::get('/{beneficiary}', [BeneficiaryController::class, 'show'])->name('show');
    Route::get('/{beneficiary}/thermal', [BeneficiaryController::class, 'thermal'])->name('thermal');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Central Admin Panel Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/beneficiaries', [AdminDashboardController::class, 'beneficiaries'])->name('beneficiaries');
    Route::get('/officers', [AdminDashboardController::class, 'officers'])->name('officers.index');
    Route::get('/officers/create', [AdminDashboardController::class, 'createOfficer'])->name('officers.create');
    Route::post('/officers', [AdminDashboardController::class, 'storeOfficer'])->name('officers.store');
});

// District Officer Panel Routes (strictly scoped to officer's assigned district)
Route::middleware(['auth', 'role:district_officer'])->prefix('officer')->name('officer.')->group(function () {
    Route::get('/dashboard', [DistrictOfficerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/beneficiaries', [DistrictOfficerDashboardController::class, 'beneficiaries'])->name('beneficiaries');
});
