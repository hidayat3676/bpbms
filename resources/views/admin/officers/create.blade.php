@extends('layouts.app')

@section('title', 'Create District Officer User - BPBMS Admin')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 space-y-8">

    <!-- Header breadcrumb & Title -->
    <div>
        <div class="flex items-center gap-2 text-xs font-semibold text-slate-500 mb-1.5">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-emerald-700 transition-colors">Admin Dashboard</a>
            <span>/</span>
            <a href="{{ route('admin.officers.index') }}" class="hover:text-emerald-700 transition-colors">District Officers</a>
            <span>/</span>
            <span class="text-emerald-700">Create Officer User</span>
        </div>
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
            Onboard District Officer (DLO)
        </h1>
        <p class="text-sm text-slate-500 mt-1">
            Create user credentials for a District Livestock Officer to access their district's BPBMS panel.
        </p>
    </div>

    <!-- Creation Form Card -->
    <div class="bg-white rounded-3xl p-6 sm:p-10 subtle-shadow border border-slate-100">
        
        <form action="{{ route('admin.officers.store') }}" method="POST" id="create-officer-form" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                
                <!-- Officer Name -->
                <div class="sm:col-span-2">
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Officer Full Name <span class="text-rose-600">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name') }}"
                           placeholder="e.g. Dr. Muhammad Tariq Khan"
                           class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('name') ? 'border-rose-400 ring-rose-100' : 'border-slate-200' }} focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm text-slate-900 shadow-xs outline-none transition-all"
                           required>
                    @error('name')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Official Email Address <span class="text-rose-600">*</span>
                    </label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email') }}"
                           placeholder="dlo.district@bpbms.kp.gov.pk"
                           class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('email') ? 'border-rose-400 ring-rose-100' : 'border-slate-200' }} focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm text-slate-900 shadow-xs outline-none transition-all"
                           required>
                    @error('email')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Assigned KP District (Dropdown) -->
                <div>
                    <label for="district" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Assigned KP District <span class="text-rose-600">*</span>
                    </label>
                    <select name="district" 
                            id="district" 
                            class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('district') ? 'border-rose-400 ring-rose-100' : 'border-slate-200' }} focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm text-slate-900 shadow-xs outline-none bg-white transition-all cursor-pointer"
                            required>
                        <option value="">-- Select Assigned District --</option>
                        @foreach($districts as $d)
                            <option value="{{ $d }}" {{ old('district') == $d ? 'selected' : '' }}>
                                {{ $d }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-[11px] text-slate-400 mt-1">The officer's panel will be strictly scoped to this district.</p>
                    @error('district')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Designation -->
                <div>
                    <label for="designation" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Official Designation
                    </label>
                    <input type="text" 
                           name="designation" 
                           id="designation" 
                           value="{{ old('designation', 'District Livestock Officer (DLO)') }}"
                           placeholder="e.g. District Livestock Officer (DLO)"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm text-slate-900 shadow-xs outline-none transition-all">
                </div>

                <!-- Contact Phone -->
                <div>
                    <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Contact Phone / Mobile
                    </label>
                    <input type="text" 
                           name="phone" 
                           id="phone" 
                           value="{{ old('phone') }}"
                           placeholder="03001234567"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm text-slate-900 shadow-xs outline-none transition-all">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Login Password <span class="text-rose-600">*</span>
                    </label>
                    <input type="password" 
                           name="password" 
                           id="password" 
                           placeholder="Minimum 6 characters"
                           class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('password') ? 'border-rose-400 ring-rose-100' : 'border-slate-200' }} focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm text-slate-900 shadow-xs outline-none transition-all"
                           required>
                    @error('password')
                        <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Confirm Password <span class="text-rose-600">*</span>
                    </label>
                    <input type="password" 
                           name="password_confirmation" 
                           id="password_confirmation" 
                           placeholder="Repeat password"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm text-slate-900 shadow-xs outline-none transition-all"
                           required>
                </div>

            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-slate-100">
                <a href="{{ route('admin.officers.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-slate-700 text-xs font-bold hover:bg-slate-50 transition-colors">
                    Cancel
                </a>

                <button type="submit" 
                        id="submit-create-officer-btn"
                        class="inline-flex items-center gap-2 px-7 py-3 rounded-xl bg-gradient-to-r from-emerald-700 via-teal-700 to-emerald-800 hover:from-emerald-800 hover:to-teal-900 text-white font-bold text-sm shadow-md transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Create & Authorize Officer</span>
                </button>
            </div>

        </form>

    </div>

</div>
@endsection
