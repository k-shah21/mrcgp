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
            $rules['email']          = 'required|email:rfc|max:255';
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
            'passportNumber.required' => 'Please provide your passport ID as per country government to proceed with the eligibility check.',
            'passportNumber.max' => 'The passport number provided is too long. Please ensure it matches your physical passport exactly.',
            'candidateType.required' => 'Please indicate whether you are a New or Registered Candidate so we can process your request correctly.',
            'candidateType.in' => 'The selected candidate type is unrecognized. Please select a valid candidate option (New or Old).',
            'email.required' => 'An email address is mandatory. We need it to communicate important updates regarding your application.',
            'email.email' => 'The email address format appears to be incorrect. Please provide a structurally valid email (e.g., name@example.com).',
            'email.max' => 'The provided email is too long. Please verify and enter a shorter, valid email address.',
            'usualForename.required' => 'Your Usual Forename is missing. Please provide it exactly as it appears on your official documents.',
            'usualForename.max' => 'The Usual Forename provided exceeds the character limit. Please shorten it to proceed.',
            'lastName.required' => 'Your Last Name is missing. Please provide it exactly as it appears on your official documents.',
            'lastName.max' => 'The Last Name provided exceeds the character limit. Please shorten it to proceed.',
            'candidateId.required' => 'A Candidate ID is required for registered candidates. Please enter your existing ID to continue.',
            'candidateId.string' => 'The Candidate ID provided is in an invalid format. It should be a text string.',
            'candidateId.size' => 'Your Candidate ID must be exactly 7 characters long. Please check your records and enter the correct 7-character ID.',
        ];
    }
}
