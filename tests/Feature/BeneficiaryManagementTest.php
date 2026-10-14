<?php

namespace Tests\Feature;

use App\Models\Beneficiary;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class BeneficiaryManagementTest extends TestCase
{
    use DatabaseTransactions;

    public function test_home_page_renders_successfully(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('Backyard Poultry Beneficiary Management System');
        $response->assertSee('BPBMS');
        $response->assertSee('One Unit (12 Birds)');
    }

    public function test_registration_form_renders_with_required_fields_and_kp_districts(): void
    {
        $response = $this->get(route('beneficiaries.create'));

        $response->assertStatus(200);
        $response->assertSee('Beneficiary Enrollment');
        $response->assertSee('Unit Issuance Form');
        $response->assertSee('Application / Farm No.');
        $response->assertSee('Beneficiary Name');
        $response->assertSee('Wife / Widow of');
        $response->assertSee('CNIC No of Beneficiary');
        $response->assertSee('Peshawar');
        $response->assertSee('One unit (12 birds) given to one family');
        $response->assertSee('Headed');
        $response->assertSee('Widow');
        $response->assertSee('Homeless');
        $response->assertSee('Poor');
        $response->assertSee('Amount Received Per Unit');
    }

    public function test_can_register_new_beneficiary_successfully(): void
    {
        $payload = [
            'application_no' => 'BPBMS-2026-TEST-0001',
            'beneficiary_name' => 'Fatima Bibi',
            'is_female_confirmed' => '1',
            'wife_or_widow_of' => 'Late Muhammad Khan',
            'cnic_no' => '17301-7654321-2',
            'district' => 'Peshawar',
            'tehsil' => 'Peshawar City',
            'village' => 'Village Landi Arbab',
            'address' => 'House No. 12, Mohallah Khel, Near High School',
            'contact_no' => '03001234567',
            'one_unit_given' => '1',
            'vulnerabilities' => ['headed', 'widow', 'poor'],
            'amount_received_per_unit' => 1050.00,
            'remarks' => 'Batch-1 vaccinated poultry package issued.',
        ];

        $response = $this->post(route('beneficiaries.store'), $payload);

        $beneficiary = Beneficiary::where('application_no', 'BPBMS-2026-TEST-0001')->first();
        $this->assertNotNull($beneficiary);
        $this->assertEquals('Fatima Bibi', $beneficiary->beneficiary_name);
        $this->assertEquals('female', $beneficiary->gender);
        $this->assertTrue($beneficiary->is_headed);
        $this->assertTrue($beneficiary->is_widow);
        $this->assertFalse($beneficiary->is_homeless);
        $this->assertTrue($beneficiary->is_poor);
        $this->assertTrue($beneficiary->one_unit_given);
        $this->assertEquals(1050.00, $beneficiary->amount_received_per_unit);

        $response->assertRedirect(route('beneficiaries.show', $beneficiary));
    }

    public function test_registration_validation_fails_when_required_fields_missing(): void
    {
        $response = $this->post(route('beneficiaries.store'), []);

        $response->assertSessionHasErrors([
            'beneficiary_name',
            'is_female_confirmed',
            'wife_or_widow_of',
            'cnic_no',
            'district',
            'tehsil',
            'village',
            'address',
            'contact_no',
            'one_unit_given',
            'vulnerabilities',
            'amount_received_per_unit',
        ]);
    }

    public function test_beneficiary_index_displays_registered_records(): void
    {
        $beneficiary = Beneficiary::create([
            'application_no' => 'BPBMS-2026-0001-AUTO',
            'beneficiary_name' => 'Bibi Maryam',
            'gender' => 'female',
            'wife_or_widow_of' => 'Abdul Rehman',
            'cnic_no' => '17301-1122334-2',
            'district' => 'Swabi',
            'tehsil' => 'Topi',
            'village' => 'Maini',
            'address' => 'Near Jamia Masjid Maini',
            'contact_no' => '03129876543',
            'one_unit_given' => true,
            'vulnerabilities' => ['widow'],
            'is_widow' => true,
            'amount_received_per_unit' => 1050.00,
        ]);

        $response = $this->get(route('beneficiaries.index'));

        $response->assertStatus(200);
        $response->assertSee('Bibi Maryam');
        $response->assertSee('BPBMS-2026-0001-AUTO');
        $response->assertSee('Swabi');
    }

    public function test_beneficiary_show_page_displays_official_slip(): void
    {
        $beneficiary = Beneficiary::create([
            'application_no' => 'BPBMS-2026-0099-SPEC',
            'beneficiary_name' => 'Zainab Bibi',
            'gender' => 'female',
            'wife_or_widow_of' => 'Gulzar Ahmad',
            'cnic_no' => '17301-9988776-4',
            'district' => 'Nowshera',
            'tehsil' => 'Pabbi',
            'village' => 'Taru Jabba',
            'address' => 'G.T Road Taru Jabba',
            'contact_no' => '03331122334',
            'one_unit_given' => true,
            'vulnerabilities' => ['headed', 'poor'],
            'is_headed' => true,
            'is_poor' => true,
            'amount_received_per_unit' => 1050.00,
        ]);

        $response = $this->get(route('beneficiaries.show', $beneficiary));

        $response->assertStatus(200);
        $response->assertSee('UNIT ALLOCATION SLIP');
        $response->assertSee('BPBMS-2026-0099-SPEC');
        $response->assertSee('Zainab Bibi');
        $response->assertSee('Pabbi, Nowshera');
    }

    public function test_beneficiary_thermal_slip_page_renders_successfully(): void
    {
        $beneficiary = Beneficiary::create([
            'application_no' => 'BPBMS-2026-0088-THRM',
            'beneficiary_name' => 'Kalsoom Begum',
            'gender' => 'female',
            'wife_or_widow_of' => 'Late Jahangir Khan',
            'cnic_no' => '17301-3322114-6',
            'district' => 'Peshawar',
            'tehsil' => 'Peshawar City',
            'village' => 'Gulbahar No. 2',
            'address' => 'Street 7, Near Dispensary',
            'contact_no' => '03009988776',
            'one_unit_given' => true,
            'vulnerabilities' => ['widow', 'poor'],
            'is_widow' => true,
            'is_poor' => true,
            'amount_received_per_unit' => 1050.00,
        ]);

        $response = $this->get(route('beneficiaries.thermal', $beneficiary));

        $response->assertStatus(200);
        $response->assertSee('BPBMS-2026-0088-THRM');
        $response->assertSee('Kalsoom Begum');
        $response->assertSee('1 UNIT (12 BIRDS)');
        $response->assertSee('80mm POS Thermal Slip');
    }
}
