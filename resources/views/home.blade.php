@extends('layouts.app')

@section('title', 'Backyard Poultry Beneficiary Management System (BPBMS)')

@section('content')
<div class="space-y-12 pb-16">

    <!-- Hero Section -->
    <section class="relative hero-gradient text-white overflow-hidden py-16 lg:py-24 shadow-xl">
        <!-- Background decorative ambient circles -->
        <div class="absolute -right-20 -bottom-20 w-96 h-96 rounded-full bg-emerald-400/10 blur-3xl pointer-events-none"></div>
        <div class="absolute left-1/3 -top-24 w-80 h-80 rounded-full bg-amber-400/10 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                
                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-emerald-200 text-xs font-semibold">
                        <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                        <span>Government of Khyber Pakhtunkhwa • Special Initiative</span>
                    </div>

                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight text-white">
                        Backyard Poultry Beneficiary Management System
                        <span class="block text-amber-300 font-bold mt-1 text-2xl sm:text-3xl lg:text-4xl">(BPBMS)</span>
                    </h1>

                    <p class="text-slate-100 text-base sm:text-lg leading-relaxed max-w-2xl font-normal opacity-95">
                        A dedicated digital management portal designed for the transparent registration, verification, and allocation of subsidized backyard poultry units. Exclusively targeted for <span class="font-bold underline text-amber-300">deserving rural women</span> across all tehsils of Khyber Pakhtunkhwa.
                    </p>

                    <!-- Key Entitlement Highlight Box -->
                    <div class="bg-black/25 backdrop-blur-md rounded-2xl p-4 sm:p-5 border border-white/15 max-w-xl">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-amber-400 text-slate-900 flex items-center justify-center font-black text-xl shrink-0 shadow-lg">
                                12
                            </div>
                            <div>
                                <h2 class="text-white font-bold text-sm sm:text-base">Standard Household Entitlement</h2>
                                <p class="text-emerald-100 text-xs sm:text-sm mt-0.5">
                                    <span class="font-semibold text-amber-300">One Unit (12 Birds)</span> given to one deserving family with priority for female-headed, widows, homeless, and extreme poor households.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Action Buttons -->
                    <div class="flex flex-wrap items-center gap-4 pt-2">
                        <a href="{{ route('beneficiaries.create') }}" 
                           id="hero-register-btn"
                           class="inline-flex items-center justify-center gap-2.5 px-6 py-3.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-bold text-sm sm:text-base shadow-lg shadow-amber-500/30 hover:scale-[1.02] transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            <span>Register Beneficiary Now</span>
                        </a>

                        <a href="{{ route('beneficiaries.index') }}" 
                           id="hero-view-roster-btn"
                           class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-sm sm:text-base border border-white/20 backdrop-blur-md transition-all duration-200">
                            <svg class="w-5 h-5 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <span>View Beneficiary Roster</span>
                        </a>
                    </div>

                </div>

                <!-- Right Side Quick Card / Program Badge -->
                <div class="lg:col-span-5">
                    <div class="glass-panel text-slate-900 rounded-3xl p-6 sm:p-8 shadow-2xl relative border-white/40">
                        <div class="flex items-center justify-between pb-5 border-b border-slate-100">
                            <div>
                                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Program Guidelines</span>
                                <h2 class="text-lg font-bold text-slate-900">Female Beneficiary Criteria</h2>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                100% Female
                            </span>
                        </div>

                        <div class="mt-5 space-y-4 text-xs sm:text-sm">
                            <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100">
                                <div class="w-6 h-6 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 font-bold mt-0.5">✓</div>
                                <div>
                                    <span class="font-bold text-slate-900">Mandatory Female Beneficiary:</span>
                                    <p class="text-slate-600 mt-0.5">Must be an adult female with valid CNIC issued in Khyber Pakhtunkhwa.</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100">
                                <div class="w-6 h-6 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center shrink-0 font-bold mt-0.5">✓</div>
                                <div>
                                    <span class="font-bold text-slate-900">Priority Vulnerability Scoring:</span>
                                    <p class="text-slate-600 mt-0.5">Prioritized for <strong class="text-slate-900">Female Headed Households, Widows, Homeless, and Poor / Extreme Vulnerable</strong> families.</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100">
                                <div class="w-6 h-6 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center shrink-0 font-bold mt-0.5">✓</div>
                                <div>
                                    <span class="font-bold text-slate-900">Fixed Package Per Family:</span>
                                    <p class="text-slate-600 mt-0.5">Strictly 1 unit (12 vaccinated, point-of-lay birds) with nominal subsidized recovery fee.</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 pt-5 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                            <span>Coverage: All 35 KP Districts</span>
                            <span class="font-semibold text-emerald-700">NADRA CNIC Verification</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Impact & Statistics Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-20">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            
            <!-- Stat 1 -->
            <div class="bg-white rounded-2xl p-5 sm:p-6 subtle-shadow border border-slate-100 card-hover">
                <div class="flex items-center justify-between text-slate-500 mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Beneficiaries</span>
                    <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-2xl sm:text-3xl font-extrabold text-slate-900">
                    {{ number_format($stats['total_beneficiaries']) }}
                </div>
                <p class="text-xs text-emerald-600 font-semibold mt-1">100% Female Beneficiaries</p>
            </div>

            <!-- Stat 2 -->
            <div class="bg-white rounded-2xl p-5 sm:p-6 subtle-shadow border border-slate-100 card-hover">
                <div class="flex items-center justify-between text-slate-500 mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Units Distributed</span>
                    <div class="w-9 h-9 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-2xl sm:text-3xl font-extrabold text-slate-900">
                    {{ number_format($stats['total_units']) }}
                </div>
                <p class="text-xs text-slate-500 font-medium mt-1">1 Unit = 12 Birds / Family</p>
            </div>

            <!-- Stat 3 -->
            <div class="bg-white rounded-2xl p-5 sm:p-6 subtle-shadow border border-slate-100 card-hover">
                <div class="flex items-center justify-between text-slate-500 mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Poultry Birds</span>
                    <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-2xl sm:text-3xl font-extrabold text-slate-900">
                    {{ number_format($stats['total_birds']) }}
                </div>
                <p class="text-xs text-amber-600 font-semibold mt-1">Vaccinated & Laying Age</p>
            </div>

            <!-- Stat 4 -->
            <div class="bg-white rounded-2xl p-5 sm:p-6 subtle-shadow border border-slate-100 card-hover">
                <div class="flex items-center justify-between text-slate-500 mb-2">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400">Recovery Amount</span>
                    <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="text-2xl sm:text-3xl font-extrabold text-slate-900">
                    <span class="text-sm font-semibold text-slate-500">PKR</span> {{ number_format($stats['total_amount_received']) }}
                </div>
                <p class="text-xs text-indigo-600 font-semibold mt-1">Subsidized Beneficiary Share</p>
            </div>

        </div>
    </section>

    <!-- Vulnerability Categories Breakdown & Package Features -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Vulnerability Target Pillars -->
            <div class="lg:col-span-2 bg-white rounded-3xl p-6 sm:p-8 subtle-shadow border border-slate-100">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Inclusion & Targeting</span>
                        <h2 class="text-xl font-bold text-slate-900">Priority Vulnerability Criteria</h2>
                    </div>
                    <span class="text-xs text-slate-400">BPBMS Mandate</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Headed -->
                    <div class="p-4 rounded-2xl bg-gradient-to-br from-emerald-50 to-teal-50/50 border border-emerald-100 flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-emerald-600 text-white flex items-center justify-center font-bold shrink-0 shadow-sm">
                            H
                        </div>
                        <div>
                            <div class="flex items-center justify-between">
                                <h3 class="font-bold text-slate-900 text-sm">Female Headed</h3>
                                <span class="text-xs font-bold px-2 py-0.5 rounded-full bg-emerald-200 text-emerald-900">{{ $stats['female_headed_count'] }} recorded</span>
                            </div>
                            <p class="text-xs text-slate-600 mt-1">Women acting as primary breadwinners with minor dependents.</p>
                        </div>
                    </div>

                    <!-- Widow -->
                    <div class="p-4 rounded-2xl bg-gradient-to-br from-purple-50 to-pink-50/50 border border-purple-100 flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-purple-600 text-white flex items-center justify-center font-bold shrink-0 shadow-sm">
                            W
                        </div>
                        <div>
                            <div class="flex items-center justify-between">
                                <h3 class="font-bold text-slate-900 text-sm">Widows</h3>
                                <span class="text-xs font-bold px-2 py-0.5 rounded-full bg-purple-200 text-purple-900">{{ $stats['widow_count'] }} recorded</span>
                            </div>
                            <p class="text-xs text-slate-600 mt-1">Deserving widows requiring home-based sustainable poultry income.</p>
                        </div>
                    </div>

                    <!-- Homeless -->
                    <div class="p-4 rounded-2xl bg-gradient-to-br from-amber-50 to-orange-50/50 border border-amber-100 flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-amber-600 text-white flex items-center justify-center font-bold shrink-0 shadow-sm">
                            HL
                        </div>
                        <div>
                            <div class="flex items-center justify-between">
                                <h3 class="font-bold text-slate-900 text-sm">Homeless / Displaced</h3>
                                <span class="text-xs font-bold px-2 py-0.5 rounded-full bg-amber-200 text-amber-900">{{ $stats['homeless_count'] }} recorded</span>
                            </div>
                            <p class="text-xs text-slate-600 mt-1">Shelterless families in temporary rural quarters needing immediate sustenance.</p>
                        </div>
                    </div>

                    <!-- Poor -->
                    <div class="p-4 rounded-2xl bg-gradient-to-br from-rose-50 to-red-50/50 border border-rose-100 flex items-start gap-3.5">
                        <div class="w-10 h-10 rounded-xl bg-rose-600 text-white flex items-center justify-center font-bold shrink-0 shadow-sm">
                            P
                        </div>
                        <div>
                            <div class="flex items-center justify-between">
                                <h3 class="font-bold text-slate-900 text-sm">Ultra-Poor / Needy</h3>
                                <span class="text-xs font-bold px-2 py-0.5 rounded-full bg-rose-200 text-rose-900">{{ $stats['poor_count'] }} recorded</span>
                            </div>
                            <p class="text-xs text-slate-600 mt-1">Households categorized below poverty index needing food and protein security.</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 p-4 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-xs text-slate-600">
                        <strong class="text-slate-800">Registration Requirement:</strong> Every beneficiary is categorized with one or more of these criteria to ensure 100% targeted delivery.
                    </div>
                    <a href="{{ route('beneficiaries.create') }}" class="shrink-0 px-4 py-2 rounded-xl bg-emerald-700 text-white text-xs font-bold hover:bg-emerald-800 transition-colors">
                        Add New Application &rarr;
                    </a>
                </div>
            </div>

            <!-- Standard Unit Package Breakdown Card -->
            <div class="bg-gradient-to-b from-slate-900 to-slate-800 text-white rounded-3xl p-6 sm:p-8 shadow-xl flex flex-col justify-between">
                <div>
                    <div class="inline-block px-3 py-1 rounded-full bg-amber-400 text-slate-950 text-xs font-extrabold uppercase tracking-wider mb-4">
                        Unit Package Structure
                    </div>
                    <h2 class="text-2xl font-extrabold text-white">What is 1 Unit?</h2>
                    <p class="text-slate-300 text-xs sm:text-sm mt-2 leading-relaxed">
                        Each verified female beneficiary is issued exactly one standard poultry unit comprising:
                    </p>

                    <div class="mt-6 space-y-3">
                        <div class="flex items-center justify-between p-3 rounded-xl bg-white/10 border border-white/10">
                            <span class="text-sm font-semibold text-slate-200">Point-of-Lay Pullets (Hens)</span>
                            <span class="text-base font-bold text-amber-300">10 Birds</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl bg-white/10 border border-white/10">
                            <span class="text-sm font-semibold text-slate-200">Breeding Cockerels (Roosters)</span>
                            <span class="text-base font-bold text-amber-300">2 Birds</span>
                        </div>
                        <div class="flex items-center justify-between p-3 rounded-xl bg-emerald-500/20 border border-emerald-400/30">
                            <span class="text-sm font-bold text-emerald-200">Total Poultry Birds</span>
                            <span class="text-lg font-extrabold text-emerald-300">12 Birds</span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-700 text-xs text-slate-400">
                    <p class="flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                        Breeds: Fayoumi, Desi Cross, RIR
                    </p>
                    <p class="flex items-center gap-2 mt-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                        Vaccinated against ND, IBD & Fowl Pox
                    </p>
                </div>
            </div>

        </div>
    </section>

    <!-- Recent Beneficiary Registrations Table -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl p-6 sm:p-8 subtle-shadow border border-slate-100">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Live Registration Stream</span>
                    <h2 class="text-xl font-bold text-slate-900">Recently Registered Beneficiaries</h2>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('beneficiaries.index') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 transition-colors">
                        View Complete Directory &rarr;
                    </a>
                </div>
            </div>

            @if($recentBeneficiaries->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="text-xs uppercase bg-slate-50 text-slate-500 border-b border-slate-200">
                            <tr>
                                <th class="px-4 py-3.5 font-bold">App / Farm No</th>
                                <th class="px-4 py-3.5 font-bold">Beneficiary Name</th>
                                <th class="px-4 py-3.5 font-bold">Wife / Widow of</th>
                                <th class="px-4 py-3.5 font-bold">CNIC No</th>
                                <th class="px-4 py-3.5 font-bold">District / Tehsil</th>
                                <th class="px-4 py-3.5 font-bold">Vulnerability</th>
                                <th class="px-4 py-3.5 font-bold text-center">Unit Given</th>
                                <th class="px-4 py-3.5 font-bold text-right">Amount (PKR)</th>
                                <th class="px-4 py-3.5 font-bold text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($recentBeneficiaries as $b)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="px-4 py-3 font-semibold text-slate-900 font-mono text-xs">
                                        {{ $b->application_no }}
                                    </td>
                                    <td class="px-4 py-3 font-medium text-slate-900">
                                        {{ $b->beneficiary_name }}
                                        <span class="ml-1 text-[10px] font-bold px-1.5 py-0.5 rounded bg-pink-50 text-pink-700 border border-pink-200">F</span>
                                    </td>
                                    <td class="px-4 py-3 text-slate-600">{{ $b->wife_or_widow_of }}</td>
                                    <td class="px-4 py-3 font-mono text-xs text-slate-700">{{ $b->cnic_no }}</td>
                                    <td class="px-4 py-3 text-slate-700 font-medium">
                                        {{ $b->district }}
                                        <span class="block text-xs text-slate-400">{{ $b->tehsil }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-wrap gap-1">
                                            @foreach($b->vulnerability_labels as $label)
                                                <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 border border-slate-200">
                                                    {{ $label }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($b->one_unit_given)
                                            <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200">
                                                <span>✓</span> 1 Unit (12 Birds)
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-right font-bold text-slate-900">
                                        Rs. {{ number_format($b->amount_received_per_unit) }}
                                    </td>
                                    <td class="px-4 py-3 text-right">
                                        <a href="{{ route('beneficiaries.show', $b) }}" 
                                           class="inline-block px-3 py-1 rounded-lg bg-slate-100 hover:bg-emerald-50 text-slate-700 hover:text-emerald-700 font-bold text-xs border border-slate-200 transition-colors">
                                            View Slip
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12 px-4 rounded-2xl bg-slate-50 border border-dashed border-slate-200">
                    <div class="w-14 h-14 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center mx-auto mb-3">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900">No Beneficiaries Registered Yet</h3>
                    <p class="text-xs text-slate-500 max-w-sm mx-auto mt-1 mb-4">
                        Be the first to register an eligible rural female beneficiary under the Backyard Poultry scheme.
                    </p>
                    <a href="{{ route('beneficiaries.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Start First Registration</span>
                    </a>
                </div>
            @endif
        </div>
    </section>

</div>
@endsection
