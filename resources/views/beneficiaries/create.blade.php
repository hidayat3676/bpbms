@extends('layouts.app')

@section('title', 'Beneficiary Registration Form - BPBMS')

@section('content')
<div class="max-w-[1700px] w-full mx-auto px-4 sm:px-6 lg:px-12 py-8 sm:py-12">

    <!-- Header breadcrumb & Title -->
    <div class="mb-8">
        <div class="flex items-center gap-2 text-xs font-semibold text-slate-500 mb-2">
            <a href="{{ route('home') }}" class="hover:text-emerald-700 transition-colors">Home</a>
            <span>/</span>
            <a href="{{ route('beneficiaries.index') }}" class="hover:text-emerald-700 transition-colors">Beneficiaries</a>
            <span>/</span>
            <span class="text-emerald-700">New Registration</span>
        </div>
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    Beneficiary Enrollment & Unit Issuance Form
                </h1>
                <p class="text-sm text-slate-500 mt-1">
                    Enter female beneficiary credentials for the Backyard Poultry package (12 birds per family).
                </p>
            </div>
            <a href="{{ route('beneficiaries.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 text-xs font-bold hover:bg-slate-50 shadow-xs transition-colors self-start sm:self-auto">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Back to Roster</span>
            </a>
        </div>
    </div>

    <!-- Main Registration Layout (Form + Realtime Preview Sidebar) -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start">
        
        <!-- Form Column (Wide) -->
        <div class="xl:col-span-9 w-full">
            <form action="{{ route('beneficiaries.store') }}" method="POST" id="beneficiary-form" class="space-y-8">
                @csrf

                <!-- Section 1: Application & Identification -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 subtle-shadow border border-slate-100 space-y-6">
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 font-bold flex items-center justify-center text-sm">1</span>
                            <div>
                                <h2 class="text-base font-bold text-slate-900">Application & Personal Credentials</h2>
                                <p class="text-xs text-slate-500">Official tracking code and beneficiary identity</p>
                            </div>
                        </div>
                        <span class="text-[11px] font-bold px-2.5 py-1 rounded-full bg-pink-100 text-pink-800 border border-pink-200">
                            Female Beneficiaries Only
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        
                        <!-- Application / Farm No. -->
                        <div>
                            <label for="application_no" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Application / Farm No. <span class="text-slate-400 font-normal">(Auto/Editable)</span>
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       name="application_no" 
                                       id="application_no" 
                                       value="{{ old('application_no', $nextApplicationNo) }}"
                                       placeholder="e.g. BPBMS-2026-0001-XXXX"
                                       class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('application_no') ? 'border-rose-400 ring-rose-100' : 'border-slate-200' }} focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm font-mono font-medium text-slate-900 shadow-xs outline-none transition-all"
                                       required>
                                <span class="absolute right-3 top-2.5 text-xs text-emerald-600 font-semibold bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                                    Serial
                                </span>
                            </div>
                            @error('application_no')
                                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Beneficiary Name (female only) -->
                        <div>
                            <label for="beneficiary_name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Beneficiary Name <span class="text-pink-600 font-bold">(Female Only) *</span>
                            </label>
                            <input type="text" 
                                   name="beneficiary_name" 
                                   id="beneficiary_name" 
                                   value="{{ old('beneficiary_name') }}"
                                   placeholder="e.g. Bibi Maryam / Fatima Bibi"
                                   class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('beneficiary_name') ? 'border-rose-400 ring-rose-100' : 'border-slate-200' }} focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm text-slate-900 shadow-xs outline-none transition-all"
                                   required>
                            @error('beneficiary_name')
                                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Wife/Widow of -->
                        <div>
                            <label for="wife_or_widow_of" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Wife / Widow of <span class="text-rose-600">*</span>
                            </label>
                            <input type="text" 
                                   name="wife_or_widow_of" 
                                   id="wife_or_widow_of" 
                                   value="{{ old('wife_or_widow_of') }}"
                                   placeholder="Husband or Late Husband's Name"
                                   class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('wife_or_widow_of') ? 'border-rose-400 ring-rose-100' : 'border-slate-200' }} focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm text-slate-900 shadow-xs outline-none transition-all"
                                   required>
                            @error('wife_or_widow_of')
                                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- CNIC No of the Beneficiary -->
                        <div>
                            <label for="cnic_no" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                CNIC No of Beneficiary <span class="text-rose-600">*</span>
                            </label>
                            <div class="relative">
                                <input type="text" 
                                       name="cnic_no" 
                                       id="cnic_no" 
                                       value="{{ old('cnic_no') }}"
                                       placeholder="XXXXX-XXXXXXX-X (13 Digits)"
                                       maxlength="15"
                                       class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('cnic_no') ? 'border-rose-400 ring-rose-100' : 'border-slate-200' }} focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm font-mono text-slate-900 shadow-xs outline-none transition-all"
                                       required>
                                <span class="absolute right-3 top-2.5 text-xs text-slate-400 font-mono">
                                    NADRA
                                </span>
                            </div>
                            <p class="text-[11px] text-slate-400 mt-1">Format: 17301-1234567-2</p>
                            @error('cnic_no')
                                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Contact No -->
                        <div>
                            <label for="contact_no" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Contact No <span class="text-rose-600">*</span>
                            </label>
                            <input type="text" 
                                   name="contact_no" 
                                   id="contact_no" 
                                   value="{{ old('contact_no') }}"
                                   placeholder="e.g. 03001234567"
                                   maxlength="12"
                                   class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('contact_no') ? 'border-rose-400 ring-rose-100' : 'border-slate-200' }} focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm font-mono text-slate-900 shadow-xs outline-none transition-all"
                                   required>
                            @error('contact_no')
                                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Female Only Check / Confirmation -->
                        <div class="md:col-span-2 xl:col-span-3 pt-2">
                            <label class="flex items-center gap-3 p-3.5 rounded-xl bg-pink-50/70 border border-pink-200 cursor-pointer hover:bg-pink-50 transition-colors">
                                <input type="checkbox" 
                                       name="is_female_confirmed" 
                                       id="is_female_confirmed" 
                                       value="1" 
                                       {{ old('is_female_confirmed', '1') ? 'checked' : '' }}
                                       class="w-5 h-5 rounded text-pink-600 border-pink-300 focus:ring-pink-500" 
                                       required>
                                <div class="text-xs text-slate-800">
                                    <span class="font-bold text-pink-900">Gender Eligibility Confirmation:</span>
                                    I confirm that this applicant is a female resident eligible under the KP Backyard Poultry Women Empowerment Program.
                                </div>
                            </label>
                            @error('is_female_confirmed')
                                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- Section 2: Location Details (KP Districts & Tehsils) -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 subtle-shadow border border-slate-100 space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                        <span class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 font-bold flex items-center justify-center text-sm">2</span>
                        <div>
                            <h2 class="text-base font-bold text-slate-900">Geographic & Address Details</h2>
                            <p class="text-xs text-slate-500">Khyber Pakhtunkhwa administrative location</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        
                        <!-- Dropdown of KP Districts -->
                        <div>
                            <label for="district" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                KP District (Dropdown) <span class="text-rose-600">*</span>
                            </label>
                            <select name="district" 
                                    id="district" 
                                    class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('district') ? 'border-rose-400 ring-rose-100' : 'border-slate-200' }} focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm text-slate-900 shadow-xs outline-none bg-white transition-all cursor-pointer"
                                    required>
                                <option value="">-- Select KP District --</option>
                                @php 
                                    $selectedDistrict = old('district', request('district', (auth()->check() && auth()->user()->isDistrictOfficer() ? auth()->user()->district : '')));
                                @endphp
                                @foreach($districts as $dist)
                                    <option value="{{ $dist }}" {{ $selectedDistrict == $dist ? 'selected' : '' }}>
                                        {{ $dist }}
                                    </option>
                                @endforeach
                            </select>
                            @error('district')
                                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tehsil (KP Tehsils, dynamically filtered) -->
                        <div>
                            <label for="tehsil" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Tehsil (KP Tehsils) <span class="text-rose-600">*</span>
                            </label>
                            <select name="tehsil" 
                                    id="tehsil" 
                                    class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('tehsil') ? 'border-rose-400 ring-rose-100' : 'border-slate-200' }} focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm text-slate-900 shadow-xs outline-none bg-white transition-all cursor-pointer"
                                    required>
                                <option value="">-- Select District First --</option>
                                @if(old('tehsil'))
                                    <option value="{{ old('tehsil') }}" selected>{{ old('tehsil') }}</option>
                                @endif
                            </select>
                            <p class="text-[11px] text-slate-400 mt-1">Tehsils load automatically when district is selected.</p>
                            @error('tehsil')
                                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Village -->
                        <div>
                            <label for="village" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Village / VC / Mohallah <span class="text-rose-600">*</span>
                            </label>
                            <input type="text" 
                                   name="village" 
                                   id="village" 
                                   value="{{ old('village') }}"
                                   placeholder="e.g. Village Landi Arbab, VC-3"
                                   class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('village') ? 'border-rose-400 ring-rose-100' : 'border-slate-200' }} focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm text-slate-900 shadow-xs outline-none transition-all"
                                   required>
                            @error('village')
                                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="md:col-span-2 xl:col-span-3">
                            <label for="address" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Detailed Residential Address <span class="text-rose-600">*</span>
                            </label>
                            <textarea name="address" 
                                      id="address" 
                                      rows="2"
                                      placeholder="House / Compound number, nearby landmark, street name..."
                                      class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('address') ? 'border-rose-400 ring-rose-100' : 'border-slate-200' }} focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm text-slate-900 shadow-xs outline-none transition-all"
                                      required>{{ old('address') }}</textarea>
                            @error('address')
                                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- Section 3: Priority Vulnerability Criteria (Tick Mark with values: Headed, widow, homeless, poor) -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 subtle-shadow border border-slate-100 space-y-6">
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-xl bg-amber-100 text-amber-800 font-bold flex items-center justify-center text-sm">3</span>
                            <div>
                                <h2 class="text-base font-bold text-slate-900">Priority Vulnerability Category</h2>
                                <p class="text-xs text-slate-500">Tick mark applicable values (Select at least one)</p>
                            </div>
                        </div>
                        <span class="text-xs text-amber-600 font-semibold bg-amber-50 px-2 py-0.5 rounded border border-amber-200">
                            Required Criteria
                        </span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-3">
                            Tick Mark with values: <span class="text-rose-600">*</span>
                        </label>

                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                            
                            <!-- Headed -->
                            <label class="relative flex items-start p-4 rounded-2xl border-2 border-slate-200 hover:border-emerald-500 has-checked:border-emerald-600 has-checked:bg-emerald-50/50 cursor-pointer transition-all">
                                <input type="checkbox" 
                                       name="vulnerabilities[]" 
                                       value="headed" 
                                       id="vuln-headed"
                                       {{ is_array(old('vulnerabilities')) && in_array('headed', old('vulnerabilities')) ? 'checked' : '' }}
                                       class="w-5 h-5 mt-0.5 rounded text-emerald-600 border-slate-300 focus:ring-emerald-500 shrink-0">
                                <div class="ml-3.5">
                                    <span class="block text-sm font-bold text-slate-900">Headed</span>
                                    <span class="block text-xs text-slate-500 mt-0.5">Female-headed household with dependent minors or elderly.</span>
                                </div>
                            </label>

                            <!-- Widow -->
                            <label class="relative flex items-start p-4 rounded-2xl border-2 border-slate-200 hover:border-purple-500 has-checked:border-purple-600 has-checked:bg-purple-50/50 cursor-pointer transition-all">
                                <input type="checkbox" 
                                       name="vulnerabilities[]" 
                                       value="widow" 
                                       id="vuln-widow"
                                       {{ is_array(old('vulnerabilities')) && in_array('widow', old('vulnerabilities')) ? 'checked' : '' }}
                                       class="w-5 h-5 mt-0.5 rounded text-purple-600 border-slate-300 focus:ring-purple-500 shrink-0">
                                <div class="ml-3.5">
                                    <span class="block text-sm font-bold text-slate-900">Widow</span>
                                    <span class="block text-xs text-slate-500 mt-0.5">Widowed woman without adult earning members in household.</span>
                                </div>
                            </label>

                            <!-- Homeless -->
                            <label class="relative flex items-start p-4 rounded-2xl border-2 border-slate-200 hover:border-amber-500 has-checked:border-amber-600 has-checked:bg-amber-50/50 cursor-pointer transition-all">
                                <input type="checkbox" 
                                       name="vulnerabilities[]" 
                                       value="homeless" 
                                       id="vuln-homeless"
                                       {{ is_array(old('vulnerabilities')) && in_array('homeless', old('vulnerabilities')) ? 'checked' : '' }}
                                       class="w-5 h-5 mt-0.5 rounded text-amber-600 border-slate-300 focus:ring-amber-500 shrink-0">
                                <div class="ml-3.5">
                                    <span class="block text-sm font-bold text-slate-900">Homeless</span>
                                    <span class="block text-xs text-slate-500 mt-0.5">Shelterless or residing in makeshift mud/tent accommodations.</span>
                                </div>
                            </label>

                            <!-- Poor -->
                            <label class="relative flex items-start p-4 rounded-2xl border-2 border-slate-200 hover:border-rose-500 has-checked:border-rose-600 has-checked:bg-rose-50/50 cursor-pointer transition-all">
                                <input type="checkbox" 
                                       name="vulnerabilities[]" 
                                       value="poor" 
                                       id="vuln-poor"
                                       {{ is_array(old('vulnerabilities')) && in_array('poor', old('vulnerabilities')) ? 'checked' : '' }}
                                       class="w-5 h-5 mt-0.5 rounded text-rose-600 border-slate-300 focus:ring-rose-500 shrink-0">
                                <div class="ml-3.5">
                                    <span class="block text-sm font-bold text-slate-900">Poor</span>
                                    <span class="block text-xs text-slate-500 mt-0.5">Ultra-poor / daily-wage family under poverty line threshold.</span>
                                </div>
                            </label>

                        </div>

                        @error('vulnerabilities')
                            <p class="text-xs text-rose-600 mt-2 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Section 4: Unit Allocation & Payment (One unit (12 birds) given to one family & Amount received) -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 subtle-shadow border border-slate-100 space-y-6">
                    <div class="flex items-center gap-3 pb-4 border-b border-slate-100">
                        <span class="w-8 h-8 rounded-xl bg-teal-100 text-teal-800 font-bold flex items-center justify-center text-sm">4</span>
                        <div>
                            <h2 class="text-base font-bold text-slate-900">Unit Entitlement & Subsidized Payment</h2>
                            <p class="text-xs text-slate-500">Poultry unit package and beneficiary contribution</p>
                        </div>
                    </div>

                    <!-- Checkbox for One unit (12 birds) given to one family -->
                    <div class="p-5 rounded-2xl bg-gradient-to-r from-emerald-50 via-teal-50 to-emerald-50 border-2 border-emerald-300 shadow-sm">
                        <label class="flex items-start gap-3.5 cursor-pointer">
                            <input type="checkbox" 
                                   name="one_unit_given" 
                                   id="one_unit_given" 
                                   value="1" 
                                   {{ old('one_unit_given', '1') ? 'checked' : '' }}
                                   class="w-6 h-6 mt-1 rounded text-emerald-600 border-emerald-400 focus:ring-emerald-500 shrink-0" 
                                   required>
                            <div>
                                <span class="block text-base font-extrabold text-emerald-950">
                                    One unit (12 birds) given to one family <span class="text-rose-600">*</span>
                                </span>
                                <p class="text-xs text-emerald-800 mt-1 leading-relaxed">
                                    I certify that exactly <strong>1 unit comprising 12 vaccinated poultry birds</strong> (10 hens + 2 roosters) is being assigned to this unique household. No multiple units shall be issued to the same family.
                                </p>
                            </div>
                        </label>
                        @error('one_unit_given')
                            <p class="text-xs text-rose-600 mt-2 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Amount received Per Unit -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                        <div>
                            <label for="amount_received_per_unit" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Amount Received Per Unit (PKR) <span class="text-rose-600">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3.5 top-2.5 text-xs text-slate-500 font-bold">
                                    PKR
                                </span>
                                <input type="number" 
                                       step="0.01" 
                                       min="0"
                                       name="amount_received_per_unit" 
                                       id="amount_received_per_unit" 
                                       value="{{ old('amount_received_per_unit', '1050') }}"
                                       placeholder="1050"
                                       class="w-full pl-14 pr-4 py-2.5 rounded-xl border {{ $errors->has('amount_received_per_unit') ? 'border-rose-400 ring-rose-100' : 'border-slate-200' }} focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm font-bold text-slate-900 shadow-xs outline-none transition-all"
                                       required>
                            </div>
                            <p class="text-[11px] text-slate-400 mt-1">Government subsidized rate per 12 birds unit (Default: Rs. 1,050).</p>
                            @error('amount_received_per_unit')
                                <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remarks / Notes -->
                        <div>
                            <label for="remarks" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                                Officer Remarks / Batch Note <span class="text-slate-400 font-normal">(Optional)</span>
                            </label>
                            <input type="text" 
                                   name="remarks" 
                                   id="remarks" 
                                   value="{{ old('remarks', 'One unit (12 birds) poultry package issued.') }}"
                                   placeholder="Vaccination batch / distribution camp notes"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm text-slate-900 shadow-xs outline-none transition-all">
                        </div>
                    </div>

                </div>

                <!-- Form Action Buttons -->
                <div class="flex items-center justify-between pt-4">
                    <a href="{{ route('beneficiaries.index') }}" class="px-5 py-3 rounded-xl border border-slate-300 text-slate-700 text-sm font-bold hover:bg-slate-50 transition-colors">
                        Cancel
                    </a>

                    <button type="submit" 
                            id="submit-beneficiary-btn"
                            class="inline-flex items-center gap-3 px-8 py-3.5 rounded-xl bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 hover:from-emerald-700 hover:to-teal-800 text-white font-extrabold text-sm sm:text-base shadow-lg shadow-emerald-700/25 hover:shadow-xl hover:shadow-emerald-700/35 hover:scale-[1.01] transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Save & Issue Registration Slip</span>
                    </button>
                </div>

            </form>
        </div>

        <!-- Live Preview Card Column -->
        <div class="xl:col-span-3 sticky top-28 space-y-6">
            
            <!-- Real-time Certificate Slip Preview -->
            <div class="bg-gradient-to-br from-slate-900 via-emerald-950 to-slate-900 text-white rounded-3xl p-6 shadow-2xl border border-emerald-500/30 relative overflow-hidden">
                <div class="absolute -top-12 -right-12 w-36 h-36 bg-emerald-500/10 rounded-full blur-2xl"></div>

                <div class="flex items-center justify-between pb-4 border-b border-white/10">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-amber-400">Live Slip Preview</span>
                    <span class="text-[10px] px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 border border-emerald-400/30">12 Birds Entitlement</span>
                </div>

                <div class="mt-4 space-y-3 font-mono text-xs">
                    <div>
                        <span class="text-[10px] text-slate-400 uppercase tracking-wider block">Application / Farm No:</span>
                        <span id="preview-app-no" class="text-sm font-bold text-amber-300">{{ $nextApplicationNo }}</span>
                    </div>

                    <div>
                        <span class="text-[10px] text-slate-400 uppercase tracking-wider block">Beneficiary Name (Female):</span>
                        <span id="preview-name" class="text-sm font-bold text-white">—</span>
                    </div>

                    <div>
                        <span class="text-[10px] text-slate-400 uppercase tracking-wider block">Wife / Widow of:</span>
                        <span id="preview-guardian" class="text-xs text-slate-300">—</span>
                    </div>

                    <div>
                        <span class="text-[10px] text-slate-400 uppercase tracking-wider block">CNIC:</span>
                        <span id="preview-cnic" class="text-xs text-slate-300">—</span>
                    </div>

                    <div>
                        <span class="text-[10px] text-slate-400 uppercase tracking-wider block">Location (KP):</span>
                        <span id="preview-location" class="text-xs text-slate-300">—</span>
                    </div>

                    <div class="pt-2 border-t border-white/10 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] text-slate-400 uppercase tracking-wider block">Unit Package:</span>
                            <span class="text-xs font-bold text-emerald-400">1 Unit (12 Birds)</span>
                        </div>
                        <div class="text-right">
                            <span class="text-[10px] text-slate-400 uppercase tracking-wider block">Contribution:</span>
                            <span id="preview-amount" class="text-xs font-bold text-amber-400">PKR 1,050</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-t border-white/10 flex items-center justify-between text-[10px] text-slate-400 font-sans">
                    <span>Govt of Khyber Pakhtunkhwa</span>
                    <span>BPBMS Verified</span>
                </div>
            </div>

            <!-- Helpful Tips Card -->
            <div class="bg-white rounded-3xl p-6 subtle-shadow border border-slate-100 text-xs text-slate-600 space-y-3">
                <h4 class="font-bold text-slate-900 text-sm flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    Registration Guidelines
                </h4>
                <ul class="space-y-2 list-disc list-inside text-slate-600">
                    <li>CNIC numbers must be unique across all KP tehsils.</li>
                    <li>Ensure the telephone contact is reachable for vaccination reminders.</li>
                    <li>Beneficiary receives official printed acknowledgement slip upon submission.</li>
                </ul>
            </div>

        </div>

    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Full KP District to Tehsil Mapping
        const districtsData = @json($districtsWithTehsils);

        const districtSelect = document.getElementById('district');
        const tehsilSelect = document.getElementById('tehsil');
        const cnicInput = document.getElementById('cnic_no');
        const appNoInput = document.getElementById('application_no');
        const nameInput = document.getElementById('beneficiary_name');
        const guardianInput = document.getElementById('wife_or_widow_of');
        const amountInput = document.getElementById('amount_received_per_unit');

        // Preview Elements
        const previewAppNo = document.getElementById('preview-app-no');
        const previewName = document.getElementById('preview-name');
        const previewGuardian = document.getElementById('preview-guardian');
        const previewCnic = document.getElementById('preview-cnic');
        const previewLocation = document.getElementById('preview-location');
        const previewAmount = document.getElementById('preview-amount');

        // Function to update tehsils
        function updateTehsils(selectedDistrict, preserveTehsil = '') {
            tehsilSelect.innerHTML = '';
            
            if (!selectedDistrict || !districtsData[selectedDistrict]) {
                const opt = document.createElement('option');
                opt.value = '';
                opt.textContent = '-- Select District First --';
                tehsilSelect.appendChild(opt);
                return;
            }

            const defaultOpt = document.createElement('option');
            defaultOpt.value = '';
            defaultOpt.textContent = '-- Select Tehsil in ' + selectedDistrict + ' --';
            tehsilSelect.appendChild(defaultOpt);

            const tehsils = districtsData[selectedDistrict];
            tehsils.forEach(function (t) {
                const opt = document.createElement('option');
                opt.value = t;
                opt.textContent = t;
                if (preserveTehsil && preserveTehsil === t) {
                    opt.selected = true;
                }
                tehsilSelect.appendChild(opt);
            });
        }

        // District change listener
        districtSelect.addEventListener('change', function () {
            updateTehsils(this.value);
            updatePreview();
        });

        tehsilSelect.addEventListener('change', updatePreview);

        // Prepopulate tehsils if district is pre-selected (e.g. from old input)
        const initialDistrict = districtSelect.value;
        const initialTehsil = "{{ old('tehsil') }}";
        if (initialDistrict) {
            updateTehsils(initialDistrict, initialTehsil);
        }

        // Real-time CNIC input formatter: XXXXX-XXXXXXX-X
        cnicInput.addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 13) value = value.substring(0, 13);
            
            let formatted = '';
            if (value.length > 5) {
                formatted += value.substring(0, 5) + '-';
                if (value.length > 12) {
                    formatted += value.substring(5, 12) + '-' + value.substring(12, 13);
                } else {
                    formatted += value.substring(5);
                }
            } else {
                formatted = value;
            }
            e.target.value = formatted;
            updatePreview();
        });

        // Live preview sync
        function updatePreview() {
            previewAppNo.textContent = appNoInput.value.trim() || '—';
            previewName.textContent = nameInput.value.trim() || '—';
            previewGuardian.textContent = guardianInput.value.trim() || '—';
            previewCnic.textContent = cnicInput.value.trim() || '—';
            
            const dist = districtSelect.value;
            const teh = tehsilSelect.value;
            if (dist && teh) {
                previewLocation.textContent = teh + ', ' + dist;
            } else if (dist) {
                previewLocation.textContent = dist;
            } else {
                previewLocation.textContent = '—';
            }

            const amt = amountInput.value.trim();
            previewAmount.textContent = amt ? 'PKR ' + Number(amt).toLocaleString() : 'PKR 0';
        }

        appNoInput.addEventListener('input', updatePreview);
        nameInput.addEventListener('input', updatePreview);
        guardianInput.addEventListener('input', updatePreview);
        amountInput.addEventListener('input', updatePreview);

        updatePreview();
    });
</script>
@endpush
