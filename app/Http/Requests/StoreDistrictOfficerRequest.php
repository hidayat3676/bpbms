<?php

namespace App\Http\Requests;

use App\Services\KpLocationService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreDistrictOfficerRequest
 *
 * Single Responsibility: Validation for District Officer user creation.
 */
class StoreDistrictOfficerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() && $this->user()->isAdmin();
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
            'name' => ['required', 'string', 'min:3', 'max:120'],
            'email' => ['required', 'string', 'email', 'max:150', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'district' => ['required', 'string', Rule::in($validDistricts)],
            'phone' => ['nullable', 'string', 'max:25'],
            'designation' => ['nullable', 'string', 'max:120'],
        ];
    }

    /**
     * Custom error messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Officer name is required.',
            'email.required' => 'Official email address is required.',
            'email.unique' => 'A user with this email address already exists.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
            'district.required' => 'Please select the assigned Khyber Pakhtunkhwa district.',
            'district.in' => 'Selected district is not a valid KP district.',
        ];
    }
}
