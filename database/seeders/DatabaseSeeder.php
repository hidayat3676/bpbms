<?php

namespace Database\Seeders;

use App\Models\Beneficiary;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Central Super Admin
        User::firstOrCreate(
            ['email' => 'admin@bpbms.kp.gov.pk'],
            [
                'name' => 'Dr. Khalid Mehmood (Director General)',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'district' => null,
                'phone' => '091-9210276',
                'designation' => 'Director General (Livestock)',
            ]
        );

        // 2. Create Sample District Officers for KP
        User::firstOrCreate(
            ['email' => 'dlo.peshawar@bpbms.kp.gov.pk'],
            [
                'name' => 'Dr. Tariq Khan (DLO Peshawar)',
                'password' => Hash::make('password'),
                'role' => 'district_officer',
                'district' => 'Peshawar',
                'phone' => '03009876541',
                'designation' => 'District Livestock Officer (DLO)',
            ]
        );

        User::firstOrCreate(
            ['email' => 'dlo.swabi@bpbms.kp.gov.pk'],
            [
                'name' => 'Dr. Asma Bilal (DLO Swabi)',
                'password' => Hash::make('password'),
                'role' => 'district_officer',
                'district' => 'Swabi',
                'phone' => '03135544332',
                'designation' => 'District Livestock Officer (DLO)',
            ]
        );

        User::firstOrCreate(
            ['email' => 'dlo.mardan@bpbms.kp.gov.pk'],
            [
                'name' => 'Dr. Farooq Shah (DLO Mardan)',
                'password' => Hash::make('password'),
                'role' => 'district_officer',
                'district' => 'Mardan',
                'phone' => '03332211445',
                'designation' => 'District Livestock Officer (DLO)',
            ]
        );

        // 3. Seed some initial sample beneficiaries across different KP districts if table is empty
        if (Beneficiary::count() === 0) {
            $sampleBeneficiaries = [
                [
                    'application_no' => 'BPBMS-2026-0001-PSH',
                    'beneficiary_name' => 'Bibi Fatima',
                    'gender' => 'female',
                    'wife_or_widow_of' => 'Late Gul Rehman',
                    'cnic_no' => '17301-1234567-2',
                    'district' => 'Peshawar',
                    'tehsil' => 'Peshawar City',
                    'village' => 'Landi Arbab VC-1',
                    'address' => 'Mohallah Sayedan, House 42',
                    'contact_no' => '03001234567',
                    'one_unit_given' => true,
                    'vulnerabilities' => ['headed', 'widow', 'poor'],
                    'is_headed' => true,
                    'is_widow' => true,
                    'is_homeless' => false,
                    'is_poor' => true,
                    'amount_received_per_unit' => 1050.00,
                    'status' => 'verified',
                    'remarks' => 'Vaccinated 12 birds unit delivered.',
                ],
                [
                    'application_no' => 'BPBMS-2026-0002-PSH',
                    'beneficiary_name' => 'Zubaida Begum',
                    'gender' => 'female',
                    'wife_or_widow_of' => 'Muhammad Younas',
                    'cnic_no' => '17301-7654321-4',
                    'district' => 'Peshawar',
                    'tehsil' => 'Badaber',
                    'village' => 'Sheikhan',
                    'address' => 'Near Canal Bank, Badaber',
                    'contact_no' => '03129876543',
                    'one_unit_given' => true,
                    'vulnerabilities' => ['poor', 'homeless'],
                    'is_headed' => false,
                    'is_widow' => false,
                    'is_homeless' => true,
                    'is_poor' => true,
                    'amount_received_per_unit' => 1050.00,
                    'status' => 'verified',
                    'remarks' => 'Camp distribution phase 1.',
                ],
                [
                    'application_no' => 'BPBMS-2026-0003-SWB',
                    'beneficiary_name' => 'Gul Meena',
                    'gender' => 'female',
                    'wife_or_widow_of' => 'Late Akhtar Ali',
                    'cnic_no' => '16202-3344556-2',
                    'district' => 'Swabi',
                    'tehsil' => 'Topi',
                    'village' => 'Maini',
                    'address' => 'Maini Chowk, Street 5',
                    'contact_no' => '03456789012',
                    'one_unit_given' => true,
                    'vulnerabilities' => ['widow', 'headed'],
                    'is_headed' => true,
                    'is_widow' => true,
                    'is_homeless' => false,
                    'is_poor' => false,
                    'amount_received_per_unit' => 1050.00,
                    'status' => 'verified',
                    'remarks' => 'Point of lay birds allocated.',
                ],
                [
                    'application_no' => 'BPBMS-2026-0004-MRD',
                    'beneficiary_name' => 'Nasreen Bibi',
                    'gender' => 'female',
                    'wife_or_widow_of' => 'Fazal Mehmood',
                    'cnic_no' => '16101-9988776-6',
                    'district' => 'Mardan',
                    'tehsil' => 'Takht Bhai',
                    'village' => 'Jalala',
                    'address' => 'Jalala Camp Road, Ward 2',
                    'contact_no' => '03335566778',
                    'one_unit_given' => true,
                    'vulnerabilities' => ['homeless', 'poor'],
                    'is_headed' => false,
                    'is_widow' => false,
                    'is_homeless' => true,
                    'is_poor' => true,
                    'amount_received_per_unit' => 1050.00,
                    'status' => 'verified',
                    'remarks' => 'Verified through VC Secretary.',
                ],
            ];

            foreach ($sampleBeneficiaries as $data) {
                Beneficiary::create($data);
            }
        }
    }
}
