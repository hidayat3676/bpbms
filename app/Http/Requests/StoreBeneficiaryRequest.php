<?php

namespace App\Http\Requests;

use App\Services\KpLocationService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreBeneficiaryRequest
 *
 * Single Responsibility: Validating beneficiary registration input.
 */
class StoreBeneficiaryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Auto-format CNIC if given without dashes
        if ($this->has('cnic_no')) {
            $digits = preg_replace('/[^0-9]/', '', (string)$this->input('cnic_no'));
            if (strlen($digits) === 13) {
                $this->merge([
                    'cnic_no' => substr($digits, 0, 5) . '-' . substr($digits, 5, 7) . '-' . substr($digits, 12, 1)
                ]);
            }
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /** @var KpLocationService $locationService */
        $locationService = app(KpLocationService::class);
        $validDistricts = $locationService->getDistricts();

        return [
            'application_no' => ['nullable', 'string', 'max:50', 'unique:beneficiaries,application_no'],
            'beneficiary_name' => ['required', 'string', 'min:3', 'max:120'],
            'is_female_confirmed' => ['accepted'],
            'wife_or_widow_of' => ['required', 'string', 'min:3', 'max:120'],
            'cnic_no' => [
                'required',
                'string',
                'regex:/^\d{5}-\d{7}-\d{1}$/',
                'unique:beneficiaries,cnic_no',
            ],
            'district' => ['required', 'string', Rule::in($validDistricts)],
            'tehsil' => ['required', 'string', 'max:100'],
            'village' => ['required', 'string', 'min:2', 'max:150'],
            'address' => ['required', 'string', 'min:5', 'max:500'],
            'contact_no' => [
                'required',
                'string',
                'regex:/^((\+92)|(0092)|(03))([0-9]{9})$/',
            ],
            'one_unit_given' => ['required', 'accepted'],
            'vulnerabilities' => ['required', 'array', 'min:1'],
            'vulnerabilities.*' => ['in:headed,widow,homeless,poor'],
            'amount_received_per_unit' => ['required', 'numeric', 'min:0', 'max:100000'],
            'remarks' => ['nullable', 'string', 'max:1000'],
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'beneficiary_name.required' => 'The Beneficiary Name is mandatory.',
            'is_female_confirmed.accepted' => 'This program is female-only. Please confirm the beneficiary is female.',
            'wife_or_widow_of.required' => 'Please specify Wife/Widow of (Spouse or Guardian name).',
            'cnic_no.required' => 'CNIC Number of the Beneficiary is required.',
            'cnic_no.regex' => 'The CNIC format must be valid (e.g. 17301-1234567-2).',
            'cnic_no.unique' => 'A beneficiary with this CNIC has already received a unit under BPBMS.',
            'district.required' => 'Please select a KP District from the dropdown.',
            'district.in' => 'Selected district is not a valid Khyber Pakhtunkhwa district.',
            'tehsil.required' => 'Please select or enter the Tehsil.',
            'village.required' => 'Village / Mohallah name is required.',
            'address.required' => 'Detailed physical address is required for monitoring and verification.',
            'contact_no.required' => 'Contact mobile number is required.',
            'contact_no.regex' => 'Contact number must be a valid Pakistani mobile number (e.g. 03001234567).',
            'one_unit_given.accepted' => 'You must check the confirmation that One unit (12 birds) is given to one family.',
            'vulnerabilities.required' => 'Please select at least one tick mark criteria (Headed, Widow, Homeless, or Poor).',
            'amount_received_per_unit.required' => 'Please enter the amount received per unit (PKR).',
        ];
    }
}
