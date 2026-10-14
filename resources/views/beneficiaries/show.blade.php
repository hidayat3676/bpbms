@extends('layouts.app')

@section('title', 'Beneficiary Registration Slip - ' . $beneficiary->application_no)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">

    <!-- Top Action Bar (Hide in Print) -->
    <div class="no-print flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
            <a href="{{ route('home') }}" class="hover:text-emerald-700 transition-colors">Home</a>
            <span>/</span>
            <a href="{{ route('beneficiaries.index') }}" class="hover:text-emerald-700 transition-colors">Beneficiaries</a>
            <span>/</span>
            <span class="text-emerald-700 font-mono">{{ $beneficiary->application_no }}</span>
        </div>

        <div class="flex flex-wrap items-center gap-2.5">
            <a href="{{ route('beneficiaries.create') }}" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-700 text-xs font-bold hover:bg-slate-50 transition-colors">
                + Register Another
            </a>
            <a href="{{ route('beneficiaries.thermal', $beneficiary) }}" 
               id="print-thermal-btn"
               target="_blank"
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-700 hover:bg-emerald-800 text-white font-bold text-xs sm:text-sm shadow-md transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <span>Thermal Slip (80mm)</span>
            </a>
            <button type="button" 
                    onclick="window.print()" 
                    id="print-slip-btn"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs sm:text-sm shadow-md transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                <span>Print A4 Slip</span>
            </button>
        </div>
    </div>

    <!-- Official Printable Certificate Slip -->
    <div class="bg-white rounded-3xl p-6 sm:p-10 subtle-shadow border-2 border-slate-200 print:border-slate-400 print:shadow-none print:p-0">
        
        <!-- Official Government Header -->
        <div class="border-b-2 border-emerald-800 pb-6 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-2xl bg-emerald-800 text-white flex items-center justify-center font-bold text-2xl shadow-sm">
                        KP
                    </div>
                    <div>
                        <span class="text-xs uppercase font-extrabold tracking-widest text-emerald-800 block">Government of Khyber Pakhtunkhwa</span>
                        <h2 class="text-lg sm:text-xl font-black text-slate-900 leading-tight">
                            Livestock, Fisheries & Cooperative Department
                        </h2>
                        <p class="text-xs text-slate-600 font-medium mt-0.5">
                            Directorate General (Extension) • Backyard Poultry Development Initiative
                        </p>
                    </div>
                </div>

                <div class="text-right hidden sm:block">
                    <div class="inline-block px-3 py-1 rounded-lg bg-emerald-50 text-emerald-900 border border-emerald-300 font-mono text-xs font-bold">
                        BPBMS VERIFIED
                    </div>
                    <p class="text-[11px] text-slate-500 mt-1">Issue Date: {{ $beneficiary->created_at->format('d-M-Y') }}</p>
                </div>
            </div>

            <div class="mt-4 pt-3 border-t border-slate-100 flex flex-wrap items-center justify-between text-xs text-slate-600">
                <span class="font-bold text-slate-800">DOCUMENT: BENEFICIARY ENROLLMENT & UNIT ALLOCATION SLIP</span>
                <span class="font-mono font-bold text-emerald-800 text-sm"># {{ $beneficiary->application_no }}</span>
            </div>
        </div>

        <!-- Beneficiary Credential Grid -->
        <div class="space-y-6">
            
            <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200">
                <h3 class="text-xs uppercase tracking-wider font-extrabold text-slate-500 mb-4 pb-2 border-b border-slate-200">
                    Beneficiary Particulars
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-4 gap-x-6 text-sm">
                    <div>
                        <span class="text-xs text-slate-500 block">Application / Farm No:</span>
                        <span class="font-mono font-bold text-slate-900 text-base">{{ $beneficiary->application_no }}</span>
                    </div>

                    <div>
                        <span class="text-xs text-slate-500 block">Beneficiary Name (Female):</span>
                        <span class="font-bold text-slate-900 text-base">
                            {{ $beneficiary->beneficiary_name }}
                            <span class="ml-1 text-[11px] font-bold px-1.5 py-0.5 rounded bg-pink-100 text-pink-800 border border-pink-200">Female</span>
                        </span>
                    </div>

                    <div>
                        <span class="text-xs text-slate-500 block">Wife / Widow of:</span>
                        <span class="font-semibold text-slate-800">{{ $beneficiary->wife_or_widow_of }}</span>
                    </div>

                    <div>
                        <span class="text-xs text-slate-500 block">CNIC No:</span>
                        <span class="font-mono font-bold text-slate-900">{{ $beneficiary->cnic_no }}</span>
                    </div>

                    <div>
                        <span class="text-xs text-slate-500 block">Contact Mobile No:</span>
                        <span class="font-mono font-semibold text-slate-800">{{ $beneficiary->contact_no }}</span>
                    </div>

                    <div>
                        <span class="text-xs text-slate-500 block">District & Tehsil:</span>
                        <span class="font-bold text-emerald-900">{{ $beneficiary->tehsil }}, {{ $beneficiary->district }}</span>
                    </div>

                    <div class="sm:col-span-2">
                        <span class="text-xs text-slate-500 block">Village & Residential Address:</span>
                        <span class="text-slate-800 font-medium">{{ $beneficiary->village }} — {{ $beneficiary->address }}</span>
                    </div>
                </div>
            </div>

            <!-- Vulnerability & Package Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                
                <!-- Vulnerability Status -->
                <div class="bg-slate-50 rounded-2xl p-5 border border-slate-200">
                    <h3 class="text-xs uppercase tracking-wider font-extrabold text-slate-500 mb-3 pb-2 border-b border-slate-200">
                        Vulnerability Tick Marks
                    </h3>

                    <div class="space-y-2">
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-medium text-slate-700">Female-Headed Household:</span>
                            <span class="font-bold {{ $beneficiary->is_headed ? 'text-emerald-700' : 'text-slate-400' }}">
                                {{ $beneficiary->is_headed ? '✓ YES' : '— NO' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-medium text-slate-700">Widow:</span>
                            <span class="font-bold {{ $beneficiary->is_widow ? 'text-emerald-700' : 'text-slate-400' }}">
                                {{ $beneficiary->is_widow ? '✓ YES' : '— NO' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-medium text-slate-700">Homeless / Shelterless:</span>
                            <span class="font-bold {{ $beneficiary->is_homeless ? 'text-emerald-700' : 'text-slate-400' }}">
                                {{ $beneficiary->is_homeless ? '✓ YES' : '— NO' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-medium text-slate-700">Ultra-Poor / Needy:</span>
                            <span class="font-bold {{ $beneficiary->is_poor ? 'text-emerald-700' : 'text-slate-400' }}">
                                {{ $beneficiary->is_poor ? '✓ YES' : '— NO' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Entitlement & Payment Details -->
                <div class="bg-emerald-50/70 rounded-2xl p-5 border border-emerald-200">
                    <h3 class="text-xs uppercase tracking-wider font-extrabold text-emerald-900 mb-3 pb-2 border-b border-emerald-200">
                        Poultry Package Allocation
                    </h3>

                    <div class="space-y-2.5 text-xs">
                        <div class="flex items-center justify-between">
                            <span class="font-semibold text-emerald-950">Unit Allocation:</span>
                            <span class="font-bold text-emerald-800 text-sm">1 Unit (12 Birds)</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600">Breakdown:</span>
                            <span class="font-medium text-slate-800">10 Hens + 2 Roosters</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-600">Family Policy:</span>
                            <span class="font-semibold text-slate-800">Strictly 1 Unit / Family</span>
                        </div>
                        <div class="flex items-center justify-between pt-2 border-t border-emerald-200">
                            <span class="font-bold text-emerald-950 text-sm">Amount Received:</span>
                            <span class="font-extrabold text-emerald-900 text-base">PKR {{ number_format($beneficiary->amount_received_per_unit) }}</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Verification & Signature Blocks -->
            <div class="pt-8 mt-6 border-t-2 border-dashed border-slate-200 grid grid-cols-2 sm:grid-cols-3 gap-6 text-center text-xs">
                
                <div class="pt-10 border-t border-slate-400">
                    <p class="font-bold text-slate-800">Beneficiary Signature / Thumb</p>
                    <p class="text-[10px] text-slate-500 mt-0.5">Received 12 live vaccinated birds</p>
                </div>

                <div class="pt-10 border-t border-slate-400">
                    <p class="font-bold text-slate-800">Veterinary Officer / Incharge</p>
                    <p class="text-[10px] text-slate-500 mt-0.5">Tehsil Distribution Center</p>
                </div>

                <div class="pt-10 border-t border-slate-400 col-span-2 sm:col-span-1">
                    <p class="font-bold text-slate-800">Official Stamp</p>
                    <p class="text-[10px] text-slate-500 mt-0.5">Livestock & Dairy Dev Dept, KP</p>
                </div>

            </div>

        </div>

    </div>

</div>
@endsection
