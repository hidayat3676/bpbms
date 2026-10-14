@extends('layouts.app')

@section('title', 'Officer & Admin Login - BPBMS')

@section('content')
<div class="max-w-md mx-auto px-4 py-12 sm:py-16">

    <div class="text-center mb-8">
        <img src="{{ asset('favicon.svg') }}" alt="BPBMS Logo" class="w-16 h-16 rounded-2xl mx-auto shadow-lg shadow-emerald-900/20 mb-4 hover:scale-105 transition-transform duration-200">
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">BPBMS Officer Portal</h1>
        <p class="text-xs text-slate-500 mt-1">
            Central Directorate & District Livestock Officers (DLO) Sign In
        </p>
    </div>

    <div class="bg-white rounded-3xl p-6 sm:p-8 subtle-shadow border border-slate-100">
        
        <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                    Official Email Address
                </label>
                <input type="email" 
                       name="email" 
                       id="email" 
                       value="{{ old('email') }}"
                       placeholder="officer@bpbms.kp.gov.pk"
                       class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('email') ? 'border-rose-400 ring-rose-100' : 'border-slate-200' }} focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm text-slate-900 shadow-xs outline-none transition-all"
                       required 
                       autofocus>
                @error('email')
                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-slate-700">
                        Password
                    </label>
                </div>
                <input type="password" 
                       name="password" 
                       id="password" 
                       placeholder="••••••••"
                       class="w-full px-4 py-2.5 rounded-xl border {{ $errors->has('password') ? 'border-rose-400 ring-rose-100' : 'border-slate-200' }} focus:border-emerald-600 focus:ring-2 focus:ring-emerald-100 text-sm text-slate-900 shadow-xs outline-none transition-all"
                       required>
                @error('password')
                    <p class="text-xs text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center gap-2 cursor-pointer text-slate-600">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded text-emerald-600 border-slate-300 focus:ring-emerald-500">
                    <span>Keep me logged in</span>
                </label>
                <span class="text-slate-400">Govt Network</span>
            </div>

            <button type="submit" 
                    id="btn-login-submit"
                    class="w-full py-3 rounded-xl bg-gradient-to-r from-emerald-700 via-teal-700 to-emerald-800 hover:from-emerald-800 hover:to-teal-900 text-white font-bold text-sm shadow-md shadow-emerald-800/20 hover:shadow-lg transition-all duration-200">
                Sign In to Portal &rarr;
            </button>

        </form>

        <!-- Quick Credentials Helper for Evaluation -->
        <div class="mt-6 pt-5 border-t border-slate-100 text-xs">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                    Quick Demo Credentials:
                </span>
                <span class="text-[11px] font-semibold text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded-md border border-emerald-200">
                    Password: <code class="font-mono font-bold">password</code>
                </span>
            </div>
            <div class="space-y-1.5 font-mono text-[11px]">
                <button type="button" 
                        onclick="fillCreds('admin@bpbms.kp.gov.pk', 'password')" 
                        class="w-full text-left p-2 rounded-lg bg-slate-50 hover:bg-emerald-50 border border-slate-200 text-slate-700 flex justify-between items-center transition-colors">
                    <span><strong class="font-sans text-slate-900">Central Admin:</strong> admin@bpbms.kp.gov.pk</span>
                    <span class="text-[10px] text-emerald-700 font-bold font-sans">Autofill &rarr;</span>
                </button>
                <button type="button" 
                        onclick="fillCreds('dlo.peshawar@bpbms.kp.gov.pk', 'password')" 
                        class="w-full text-left p-2 rounded-lg bg-slate-50 hover:bg-emerald-50 border border-slate-200 text-slate-700 flex justify-between items-center transition-colors">
                    <span><strong class="font-sans text-slate-900">DLO Peshawar:</strong> dlo.peshawar@bpbms.kp.gov.pk</span>
                    <span class="text-[10px] text-emerald-700 font-bold font-sans">Autofill &rarr;</span>
                </button>
                <button type="button" 
                        onclick="fillCreds('dlo.swabi@bpbms.kp.gov.pk', 'password')" 
                        class="w-full text-left p-2 rounded-lg bg-slate-50 hover:bg-emerald-50 border border-slate-200 text-slate-700 flex justify-between items-center transition-colors">
                    <span><strong class="font-sans text-slate-900">DLO Swabi:</strong> dlo.swabi@bpbms.kp.gov.pk</span>
                    <span class="text-[10px] text-emerald-700 font-bold font-sans">Autofill &rarr;</span>
                </button>
                <button type="button" 
                        onclick="fillCreds('dlo.mardan@bpbms.kp.gov.pk', 'password')" 
                        class="w-full text-left p-2 rounded-lg bg-slate-50 hover:bg-emerald-50 border border-slate-200 text-slate-700 flex justify-between items-center transition-colors">
                    <span><strong class="font-sans text-slate-900">DLO Mardan:</strong> dlo.mardan@bpbms.kp.gov.pk</span>
                    <span class="text-[10px] text-emerald-700 font-bold font-sans">Autofill &rarr;</span>
                </button>
            </div>
        </div>

    </div>

</div>

@push('scripts')
<script>
    function fillCreds(email, password) {
        document.getElementById('email').value = email;
        document.getElementById('password').value = password;
    }
</script>
@endpush
@endsection
