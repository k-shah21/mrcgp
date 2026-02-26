<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckEligibilityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'passportNumber' => 'required|string|max:255',
            'candidateType'  => 'required|in:new,old',
        ];

        if ($this->input('candidateType') === 'new') {
            $rules['email']          = 'required|email:rfc,dns|max:255';
            $rules['usualForename']  = 'required|string|max:255';
            $rules['lastName']       = 'required|string|max:255';
        }

        if ($this->input('candidateType') === 'old') {
            $rules['candidateId'] = 'required|string|size:7';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'passportNumber.required' => 'Passport Number is required.',
            'candidateType.required'  => 'Candidate type must be selected.',
            'candidateType.in'        => 'Invalid candidate type.',
            'email.required'          => 'Email is required.',
            'email.email'             => 'Please enter a valid email address.',
            'usualForename.required'  => 'Usual Forename is required.',
            'lastName.required'       => 'Last Name is required.',
            'candidateId.required'    => 'Candidate ID is required.',
            'candidateId.size'        => 'Candidate ID must be exactly 7 characters.',
        ];
    }
}
