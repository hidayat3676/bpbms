<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="bg-slate-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thermal Print Slip (80mm) - {{ $beneficiary->application_no }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Thermal 80mm Printer Specification */
        @page {
            size: 80mm auto;
            margin: 0;
        }

        @media print {
            body {
                background: #fff !important;
                color: #000 !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .no-print {
                display: none !important;
            }
            .thermal-slip {
                width: 78mm !important;
                max-width: 78mm !important;
                margin: 0 !important;
                padding: 3mm 2mm !important;
                box-shadow: none !important;
                border: none !important;
                border-radius: 0 !important;
            }
        }

        .thermal-slip {
            width: 80mm;
            max-width: 80mm;
            font-family: 'Courier New', Courier, monospace;
            background: #ffffff;
            color: #000000;
            line-height: 1.25;
            letter-spacing: -0.2px;
        }

        .dashed-line {
            border-bottom: 1px dashed #000;
            margin: 6px 0;
        }

        .double-line {
            border-bottom: 2px solid #000;
            margin: 6px 0;
        }
    </style>
</head>
<body class="min-h-screen py-8 px-2 flex flex-col items-center justify-start text-slate-800">

    <!-- Action Toolbar (Hidden during print) -->
    <div class="no-print w-full max-w-md mb-6 flex flex-wrap items-center justify-between gap-3 bg-white p-4 rounded-2xl shadow-sm border border-slate-200">
        <div class="flex items-center gap-2">
            <a href="{{ route('beneficiaries.show', $beneficiary) }}" class="p-2 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold transition-colors">
                &larr; Standard Slip
            </a>
            <span class="text-xs font-bold text-slate-500">80mm POS Thermal Slip</span>
        </div>

        <div class="flex items-center gap-2">
            <button type="button" 
                    onclick="window.print()" 
                    id="btn-thermal-print"
                    class="inline-flex items-center gap-1.5 px-4 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs shadow-md transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                <span>Print Thermal Slip</span>
            </button>
        </div>
    </div>

    <!-- 80mm POS Thermal Slip Container -->
    <div class="thermal-slip p-4 rounded-xl shadow-xl border border-slate-300">
        
        <!-- Header -->
        <div class="text-center font-bold">
            <div class="text-[14px] uppercase tracking-wider leading-tight">GOVT OF KHYBER PAKHTUNKHWA</div>
            <div class="text-[11px] uppercase mt-0.5">LIVESTOCK & DAIRY DEV DEPT</div>
            <div class="text-[12px] uppercase font-black mt-1">BACKYARD POULTRY SCHEME</div>
            <div class="text-[10px] tracking-widest uppercase text-slate-600">BPBMS FIELD TOKEN & RECEIPT</div>
        </div>

        <div class="double-line"></div>

        <!-- Meta -->
        <div class="text-[11px] font-semibold flex justify-between">
            <span>TOKEN: {{ $beneficiary->application_no }}</span>
        </div>
        <div class="text-[10px] flex justify-between text-slate-700 mt-0.5">
            <span>DATE: {{ $beneficiary->created_at->format('d-M-Y h:i A') }}</span>
            <span>VERIFIED</span>
        </div>

        <div class="dashed-line"></div>

        <!-- Beneficiary Particulars -->
        <div class="text-[11px] space-y-1">
            <div class="font-bold uppercase text-[10px] tracking-wider text-slate-600">BENEFICIARY DETAILS:</div>
            
            <div class="flex justify-between items-start">
                <span class="font-bold">NAME:</span>
                <span class="text-right font-black uppercase">{{ $beneficiary->beneficiary_name }} (F)</span>
            </div>

            <div class="flex justify-between items-start">
                <span class="font-bold">W/W OF:</span>
                <span class="text-right">{{ $beneficiary->wife_or_widow_of }}</span>
            </div>

            <div class="flex justify-between items-start">
                <span class="font-bold">CNIC:</span>
                <span class="text-right font-bold">{{ $beneficiary->cnic_no }}</span>
            </div>

            <div class="flex justify-between items-start">
                <span class="font-bold">CELL:</span>
                <span class="text-right">{{ $beneficiary->contact_no }}</span>
            </div>
        </div>

        <div class="dashed-line"></div>

        <!-- Location -->
        <div class="text-[11px] space-y-1">
            <div class="font-bold uppercase text-[10px] tracking-wider text-slate-600">DISTRIBUTION LOCATION:</div>

            <div class="flex justify-between items-start">
                <span class="font-bold">DISTRICT:</span>
                <span class="text-right font-bold uppercase">{{ $beneficiary->district }}</span>
            </div>

            <div class="flex justify-between items-start">
                <span class="font-bold">TEHSIL:</span>
                <span class="text-right">{{ $beneficiary->tehsil }}</span>
            </div>

            <div class="flex justify-between items-start">
                <span class="font-bold">VILLAGE:</span>
                <span class="text-right">{{ $beneficiary->village }}</span>
            </div>
        </div>

        <div class="dashed-line"></div>

        <!-- Allocation Package -->
        <div class="text-[11px] space-y-1">
            <div class="font-bold uppercase text-[10px] tracking-wider text-slate-600">ALLOCATION DETAILS:</div>

            <div class="flex justify-between items-start font-bold">
                <span>PACKAGE:</span>
                <span>1 UNIT (12 BIRDS)</span>
            </div>

            <div class="text-[10px] text-slate-800 flex justify-between">
                <span>Composition:</span>
                <span>10 Pullets + 2 Cockerels</span>
            </div>

            <div class="text-[10px] text-slate-800 flex justify-between">
                <span>Vaccination:</span>
                <span>ND, IBD & Fowl Pox</span>
            </div>

            <div class="flex justify-between items-start font-black text-[12px] pt-1">
                <span>RECOVERY PAID:</span>
                <span>PKR {{ number_format($beneficiary->amount_received_per_unit) }}</span>
            </div>
        </div>

        <div class="dashed-line"></div>

        <!-- Vulnerability Tick Marks -->
        <div class="text-[10px] space-y-0.5">
            <div class="font-bold uppercase tracking-wider text-slate-600 mb-1">VULNERABILITY CATEGORY:</div>
            <div class="grid grid-cols-2 gap-x-2">
                <div>[{{ $beneficiary->is_headed ? 'X' : ' ' }}] HEADED (F)</div>
                <div>[{{ $beneficiary->is_widow ? 'X' : ' ' }}] WIDOW</div>
                <div>[{{ $beneficiary->is_homeless ? 'X' : ' ' }}] HOMELESS</div>
                <div>[{{ $beneficiary->is_poor ? 'X' : ' ' }}] ULTRA-POOR</div>
            </div>
        </div>

        <div class="dashed-line"></div>

        <!-- Barcode Simulation -->
        <div class="text-center py-2">
            <svg class="w-full h-10 mx-auto" viewBox="0 0 200 40" preserveAspectRatio="none">
                <!-- Barcode bars simulation -->
                <rect x="5" width="3" height="35" fill="black"/>
                <rect x="10" width="2" height="35" fill="black"/>
                <rect x="15" width="4" height="35" fill="black"/>
                <rect x="22" width="2" height="35" fill="black"/>
                <rect x="26" width="3" height="35" fill="black"/>
                <rect x="32" width="1" height="35" fill="black"/>
                <rect x="35" width="5" height="35" fill="black"/>
                <rect x="43" width="2" height="35" fill="black"/>
                <rect x="48" width="3" height="35" fill="black"/>
                <rect x="54" width="2" height="35" fill="black"/>
                <rect x="58" width="4" height="35" fill="black"/>
                <rect x="65" width="1" height="35" fill="black"/>
                <rect x="68" width="3" height="35" fill="black"/>
                <rect x="74" width="2" height="35" fill="black"/>
                <rect x="78" width="4" height="35" fill="black"/>
                <rect x="85" width="3" height="35" fill="black"/>
                <rect x="91" width="1" height="35" fill="black"/>
                <rect x="94" width="4" height="35" fill="black"/>
                <rect x="101" width="2" height="35" fill="black"/>
                <rect x="105" width="3" height="35" fill="black"/>
                <rect x="111" width="5" height="35" fill="black"/>
                <rect x="119" width="2" height="35" fill="black"/>
                <rect x="123" width="3" height="35" fill="black"/>
                <rect x="129" width="1" height="35" fill="black"/>
                <rect x="133" width="4" height="35" fill="black"/>
                <rect x="140" width="2" height="35" fill="black"/>
                <rect x="144" width="3" height="35" fill="black"/>
                <rect x="150" width="2" height="35" fill="black"/>
                <rect x="154" width="4" height="35" fill="black"/>
                <rect x="161" width="3" height="35" fill="black"/>
                <rect x="167" width="2" height="35" fill="black"/>
                <rect x="171" width="4" height="35" fill="black"/>
                <rect x="178" width="1" height="35" fill="black"/>
                <rect x="182" width="3" height="35" fill="black"/>
                <rect x="188" width="2" height="35" fill="black"/>
                <rect x="192" width="4" height="35" fill="black"/>
            </svg>
            <div class="text-[10px] font-mono font-bold tracking-wider mt-1">{{ $beneficiary->application_no }}</div>
        </div>

        <!-- Verification Signatures -->
        <div class="pt-4 space-y-6 text-[10px]">
            <div>
                <div class="flex justify-between items-end">
                    <span>Beneficiary Thumb:</span>
                    <span class="border-b border-black w-24 inline-block"></span>
                </div>
            </div>

            <div>
                <div class="flex justify-between items-end">
                    <span>Officer Stamp/Sign:</span>
                    <span class="border-b border-black w-24 inline-block"></span>
                </div>
            </div>
        </div>

        <div class="double-line"></div>

        <!-- Footer Instructions -->
        <div class="text-center text-[9px] font-bold space-y-0.5">
            <div>* NON-TRANSFERABLE TO OTHERS *</div>
            <div>* STRICTLY 1 UNIT PER HOUSEHOLD *</div>
            <div>* KEEP SLIP FOR FOLLOW-UP & CARE *</div>
            <div class="text-[8px] text-slate-600 mt-1">DIRECTORATE GENERAL (EXTENSION) PESHAWAR</div>
        </div>

    </div>

</body>
</html>
