@extends('layouts.app')

@section('title', 'Central Admin Dashboard - BPBMS')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 space-y-8">

    <!-- Admin Panel Header Banner -->
    <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-emerald-950 text-white rounded-3xl p-6 sm:p-8 shadow-xl relative overflow-hidden">
        <div class="absolute -right-16 -top-16 w-64 h-64 bg-emerald-500/10 rounded-full blur-2xl"></div>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-emerald-300 text-xs font-semibold mb-3 border border-white/10">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Central Directorate Overview • Khyber Pakhtunkhwa</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                    BPBMS Central Executive Dashboard
                </h1>
                <p class="text-slate-300 text-xs sm:text-sm mt-1 max-w-2xl leading-relaxed">
                    Provincial command center for monitoring backyard poultry unit quotas, submitted female beneficiary forms, district officer accounts, and subsidized recoveries across KP.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.officers.create') }}" 
                   id="btn-admin-create-officer"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-bold text-xs sm:text-sm shadow-md transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    <span>+ Create District Officer</span>
                </a>

                <a href="{{ route('admin.beneficiaries') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-xs sm:text-sm border border-white/20 transition-all">
                    <span>View All Forms ({{ $metrics['total_beneficiaries'] }})</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Key Metrics Grid: Submitted Form Counts -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        
        <!-- Total Forms Submitted -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 subtle-shadow border border-slate-100 card-hover">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-1">
                Forms Submitted
            </span>
            <div class="text-2xl sm:text-3xl font-black text-slate-900">
                {{ number_format($metrics['total_beneficiaries']) }}
            </div>
            <span class="text-[11px] text-emerald-600 font-semibold mt-1 block">100% Female</span>
        </div>

        <!-- Units Distributed -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 subtle-shadow border border-slate-100 card-hover">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-1">
                Units Issued
            </span>
            <div class="text-2xl sm:text-3xl font-black text-emerald-700">
                {{ number_format($metrics['total_units']) }}
            </div>
            <span class="text-[11px] text-slate-500 font-medium mt-1 block">1 Unit = 12 Birds</span>
        </div>

        <!-- Total Poultry Birds -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 subtle-shadow border border-slate-100 card-hover">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-1">
                Total Birds
            </span>
            <div class="text-2xl sm:text-3xl font-black text-amber-600">
                {{ number_format($metrics['total_birds']) }}
            </div>
            <span class="text-[11px] text-slate-500 font-medium mt-1 block">Vaccinated</span>
        </div>

        <!-- Total Recovery Amount -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 subtle-shadow border border-slate-100 card-hover">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-1">
                Recovery (PKR)
            </span>
            <div class="text-xl sm:text-2xl font-black text-slate-900">
                Rs. {{ number_format($metrics['total_amount_received']) }}
            </div>
            <span class="text-[11px] text-indigo-600 font-semibold mt-1 block">Subsidized Share</span>
        </div>

        <!-- District Officers Count -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 subtle-shadow border border-slate-100 card-hover">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-1">
                District Officers
            </span>
            <div class="text-2xl sm:text-3xl font-black text-teal-700">
                {{ number_format($metrics['total_officers']) }}
            </div>
            <a href="{{ route('admin.officers.index') }}" class="text-[11px] text-teal-600 hover:underline font-semibold mt-1 block">
                Manage Officers &rarr;
            </a>
        </div>

        <!-- Districts Covered -->
        <div class="bg-white rounded-2xl p-4 sm:p-5 subtle-shadow border border-slate-100 card-hover">
            <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400 block mb-1">
                KP Districts
            </span>
            <div class="text-2xl sm:text-3xl font-black text-slate-900">
                {{ $metrics['districts_covered'] }} <span class="text-xs text-slate-400 font-normal">/ 35</span>
            </div>
            <span class="text-[11px] text-slate-500 font-medium mt-1 block">Coverage</span>
        </div>

    </div>

    <!-- Vulnerability Targeting Breakdown -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 subtle-shadow border border-slate-100">
        <div class="flex items-center justify-between mb-5">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Targeting Statistics</span>
                <h2 class="text-lg font-bold text-slate-900">Vulnerability Distribution Summary</h2>
            </div>
            <span class="text-xs text-slate-500">Provincial Counts</span>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            
            <div class="p-4 rounded-2xl bg-emerald-50/70 border border-emerald-100">
                <span class="text-xs text-emerald-800 font-bold block">Female Headed</span>
                <div class="text-2xl font-black text-emerald-950 mt-1">
                    {{ number_format($metrics['female_headed_count']) }}
                </div>
                <p class="text-[11px] text-emerald-700 mt-0.5">Primary breadwinner households</p>
            </div>

            <div class="p-4 rounded-2xl bg-purple-50/70 border border-purple-100">
                <span class="text-xs text-purple-800 font-bold block">Widows</span>
                <div class="text-2xl font-black text-purple-950 mt-1">
                    {{ number_format($metrics['widow_count']) }}
                </div>
                <p class="text-[11px] text-purple-700 mt-0.5">Deserving widow recipients</p>
            </div>

            <div class="p-4 rounded-2xl bg-amber-50/70 border border-amber-100">
                <span class="text-xs text-amber-800 font-bold block">Homeless / Shelterless</span>
                <div class="text-2xl font-black text-amber-950 mt-1">
                    {{ number_format($metrics['homeless_count']) }}
                </div>
                <p class="text-[11px] text-amber-700 mt-0.5">Displaced / shelterless families</p>
            </div>

            <div class="p-4 rounded-2xl bg-rose-50/70 border border-rose-100">
                <span class="text-xs text-rose-800 font-bold block">Ultra-Poor / Needy</span>
                <div class="text-2xl font-black text-rose-950 mt-1">
                    {{ number_format($metrics['poor_count']) }}
                </div>
                <p class="text-[11px] text-rose-700 mt-0.5">BISP index / destitute families</p>
            </div>

        </div>
    </div>

    <!-- District-wise Forms Submitted Summary Table -->
    <div class="bg-white rounded-3xl subtle-shadow border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Geographic Breakdown</span>
                <h2 class="text-lg font-bold text-slate-900">Forms Submitted by KP District</h2>
                <p class="text-xs text-slate-500 mt-0.5">Total counts, allocated units, and recoveries collected per district</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold px-3 py-1 rounded-full bg-slate-100 text-slate-700 border border-slate-200">
                    35 Administrative Districts
                </span>
            </div>
        </div>

        <div class="overflow-x-auto max-h-[500px]">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="text-xs uppercase bg-slate-50 text-slate-500 border-b border-slate-200 sticky top-0 z-10">
                    <tr>
                        <th class="px-5 py-3.5 font-bold">#</th>
                        <th class="px-5 py-3.5 font-bold">KP District</th>
                        <th class="px-5 py-3.5 font-bold text-center">Forms Submitted</th>
                        <th class="px-5 py-3.5 font-bold text-center">Units Issued (12 Birds)</th>
                        <th class="px-5 py-3.5 font-bold text-right">Recovery Collected</th>
                        <th class="px-5 py-3.5 font-bold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @php $idx = 1; @endphp
                    @foreach($districtCounts as $districtName => $d)
                        <tr class="hover:bg-slate-50 transition-colors {{ $d['forms_count'] > 0 ? 'bg-emerald-50/20' : '' }}">
                            <td class="px-5 py-3 text-xs text-slate-400 font-mono">{{ $idx++ }}</td>
                            <td class="px-5 py-3 font-bold text-slate-900">
                                {{ $districtName }}
                                @if($d['forms_count'] > 0)
                                    <span class="ml-2 inline-block w-2 h-2 rounded-full bg-emerald-500"></span>
                                @endif
                            </td>
                            <td class="px-5 py-3 text-center">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $d['forms_count'] > 0 ? 'bg-emerald-100 text-emerald-900 border border-emerald-200' : 'bg-slate-100 text-slate-500' }}">
                                    {{ $d['forms_count'] }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-center font-semibold {{ $d['units_count'] > 0 ? 'text-slate-900' : 'text-slate-400' }}">
                                {{ $d['units_count'] }} Units
                            </td>
                            <td class="px-5 py-3 text-right font-bold {{ $d['total_amount'] > 0 ? 'text-slate-900' : 'text-slate-400' }}">
                                Rs. {{ number_format($d['total_amount']) }}
                            </td>
                            <td class="px-5 py-3 text-right">
                                @if($d['forms_count'] > 0)
                                    <a href="{{ route('admin.beneficiaries', ['district' => $districtName]) }}" 
                                       class="inline-block px-3 py-1 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-800 text-xs font-bold border border-emerald-200 transition-colors">
                                        View Forms &rarr;
                                    </a>
                                @else
                                    <span class="text-xs text-slate-300">No submissions</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Recent Submissions Stream -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 subtle-shadow border border-slate-100">
        <div class="flex items-center justify-between mb-5">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Audit Trail</span>
                <h2 class="text-lg font-bold text-slate-900">Recent Applications Received</h2>
            </div>
            <a href="{{ route('admin.beneficiaries') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 transition-colors">
                View All Submitted Forms &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="text-xs uppercase bg-slate-50 text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3 font-bold">App / Farm No</th>
                        <th class="px-4 py-3 font-bold">Beneficiary Name</th>
                        <th class="px-4 py-3 font-bold">CNIC</th>
                        <th class="px-4 py-3 font-bold">District / Tehsil</th>
                        <th class="px-4 py-3 font-bold">Category</th>
                        <th class="px-4 py-3 font-bold text-right">Amount</th>
                        <th class="px-4 py-3 font-bold text-right">Slip</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($recentBeneficiaries as $b)
                        <tr class="hover:bg-slate-50">
                            <td class="px-4 py-3 font-mono text-xs font-bold text-slate-900">{{ $b->application_no }}</td>
                            <td class="px-4 py-3 font-medium text-slate-900">
                                {{ $b->beneficiary_name }}
                                <span class="ml-1 text-[10px] font-bold px-1.5 py-0.5 rounded bg-pink-100 text-pink-700">Female</span>
                            </td>
                            <td class="px-4 py-3 font-mono text-xs text-slate-700">{{ $b->cnic_no }}</td>
                            <td class="px-4 py-3 text-slate-800 font-semibold">
                                {{ $b->district }}
                                <span class="block text-xs font-normal text-slate-500">{{ $b->tehsil }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($b->vulnerability_labels as $l)
                                        <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 font-medium">
                                            {{ $l }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-4 py-3 text-right font-bold text-slate-900">
                                Rs. {{ number_format($b->amount_received_per_unit) }}
                            </td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('beneficiaries.show', $b) }}" class="px-3 py-1 rounded-lg bg-slate-100 hover:bg-emerald-50 text-slate-700 hover:text-emerald-700 font-bold text-xs border border-slate-200 transition-colors">
                                    Slip
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
