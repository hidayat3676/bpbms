<?php

namespace Tests\Feature;

use App\Models\Beneficiary;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAndOfficerTest extends TestCase
{
    use DatabaseTransactions;

    protected User $admin;
    protected User $officerPeshawar;
    protected User $officerSwabi;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::firstOrCreate(
            ['email' => 'test.admin@bpbms.kp.gov.pk'],
            [
                'name' => 'Admin Test User',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'district' => null,
            ]
        );

        $this->officerPeshawar = User::firstOrCreate(
            ['email' => 'test.dlo.peshawar@bpbms.kp.gov.pk'],
            [
                'name' => 'DLO Peshawar User',
                'password' => Hash::make('password'),
                'role' => 'district_officer',
                'district' => 'Peshawar',
                'designation' => 'District Livestock Officer',
            ]
        );

        $this->officerSwabi = User::firstOrCreate(
            ['email' => 'test.dlo.swabi@bpbms.kp.gov.pk'],
            [
                'name' => 'DLO Swabi User',
                'password' => Hash::make('password'),
                'role' => 'district_officer',
                'district' => 'Swabi',
                'designation' => 'District Livestock Officer',
            ]
        );
    }

    public function test_guest_is_redirected_to_login_when_accessing_admin_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('login'));
    }

    public function test_district_officer_cannot_access_admin_dashboard(): void
    {
        $response = $this->actingAs($this->officerPeshawar)->get(route('admin.dashboard'));

        $response->assertRedirect(route('officer.dashboard'));
    }

    public function test_admin_can_access_admin_dashboard_with_counts(): void
    {
        // Seed a sample beneficiary in Peshawar and one in Swabi
        Beneficiary::create([
            'application_no' => 'BPBMS-2026-ADM-001',
            'beneficiary_name' => 'Shazia Bibi',
            'gender' => 'female',
            'wife_or_widow_of' => 'Naveed Khan',
            'cnic_no' => '17301-4433221-2',
            'district' => 'Peshawar',
            'tehsil' => 'Mathra',
            'village' => 'Mathra Khel',
            'address' => 'Near VC Office',
            'contact_no' => '03011223344',
            'one_unit_given' => true,
            'vulnerabilities' => ['widow'],
            'is_widow' => true,
            'amount_received_per_unit' => 1050.00,
        ]);

        $response = $this->actingAs($this->admin)->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('BPBMS Central Executive Dashboard');
        $response->assertSee('Forms Submitted');
        $response->assertSee('Units Issued');
        $response->assertSee('Peshawar');
        $response->assertSee('+ Create District Officer');
    }

    public function test_admin_can_view_district_officers_list(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.officers.index'));

        $response->assertStatus(200);
        $response->assertSee('Khyber Pakhtunkhwa District Officers');
        $response->assertSee('DLO Peshawar User');
        $response->assertSee('Peshawar');
    }

    public function test_admin_can_create_new_district_officer(): void
    {
        $payload = [
            'name' => 'Dr. Haroon Rasheed',
            'email' => 'dlo.mardan.new@bpbms.kp.gov.pk',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
            'district' => 'Mardan',
            'designation' => 'Senior District Livestock Officer',
            'phone' => '03339988776',
        ];

        $response = $this->actingAs($this->admin)->post(route('admin.officers.store'), $payload);

        $response->assertRedirect(route('admin.officers.index'));
        $this->assertDatabaseHas('users', [
            'email' => 'dlo.mardan.new@bpbms.kp.gov.pk',
            'role' => 'district_officer',
            'district' => 'Mardan',
        ]);
    }

    public function test_district_officer_can_view_their_district_dashboard(): void
    {
        // Beneficiary in Peshawar
        Beneficiary::create([
            'application_no' => 'BPBMS-2026-PSH-999',
            'beneficiary_name' => 'Kalsoom Bibi',
            'gender' => 'female',
            'wife_or_widow_of' => 'Kamran Ali',
            'cnic_no' => '17301-5544332-4',
            'district' => 'Peshawar',
            'tehsil' => 'Peshawar City',
            'village' => 'Sikandar Pura',
            'address' => 'House 9, Street 2',
            'contact_no' => '03009988112',
            'one_unit_given' => true,
            'vulnerabilities' => ['headed'],
            'is_headed' => true,
            'amount_received_per_unit' => 1050.00,
        ]);

        $response = $this->actingAs($this->officerPeshawar)->get(route('officer.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Peshawar District BPBMS Panel');
        $response->assertSee('Tehsil-wise Summary in Peshawar');
        $response->assertSee('Peshawar City');
        $response->assertSee('Kalsoom Bibi');
    }

    public function test_district_officer_can_only_see_their_district_forms(): void
    {
        // Beneficiary in Peshawar
        Beneficiary::create([
            'application_no' => 'BPBMS-2026-PSH-UNIQUE',
            'beneficiary_name' => 'Peshawar Resident Bibi',
            'gender' => 'female',
            'wife_or_widow_of' => 'Amjad Khan',
            'cnic_no' => '17301-8877665-2',
            'district' => 'Peshawar',
            'tehsil' => 'Mathra',
            'village' => 'Mathra Main',
            'address' => 'Mathra Peshawar',
            'contact_no' => '03001122998',
            'one_unit_given' => true,
            'vulnerabilities' => ['poor'],
            'is_poor' => true,
            'amount_received_per_unit' => 1050.00,
        ]);

        // Beneficiary in Swabi
        Beneficiary::create([
            'application_no' => 'BPBMS-2026-SWB-UNIQUE',
            'beneficiary_name' => 'Swabi Resident Bibi',
            'gender' => 'female',
            'wife_or_widow_of' => 'Sher Afzal',
            'cnic_no' => '16202-9911223-4',
            'district' => 'Swabi',
            'tehsil' => 'Topi',
            'village' => 'Topi Main',
            'address' => 'Topi Swabi',
            'contact_no' => '03138877665',
            'one_unit_given' => true,
            'vulnerabilities' => ['widow'],
            'is_widow' => true,
            'amount_received_per_unit' => 1050.00,
        ]);

        // Peshawar officer sees Peshawar beneficiary and NOT Swabi beneficiary
        $responsePeshawar = $this->actingAs($this->officerPeshawar)->get(route('officer.beneficiaries'));
        $responsePeshawar->assertStatus(200);
        $responsePeshawar->assertSee('Peshawar Resident Bibi');
        $responsePeshawar->assertDontSee('Swabi Resident Bibi');

        // Swabi officer sees Swabi beneficiary and NOT Peshawar beneficiary
        $responseSwabi = $this->actingAs($this->officerSwabi)->get(route('officer.beneficiaries'));
        $responseSwabi->assertStatus(200);
        $responseSwabi->assertSee('Swabi Resident Bibi');
        $responseSwabi->assertDontSee('Peshawar Resident Bibi');
    }

    public function test_user_can_login_and_logout_successfully(): void
    {
        // Login as admin
        $response = $this->post(route('login.post'), [
            'email' => $this->admin->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($this->admin);

        // Logout
        $logoutResponse = $this->post(route('logout'));
        $logoutResponse->assertRedirect(route('login'));
        $this->assertGuest();
    }
}
