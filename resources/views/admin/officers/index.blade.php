@extends('layouts.app')

@section('title', 'District Officers Management - BPBMS Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 space-y-8">

    <!-- Header & Action -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold text-slate-500 mb-1.5">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-700 transition-colors">Admin Dashboard</a>
                <span>/</span>
                <span class="text-emerald-700">District Officers</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                Khyber Pakhtunkhwa District Officers
            </h1>
            <p class="text-sm text-slate-500 mt-1">
                Authorized District Livestock Officers (DLO) managing backyard poultry distribution in their respective districts.
            </p>
        </div>

        <a href="{{ route('admin.officers.create') }}" 
           id="btn-create-officer"
           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-gradient-to-r from-emerald-700 to-teal-700 hover:from-emerald-800 hover:to-teal-800 text-white font-bold text-xs sm:text-sm shadow-md transition-all self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
            </svg>
            <span>Create District Officer User</span>
        </a>
    </div>

    <!-- Officers Roster Table -->
    <div class="bg-white rounded-3xl subtle-shadow border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900">Registered District Officers ({{ $officers->count() }})</h2>
                <p class="text-xs text-slate-500">Each officer is assigned to a designated KP district</p>
            </div>
            <span class="text-xs font-bold px-3 py-1 rounded-full bg-teal-50 text-teal-800 border border-teal-200">
                Active Officers
            </span>
        </div>

        @if($officers->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600">
                    <thead class="text-xs uppercase bg-slate-50 text-slate-500 border-b border-slate-200">
                        <tr>
                            <th class="px-5 py-3.5 font-bold">Officer Name</th>
                            <th class="px-5 py-3.5 font-bold">Official Email</th>
                            <th class="px-5 py-3.5 font-bold">Assigned KP District</th>
                            <th class="px-5 py-3.5 font-bold">Designation</th>
                            <th class="px-5 py-3.5 font-bold">Contact Phone</th>
                            <th class="px-5 py-3.5 font-bold">Status</th>
                            <th class="px-5 py-3.5 font-bold text-right">Registered On</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($officers as $officer)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-5 py-4 font-bold text-slate-900">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-800 font-bold flex items-center justify-center text-xs">
                                            {{ substr($officer->name, 0, 1) }}
                                        </div>
                                        <span>{{ $officer->name }}</span>
                                    </div>
                                </td>
                                <td class="px-5 py-4 font-mono text-xs text-slate-700">
                                    {{ $officer->email }}
                                </td>
                                <td class="px-5 py-4">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-900 border border-emerald-200">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                        {{ $officer->district ?? 'Unassigned' }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-xs font-medium text-slate-700">
                                    {{ $officer->designation ?? 'District Livestock Officer' }}
                                </td>
                                <td class="px-5 py-4 font-mono text-xs text-slate-600">
                                    {{ $officer->phone ?? '—' }}
                                </td>
                                <td class="px-5 py-4">
                                    <span class="text-xs font-bold text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                                        Active
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-right text-xs text-slate-400">
                                    {{ $officer->created_at->format('d-M-Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-16 px-4">
                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center mx-auto mb-3">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-base font-bold text-slate-900">No District Officers Created Yet</h3>
                <p class="text-xs text-slate-500 max-w-sm mx-auto mt-1 mb-4">
                    Create district officers so they can log in, view forms, and manage poultry distribution in their respective districts.
                </p>
                <a href="{{ route('admin.officers.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-700 text-white font-bold text-xs shadow-md">
                    + Create First District Officer
                </a>
            </div>
        @endif
    </div>

</div>
@endsection
