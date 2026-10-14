@extends('layouts.app')

@section('title', 'District Officer Dashboard (' . $district . ') - BPBMS')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 space-y-8">

    <!-- District Officer Header Banner -->
    <div class="bg-gradient-to-r from-emerald-900 via-teal-900 to-slate-900 text-white rounded-3xl p-6 sm:p-8 shadow-xl relative overflow-hidden">
        <div class="absolute -right-16 -top-16 w-64 h-64 bg-emerald-400/10 rounded-full blur-2xl"></div>

        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-emerald-300 text-xs font-semibold mb-3 border border-white/10">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>District Livestock Officer (DLO) Command • {{ $district }}</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white">
                    {{ $district }} District BPBMS Panel
                </h1>
                <p class="text-emerald-100 text-xs sm:text-sm mt-1 max-w-2xl leading-relaxed">
                    Local monitoring dashboard for submitted female beneficiary applications, tehsil quotas, and 12-birds poultry unit distribution across <strong class="text-white">{{ $district }}</strong>.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('beneficiaries.create', ['district' => $district]) }}" 
                   id="btn-officer-enroll"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-amber-400 hover:bg-amber-300 text-slate-950 font-bold text-xs sm:text-sm shadow-md transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>+ Enroll Beneficiary in {{ $district }}</span>
                </a>

                <a href="{{ route('officer.beneficiaries') }}" 
                   class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold text-xs sm:text-sm border border-white/20 transition-all">
                    <span>View District Forms ({{ $summary['total_beneficiaries'] }})</span>
                </a>
            </div>
        </div>
    </div>

    <!-- District Metrics Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
        
        <!-- Forms Submitted in District -->
        <div class="bg-white rounded-2xl p-5 sm:p-6 subtle-shadow border border-slate-100 card-hover">
            <div class="flex items-center justify-between text-slate-400 mb-1.5">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Forms Submitted</span>
                <span class="text-xs font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">
                    {{ $district }}
                </span>
            </div>
            <div class="text-3xl font-black text-slate-900 mt-1">
                {{ number_format($summary['total_beneficiaries']) }}
            </div>
            <p class="text-xs text-emerald-600 font-semibold mt-1">Verified Female Applicants</p>
        </div>

        <!-- Units Distributed -->
        <div class="bg-white rounded-2xl p-5 sm:p-6 subtle-shadow border border-slate-100 card-hover">
            <div class="flex items-center justify-between text-slate-400 mb-1.5">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Units Issued</span>
                <span class="text-xs font-bold px-2 py-0.5 rounded-full bg-teal-100 text-teal-800">12 Birds/Unit</span>
            </div>
            <div class="text-3xl font-black text-teal-700 mt-1">
                {{ number_format($summary['total_units']) }}
            </div>
            <p class="text-xs text-slate-500 font-medium mt-1">One Unit / Family Entitlement</p>
        </div>

        <!-- Total Poultry Birds in District -->
        <div class="bg-white rounded-2xl p-5 sm:p-6 subtle-shadow border border-slate-100 card-hover">
            <div class="flex items-center justify-between text-slate-400 mb-1.5">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Poultry Birds</span>
                <span class="text-xs font-bold px-2 py-0.5 rounded-full bg-amber-100 text-amber-800">Vaccinated</span>
            </div>
            <div class="text-3xl font-black text-amber-600 mt-1">
                {{ number_format($summary['total_birds']) }}
            </div>
            <p class="text-xs text-amber-700 font-medium mt-1">10 Hens + 2 Roosters / Unit</p>
        </div>

        <!-- Total Subsidized Recovery in District -->
        <div class="bg-white rounded-2xl p-5 sm:p-6 subtle-shadow border border-slate-100 card-hover">
            <div class="flex items-center justify-between text-slate-400 mb-1.5">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Total Recovery</span>
                <span class="text-xs font-bold px-2 py-0.5 rounded-full bg-indigo-100 text-indigo-800">PKR</span>
            </div>
            <div class="text-2xl sm:text-3xl font-black text-slate-900 mt-1">
                Rs. {{ number_format($summary['total_amount_received']) }}
            </div>
            <p class="text-xs text-indigo-600 font-semibold mt-1">Beneficiary Share Deposited</p>
        </div>

    </div>

    <!-- Tehsil Breakdown Table & District Vulnerability Card -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Tehsil Breakdown Table (8 cols) -->
        <div class="lg:col-span-8 bg-white rounded-3xl subtle-shadow border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Sub-District Distribution</span>
                    <h2 class="text-lg font-bold text-slate-900">Tehsil-wise Summary in {{ $district }}</h2>
                    <p class="text-xs text-slate-500 mt-0.5">Allocation and submission status across tehsils of {{ $district }}</p>
                </div>
                <span class="text-xs font-bold px-3 py-1 rounded-full bg-slate-100 text-slate-700">
                    {{ count($tehsilBreakdown) }} Tehsils
                </span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="text-xs uppercase bg-slate-50 text-slate-500 border-b border-slate-200">
                        <tr>
                            <th class="px-5 py-3.5 font-bold">Tehsil Name</th>
                            <th class="px-5 py-3.5 font-bold text-center">Forms Submitted</th>
                            <th class="px-5 py-3.5 font-bold text-center">Units (12 Birds)</th>
                            <th class="px-5 py-3.5 font-bold text-right">Recovery (PKR)</th>
                            <th class="px-5 py-3.5 font-bold text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($tehsilBreakdown as $tehsilName => $t)
                            <tr class="hover:bg-slate-50 transition-colors {{ $t['forms_count'] > 0 ? 'bg-emerald-50/20' : '' }}">
                                <td class="px-5 py-3.5 font-bold text-slate-900">
                                    {{ $tehsilName }}
                                    @if($t['forms_count'] > 0)
                                        <span class="ml-2 inline-block w-2 h-2 rounded-full bg-emerald-500"></span>
                                    @endif
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold {{ $t['forms_count'] > 0 ? 'bg-emerald-100 text-emerald-900 border border-emerald-200' : 'bg-slate-100 text-slate-500' }}">
                                        {{ $t['forms_count'] }}
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-center font-semibold text-slate-800">
                                    {{ $t['units_count'] }} Units
                                </td>
                                <td class="px-5 py-3.5 text-right font-bold text-slate-900">
                                    Rs. {{ number_format($t['total_amount']) }}
                                </td>
                                <td class="px-5 py-3.5 text-right">
                                    @if($t['forms_count'] > 0)
                                        <a href="{{ route('officer.beneficiaries', ['tehsil' => $tehsilName]) }}" 
                                           class="inline-block px-3 py-1 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-800 text-xs font-bold border border-emerald-200 transition-colors">
                                            View &rarr;
                                        </a>
                                    @else
                                        <span class="text-xs text-slate-300">—</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- District Vulnerability Summary Card (4 cols) -->
        <div class="lg:col-span-4 bg-white rounded-3xl p-6 subtle-shadow border border-slate-100 space-y-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">{{ $district }} Targeting</span>
                <h3 class="text-base font-bold text-slate-900">Vulnerability Metrics</h3>
                <p class="text-xs text-slate-500 mt-0.5">Categorization of submitted forms in {{ $district }}</p>
            </div>

            <div class="space-y-3 pt-2">
                <div class="p-3.5 rounded-2xl bg-emerald-50/70 border border-emerald-100 flex items-center justify-between">
                    <div>
                        <span class="block text-xs font-bold text-slate-900">Female-Headed</span>
                        <span class="text-[11px] text-emerald-700">Sole earning women</span>
                    </div>
                    <span class="text-lg font-black text-emerald-950">{{ $summary['female_headed_count'] }}</span>
                </div>

                <div class="p-3.5 rounded-2xl bg-purple-50/70 border border-purple-100 flex items-center justify-between">
                    <div>
                        <span class="block text-xs font-bold text-slate-900">Widows</span>
                        <span class="text-[11px] text-purple-700">Widowed applicants</span>
                    </div>
                    <span class="text-lg font-black text-purple-950">{{ $summary['widow_count'] }}</span>
                </div>

                <div class="p-3.5 rounded-2xl bg-amber-50/70 border border-amber-100 flex items-center justify-between">
                    <div>
                        <span class="block text-xs font-bold text-slate-900">Homeless</span>
                        <span class="text-[11px] text-amber-700">Shelterless families</span>
                    </div>
                    <span class="text-lg font-black text-amber-950">{{ $summary['homeless_count'] }}</span>
                </div>

                <div class="p-3.5 rounded-2xl bg-rose-50/70 border border-rose-100 flex items-center justify-between">
                    <div>
                        <span class="block text-xs font-bold text-slate-900">Ultra-Poor</span>
                        <span class="text-[11px] text-rose-700">Needy / Destitute</span>
                    </div>
                    <span class="text-lg font-black text-rose-950">{{ $summary['poor_count'] }}</span>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100">
                <a href="{{ route('officer.beneficiaries') }}" class="w-full block text-center py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-xs transition-colors">
                    Manage All {{ $district }} Forms &rarr;
                </a>
            </div>
        </div>

    </div>

    <!-- Recent Submissions in District -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 subtle-shadow border border-slate-100">
        <div class="flex items-center justify-between mb-5">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-700">Submissions in {{ $district }}</span>
                <h2 class="text-lg font-bold text-slate-900">Recent Applications Received</h2>
            </div>
            <a href="{{ route('officer.beneficiaries') }}" class="text-xs font-bold text-emerald-700 hover:text-emerald-900 transition-colors">
                View Full District Roster &rarr;
            </a>
        </div>

        @if($recentBeneficiaries->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="text-xs uppercase bg-slate-50 text-slate-500 border-b border-slate-200">
                        <tr>
                            <th class="px-4 py-3 font-bold">App / Farm No</th>
                            <th class="px-4 py-3 font-bold">Beneficiary Name</th>
                            <th class="px-4 py-3 font-bold">Wife / Widow of</th>
                            <th class="px-4 py-3 font-bold">CNIC</th>
                            <th class="px-4 py-3 font-bold">Tehsil</th>
                            <th class="px-4 py-3 font-bold">Village</th>
                            <th class="px-4 py-3 font-bold text-right">Recovery</th>
                            <th class="px-4 py-3 font-bold text-right">Slip</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($recentBeneficiaries as $b)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 font-mono text-xs font-bold text-slate-900">{{ $b->application_no }}</td>
                                <td class="px-4 py-3 font-medium text-slate-900">
                                    {{ $b->beneficiary_name }}
                                    <span class="ml-1 text-[10px] font-bold px-1.5 py-0.5 rounded bg-pink-100 text-pink-700">F</span>
                                </td>
                                <td class="px-4 py-3 text-slate-700">{{ $b->wife_or_widow_of }}</td>
                                <td class="px-4 py-3 font-mono text-xs text-slate-700">{{ $b->cnic_no }}</td>
                                <td class="px-4 py-3 font-semibold text-slate-800">{{ $b->tehsil }}</td>
                                <td class="px-4 py-3 text-xs text-slate-600">{{ $b->village }}</td>
                                <td class="px-4 py-3 text-right font-bold text-slate-900">
                                    Rs. {{ number_format($b->amount_received_per_unit) }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <a href="{{ route('beneficiaries.show', $b) }}" class="px-3 py-1 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-800 font-bold text-xs border border-emerald-200 transition-colors">
                                        View Slip
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-10 px-4 rounded-2xl bg-slate-50 border border-dashed border-slate-200">
                <p class="text-sm font-bold text-slate-700">No applications registered in {{ $district }} yet.</p>
                <a href="{{ route('beneficiaries.create', ['district' => $district]) }}" class="inline-block mt-3 px-4 py-2 rounded-xl bg-emerald-700 text-white font-bold text-xs shadow-xs">
                    + Register First Beneficiary in {{ $district }}
                </a>
            </div>
        @endif
    </div>

</div>
@endsection
