<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'BPBMS') - Backyard Poultry Beneficiary Management System</title>
    <meta name="description" content="Backyard Poultry Beneficiary Management System (BPBMS) - Livestock & Dairy Development Department, Government of Khyber Pakhtunkhwa.">

    <!-- Relevant Favicon Suite -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <meta name="theme-color" content="#065f46">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN for guaranteed high-fidelity styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        urdu: ['Amiri', 'serif']
                    },
                    colors: {
                        emerald: {
                            850: '#064e3b',
                            950: '#022c22',
                        },
                        amber: {
                            450: '#f59e0b',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        /* Modern Glassmorphism & Custom styling */
        .glass-panel {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.8);
        }
        .hero-gradient {
            background: radial-gradient(circle at 10% 20%, rgba(16, 185, 129, 0.12) 0%, rgba(245, 158, 11, 0.08) 50%, rgba(255, 255, 255, 0) 100%),
                        linear-gradient(135deg, #064e3b 0%, #065f46 50%, #047857 100%);
        }
        .subtle-shadow {
            box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.05), 0 8px 10px -6px rgba(15, 23, 42, 0.03);
        }
        .card-hover {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(15, 23, 42, 0.08), 0 8px 10px -6px rgba(15, 23, 42, 0.04);
        }
        @media print {
            .no-print { display: none !important; }
            .print-only { display: block !important; }
            body { background: #fff !important; }
        }
    </style>

    @stack('styles')
</head>
<body class="flex flex-col min-h-screen text-slate-800 antialiased selection:bg-emerald-500 selection:text-white">

    <!-- Government Brand Top Bar -->
    <div class="no-print bg-slate-900 text-slate-300 text-xs py-1.5 px-4 sm:px-6 border-b border-slate-800">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-1">
            <div class="flex items-center gap-2">
                <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="font-medium text-emerald-400">Government of Khyber Pakhtunkhwa</span>
                <span class="text-slate-500">|</span>
                <span>Livestock, Fisheries & Cooperative Department</span>
            </div>
            <div class="flex items-center gap-4 text-slate-400">
                <span>Backyard Poultry Initiative</span>
                <span class="text-slate-600">•</span>
                <span class="font-semibold text-amber-400">Women Empowerment Scheme</span>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="no-print sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
                <!-- Logo & System Branding -->
                <a href="{{ route('home') }}" class="flex items-center gap-3.5 group">
                    <img src="{{ asset('favicon.svg') }}" alt="BPBMS Emblem" class="w-12 h-12 rounded-2xl shadow-md shadow-emerald-900/15 group-hover:scale-105 transition-transform duration-200">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="text-xl font-extrabold tracking-tight text-slate-900 group-hover:text-emerald-700 transition-colors">BPBMS</span>
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 uppercase tracking-wider border border-emerald-200">KP Initiative</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium">Backyard Poultry Beneficiary Management System</p>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center gap-1.5 lg:gap-2">
                    <a href="{{ route('home') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('home') ? 'bg-emerald-50 text-emerald-800 font-bold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        Home
                    </a>
                    <a href="{{ route('beneficiaries.index') }}" 
                       class="px-3.5 py-2 rounded-lg text-sm font-semibold transition-colors {{ request()->routeIs('beneficiaries.index') ? 'bg-emerald-50 text-emerald-800 font-bold' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                        Public Directory
                    </a>

                    @auth
                        @if(auth()->user()->isAdmin())
                            <div class="h-6 w-px bg-slate-200 mx-1"></div>
                            <a href="{{ route('admin.dashboard') }}" 
                               class="px-3 py-1.5 rounded-lg text-xs font-bold transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-800 hover:bg-slate-200' }}">
                                Admin Dashboard
                            </a>
                            <a href="{{ route('admin.officers.index') }}" 
                               class="px-3 py-1.5 rounded-lg text-xs font-bold transition-colors {{ request()->routeIs('admin.officers.*') ? 'bg-emerald-700 text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                                District Officers
                            </a>
                            <a href="{{ route('admin.beneficiaries') }}" 
                               class="px-3 py-1.5 rounded-lg text-xs font-bold transition-colors {{ request()->routeIs('admin.beneficiaries') ? 'bg-emerald-700 text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                                Submitted Forms
                            </a>
                        @elseif(auth()->user()->isDistrictOfficer())
                            <div class="h-6 w-px bg-slate-200 mx-1"></div>
                            <a href="{{ route('officer.dashboard') }}" 
                               class="px-3 py-1.5 rounded-lg text-xs font-bold transition-colors {{ request()->routeIs('officer.dashboard') ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-800 hover:bg-slate-200' }}">
                                Officer Panel ({{ auth()->user()->district }})
                            </a>
                            <a href="{{ route('officer.beneficiaries') }}" 
                               class="px-3 py-1.5 rounded-lg text-xs font-bold transition-colors {{ request()->routeIs('officer.beneficiaries') ? 'bg-emerald-700 text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                                District Forms
                            </a>
                        @endif
                    @endauth
                    
                    <div class="h-6 w-px bg-slate-200 mx-1"></div>

                    <a href="{{ route('beneficiaries.create') }}" 
                       id="nav-register-btn"
                       class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white text-xs font-bold shadow-xs hover:shadow transition-all duration-200">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>New Enrollment</span>
                    </a>

                    @auth
                        <div class="flex items-center gap-2 pl-2">
                            <div class="text-right hidden lg:block">
                                <span class="block text-xs font-bold text-slate-900 leading-tight">{{ auth()->user()->name }}</span>
                                <span class="text-[10px] font-semibold text-emerald-700">
                                    {{ auth()->user()->isAdmin() ? 'Super Admin' : 'DLO (' . auth()->user()->district . ')' }}
                                </span>
                            </div>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        title="Log Out"
                                        class="p-2 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 border border-slate-200 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" 
                           class="inline-flex items-center gap-1.5 px-3 py-2 rounded-xl border border-slate-300 hover:border-slate-400 text-slate-700 text-xs font-bold hover:bg-slate-50 transition-colors">
                            <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Officer Login</span>
                        </a>
                    @endauth
                </nav>

                <!-- Mobile Menu Actions -->
                <div class="md:hidden flex items-center gap-2">
                    @auth
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="p-2 rounded-lg bg-rose-50 text-rose-700 text-xs font-bold">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-3 py-1.5 rounded-lg bg-slate-900 text-white text-xs font-bold">
                            Login
                        </a>
                    @endauth
                    <a href="{{ route('beneficiaries.create') }}" class="p-2 rounded-lg bg-emerald-600 text-white shadow">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </a>
                </div>

            </div>
        </div>
    </header>

    <!-- Global Notifications / Flash Messages -->
    <div class="no-print max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        @if (session('success'))
            <div id="flash-success" class="flex items-start gap-3 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 shadow-sm animate-fadeIn">
                <div class="w-8 h-8 rounded-full bg-emerald-600 text-white flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-sm text-emerald-900">Application Registered Successfully!</h4>
                    <p class="text-sm text-emerald-700 mt-0.5">{{ session('success') }}</p>
                </div>
                <button type="button" onclick="document.getElementById('flash-success').remove()" class="text-emerald-500 hover:text-emerald-700 p-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div id="flash-error" class="flex items-start gap-3 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 shadow-sm">
                <div class="w-8 h-8 rounded-full bg-rose-600 text-white flex items-center justify-center shrink-0 mt-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-bold text-sm text-rose-900">Please review the following errors:</h4>
                    <ul class="list-disc list-inside text-xs text-rose-700 mt-1 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" onclick="document.getElementById('flash-error').remove()" class="text-rose-500 hover:text-rose-700 p-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @endif
    </div>

    <!-- Main Content Slot -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="no-print bg-slate-900 text-slate-400 mt-16 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('favicon.svg') }}" alt="BPBMS Emblem" class="w-11 h-11 rounded-xl shadow-md shadow-emerald-950/40">
                        <div>
                            <span class="text-white font-bold text-lg">BPBMS • Khyber Pakhtunkhwa</span>
                            <p class="text-xs text-slate-400">Backyard Poultry Beneficiary Management System</p>
                        </div>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed max-w-lg mb-4">
                        A flagship initiative for food security, poverty alleviation, and rural women empowerment through the distribution of high-yield backyard poultry units (12 birds per family) across all districts of Khyber Pakhtunkhwa.
                    </p>
                    <div class="flex items-center gap-2 text-xs font-semibold text-emerald-400">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span>Female Beneficiary Priority Program</span>
                    </div>
                </div>

                <div>
                    <h5 class="text-white font-bold text-sm tracking-wide uppercase mb-3">Quick Navigation</h5>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-emerald-400 transition-colors">Home Portal</a></li>
                        <li><a href="{{ route('beneficiaries.create') }}" class="hover:text-emerald-400 transition-colors">Beneficiary Application Form</a></li>
                        <li><a href="{{ route('beneficiaries.index') }}" class="hover:text-emerald-400 transition-colors">Beneficiary Roster & Directory</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="text-white font-bold text-sm tracking-wide uppercase mb-3">Program Office</h5>
                    <p class="text-sm text-slate-400 leading-relaxed mb-2">
                        Directorate General (Extension)<br>
                        Livestock & Dairy Development Department<br>
                        Peshawar, Khyber Pakhtunkhwa
                    </p>
                    <p class="text-xs text-amber-400 font-semibold mt-3">
                        Entitlement: 1 Unit = 12 Birds (1 Family)
                    </p>
                </div>

            </div>

            <div class="pt-8 border-t border-slate-800 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-500 gap-4">
                <p>&copy; {{ date('Y') }} Government of Khyber Pakhtunkhwa. All rights reserved.</p>
                <p>Designed with SOLID Architecture in Laravel</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
