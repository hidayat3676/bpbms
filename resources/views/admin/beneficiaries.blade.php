@extends('layouts.app')

@section('title', 'All Submitted Forms - BPBMS Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 space-y-8">

    <!-- Header breadcrumb & Title -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold text-slate-500 mb-1.5">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-700 transition-colors">Admin Dashboard</a>
                <span>/</span>
                <span class="text-emerald-700">Submitted Forms</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                All Provincial Submitted Forms ({{ $beneficiaries->total() }})
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Central register of verified female beneficiary applications from all 35 Khyber Pakhtunkhwa districts.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 text-xs font-bold hover:bg-slate-50 transition-colors">
                &larr; Admin Dashboard
            </a>
            <a href="{{ route('beneficiaries.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs shadow-xs transition-colors">
                + New Registration
            </a>
        </div>
    </div>

    <!-- Filter Toolbar -->
    <div class="bg-white rounded-3xl p-6 subtle-shadow border border-slate-100">
        <form action="{{ route('admin.beneficiaries') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            
            <div class="lg:col-span-2">
                <label for="search" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Search Keyword</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Search by Name, CNIC, App No..." class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm text-slate-900 shadow-xs outline-none">
            </div>

            <div>
                <label for="district" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">KP District</label>
                <select name="district" id="district" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-emerald-600 text-sm text-slate-900 bg-white">
                    <option value="">All KP Districts</option>
                    @foreach($districts as $d)
                        <option value="{{ $d }}" {{ request('district') == $d ? 'selected' : '' }}>{{ $d }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="vulnerability" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-1.5">Vulnerability Category</label>
                <select name="vulnerability" id="vulnerability" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-emerald-600 text-sm text-slate-900 bg-white">
                    <option value="">All Categories</option>
                    <option value="headed" {{ request('vulnerability') == 'headed' ? 'selected' : '' }}>Female-Headed</option>
                    <option value="widow" {{ request('vulnerability') == 'widow' ? 'selected' : '' }}>Widow</option>
                    <option value="homeless" {{ request('vulnerability') == 'homeless' ? 'selected' : '' }}>Homeless</option>
                    <option value="poor" {{ request('vulnerability') == 'poor' ? 'selected' : '' }}>Ultra-Poor</option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 py-2.5 px-4 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-xs">
                    Apply Filter
                </button>
                @if(request()->hasAny(['search', 'district', 'vulnerability']))
                    <a href="{{ route('admin.beneficiaries') }}" class="py-2.5 px-3 rounded-xl border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-100">
                        Reset
                    </a>
                @endif
            </div>

        </form>
    </div>

    <!-- Table of Forms -->
    <div class="bg-white rounded-3xl subtle-shadow border border-slate-100 overflow-hidden">
        @if($beneficiaries->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="text-xs uppercase bg-slate-50 text-slate-500 border-b border-slate-200">
                        <tr>
                            <th class="px-5 py-3.5 font-bold">App / Farm No</th>
                            <th class="px-5 py-3.5 font-bold">Beneficiary Name</th>
                            <th class="px-5 py-3.5 font-bold">Wife / Widow of</th>
                            <th class="px-5 py-3.5 font-bold">CNIC</th>
                            <th class="px-5 py-3.5 font-bold">District / Tehsil</th>
                            <th class="px-5 py-3.5 font-bold">Village</th>
                            <th class="px-5 py-3.5 font-bold">Category</th>
                            <th class="px-5 py-3.5 font-bold text-center">Unit</th>
                            <th class="px-5 py-3.5 font-bold text-right">Recovery</th>
                            <th class="px-5 py-3.5 font-bold text-right">Slip</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($beneficiaries as $b)
                            <tr class="hover:bg-slate-50">
                                <td class="px-5 py-3.5 font-mono text-xs font-bold text-slate-900">{{ $b->application_no }}</td>
                                <td class="px-5 py-3.5 font-semibold text-slate-900">
                                    {{ $b->beneficiary_name }}
                                    <span class="ml-1 text-[10px] font-bold px-1.5 py-0.5 rounded bg-pink-100 text-pink-700">F</span>
                                </td>
                                <td class="px-5 py-3.5 text-slate-700">{{ $b->wife_or_widow_of }}</td>
                                <td class="px-5 py-3.5 font-mono text-xs text-slate-700">{{ $b->cnic_no }}</td>
                                <td class="px-5 py-3.5 font-medium text-slate-800">
                                    {{ $b->district }}
                                    <span class="block text-xs text-slate-400 font-normal">{{ $b->tehsil }}</span>
                                </td>
                                <td class="px-5 py-3.5 text-xs text-slate-600">{{ $b->village }}</td>
                                <td class="px-5 py-3.5">
                                    <div class="flex flex-wrap gap-1 max-w-[170px]">
                                        @foreach($b->vulnerability_labels as $l)
                                            <span class="text-[10px] px-2 py-0.5 rounded-full bg-slate-100 text-slate-700 font-medium">
                                                {{ $l }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-5 py-3.5 text-center">
                                    <span class="text-xs font-bold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200">
                                        ✓ 12 Birds
                                    </span>
                                </td>
                                <td class="px-5 py-3.5 text-right font-bold text-slate-900">
                                    Rs. {{ number_format($b->amount_received_per_unit) }}
                                </td>
                                <td class="px-5 py-3.5 text-right">
                                    <a href="{{ route('beneficiaries.show', $b) }}" class="px-3 py-1.5 rounded-lg bg-emerald-50 hover:bg-emerald-100 text-emerald-800 font-bold text-xs border border-emerald-200 transition-colors">
                                        View Slip
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-4 border-t border-slate-100">
                {{ $beneficiaries->links() }}
            </div>
        @else
            <div class="text-center py-16 px-4">
                <p class="text-sm font-bold text-slate-700">No submitted forms matching current filter.</p>
                <a href="{{ route('admin.beneficiaries') }}" class="text-xs text-emerald-700 font-bold hover:underline mt-2 inline-block">
                    Clear all filters
                </a>
            </div>
        @endif
    </div>

</div>
@endsection
