@extends('layouts.app')

@section('title', 'Beneficiary Directory & Roster - BPBMS')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 space-y-8">

    <!-- Header breadcrumb & Title -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold text-slate-500 mb-1.5">
                <a href="{{ route('home') }}" class="hover:text-emerald-700 transition-colors">Home</a>
                <span>/</span>
                <span class="text-emerald-700">Beneficiaries Roster</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                KP Backyard Poultry Beneficiaries Directory
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Official register of verified rural female beneficiaries receiving 1 unit (12 birds).
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('beneficiaries.create') }}" 
               id="btn-register-new"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-xs sm:text-sm shadow-md shadow-emerald-700/20 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Register New Beneficiary</span>
            </a>
        </div>
    </div>

    <!-- Filter & Search Toolbar -->
    <div class="bg-white rounded-3xl p-6 subtle-shadow border border-slate-100">
        <form action="{{ route('beneficiaries.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            
            <!-- Search Keyword -->
            <div class="lg:col-span-2">
                <label for="filter-search" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                    Search Keyword
                </label>
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           id="filter-search" 
                           value="{{ request('search') }}"
                           placeholder="Search by Name, CNIC, App No, or Village..."
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm text-slate-900 shadow-xs outline-none transition-all">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- District Filter -->
            <div>
                <label for="filter-district" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                    KP District
                </label>
                <select name="district" 
                        id="filter-district" 
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm text-slate-900 shadow-xs outline-none bg-white transition-all cursor-pointer">
                    <option value="">All KP Districts</option>
                    @foreach($districts as $d)
                        <option value="{{ $d }}" {{ request('district') == $d ? 'selected' : '' }}>{{ $d }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Vulnerability Filter -->
            <div>
                <label for="filter-vuln" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">
                    Vulnerability Category
                </label>
                <select name="vulnerability" 
                        id="filter-vuln" 
                        class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm text-slate-900 shadow-xs outline-none bg-white transition-all cursor-pointer">
                    <option value="">All Categories</option>
                    <option value="headed" {{ request('vulnerability') == 'headed' ? 'selected' : '' }}>Female-Headed</option>
                    <option value="widow" {{ request('vulnerability') == 'widow' ? 'selected' : '' }}>Widow</option>
                    <option value="homeless" {{ request('vulnerability') == 'homeless' ? 'selected' : '' }}>Homeless</option>
                    <option value="poor" {{ request('vulnerability') == 'poor' ? 'selected' : '' }}>Ultra-Poor</option>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-end gap-2">
                <button type="submit" 
                        id="filter-submit-btn"
                        class="flex-1 px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-xs transition-colors">
                    Apply Filter
                </button>
                @if(request()->hasAny(['search', 'district', 'vulnerability']))
                    <a href="{{ route('beneficiaries.index') }}" class="px-3 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-100 text-slate-600 text-xs font-bold transition-colors">
                        Clear
                    </a>
                @endif
            </div>

        </form>
    </div>

    <!-- Beneficiaries Table -->
    <div class="bg-white rounded-3xl subtle-shadow border border-slate-100 overflow-hidden">
        
        <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
            <div>
                <h2 class="text-base font-bold text-slate-900">Registered Beneficiaries List</h2>
                <p class="text-xs text-slate-500">Showing verified records in database</p>
            </div>
            <span class="text-xs font-bold px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 self-start sm:self-auto">
                Total Found: {{ $beneficiaries->total() }}
            </span>
        </div>

        @if($beneficiaries->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="text-xs uppercase bg-slate-50 text-slate-500 border-b border-slate-200">
                        <tr>
                            <th class="px-5 py-3.5 font-bold">App / Farm No</th>
                            <th class="px-5 py-3.5 font-bold">Beneficiary Name</th>
                            <th class="px-5 py-3.5 font-bold">Wife / Widow of</th>
                            <th class="px-5 py-3.5 font-bold">CNIC No</th>
                            <th class="px-5 py-3.5 font-bold">District / Tehsil</th>
                            <th class="px-5 py-3.5 font-bold">Village</th>
                            <th class="px-5 py-3.5 font-bold">Contact No</th>
                            <th class="px-5 py-3.5 font-bold">Category</th>
                            <th class="px-5 py-3.5 font-bold text-center">Unit (12 Birds)</th>
                            <th class="px-5 py-3.5 font-bold text-right">Amount (PKR)</th>
                            <th class="px-5 py-3.5 font-bold text-right">Receipt</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($beneficiaries as $b)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="px-5 py-4 font-mono text-xs font-bold text-slate-900">
                                    {{ $b->application_no }}
                                </td>
                                <td class="px-5 py-4 font-semibold text-slate-900">
                                    {{ $b->beneficiary_name }}
                                    <span class="ml-1 text-[10px] font-bold px-1.5 py-0.5 rounded bg-pink-100 text-pink-700 border border-pink-200">F</span>
                                </td>
                                <td class="px-5 py-4 text-slate-700">
                                    {{ $b->wife_or_widow_of }}
                                </td>
                                <td class="px-5 py-4 font-mono text-xs text-slate-700 whitespace-nowrap">
                                    {{ $b->cnic_no }}
                                </td>
                                <td class="px-5 py-4 text-slate-700">
                                    <span class="font-semibold text-slate-900">{{ $b->district }}</span>
                                    <span class="block text-xs text-slate-400">{{ $b->tehsil }}</span>
                                </td>
                                <td class="px-5 py-4 text-slate-700 text-xs">
                                    {{ $b->village }}
                                </td>
                                <td class="px-5 py-4 font-mono text-xs text-slate-600 whitespace-nowrap">
                                    {{ $b->contact_no }}
                                </td>
                                <td class="px-5 py-4">
                                    <div class="flex flex-wrap gap-1 max-w-[180px]">
                                        @foreach($b->vulnerability_labels as $label)
                                            <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 border border-slate-200 whitespace-nowrap">
                                                {{ $label }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    @if($b->one_unit_given)
                                        <span class="inline-flex items-center gap-1 text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 border border-emerald-200">
                                            <span>✓</span> 1 Unit
                                        </span>
                                    @else
                                        <span class="text-xs text-slate-400">—</span>
                                    @endif
                                </td>
                                <td class="px-5 py-4 text-right font-bold text-slate-900 whitespace-nowrap">
                                    Rs. {{ number_format($b->amount_received_per_unit) }}
                                </td>
                                <td class="px-5 py-4 text-right">
                                    <a href="{{ route('beneficiaries.show', $b) }}" 
                                       class="inline-block px-3 py-1.5 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-bold text-xs border border-emerald-200 transition-colors whitespace-nowrap">
                                        View Slip
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Bar -->
            <div class="p-4 border-t border-slate-100">
                {{ $beneficiaries->links() }}
            </div>

        @else
            <div class="text-center py-16 px-4">
                <div class="w-16 h-16 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-base font-bold text-slate-900">No Matching Beneficiary Records</h3>
                <p class="text-xs text-slate-500 max-w-sm mx-auto mt-1 mb-4">
                    Try adjusting your search criteria or register a new beneficiary using the application form.
                </p>
                <a href="{{ route('beneficiaries.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs shadow-md transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Register New Beneficiary</span>
                </a>
            </div>
        @endif

    </div>

</div>
@endsection
