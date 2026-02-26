<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreApplicationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'candidateType'       => 'required|in:new,old',
            'passportNumber'      => ['required', 'string', 'max:255', Rule::unique('applications', 'passportNumber')],
            'termsAccepted'       => 'accepted',
            'examCenterPreference'=> 'required|string|max:100',

            // Documents always required
            'passport_bio_page'   => 'required|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'valid_license'       => 'required|file|mimes:jpeg,png,jpg,pdf|max:3072',
        ];

        // New candidate specific rules
        if ($this->input('candidateType') === 'new') {
            $rules['email']                        = ['required', 'email:rfc,dns', 'max:255', Rule::unique('applications', 'email')];
            $rules['usualForename']                = 'required|string|max:255';
            $rules['lastName']                     = 'required|string|max:255';
            $rules['poBox']                        = 'required|string|max:255';
            $rules['district']                     = 'required|string|max:255';
            $rules['city']                         = 'required|string|max:255';
            $rules['province']                     = 'required|string|max:255';
            $rules['country']                      = 'required|string|max:255';
            $rules['whatsappNumber']               = 'required|string|max:50';
            $rules['emergencyContactNumber']       = 'required|string|max:50';
            $rules['previousAttempts']             = 'required|in:0,1,2,3,4,5,5+';
            $rules['schoolName']                   = 'required|string|max:255';
            $rules['schoolLocation']               = 'required|string|max:255';
            $rules['qualificationYear']            = 'required|numeric|min:1977|max:2026';
            $rules['countryOfExperience']          = 'required|string|max:255';
            $rules['countryOfOrigin']              = 'required|string|max:255';
            $rules['registrationAuthority']        = 'required|string|max:255';
            $rules['registrationNumber']           = 'required|string|max:255';
            $rules['registrationDate']             = 'required|date';
            $rules['eligibilityCriterion']         = 'required|string|in:A,B,C';
            $rules['passportImage']                = 'required|image|mimes:jpeg,png,jpg|max:5120';
            $rules['mbbs_degree']                  = 'required|file|mimes:jpeg,png,jpg,pdf|max:5120';
            $rules['internship_certificates']      = 'required|array|min:1';
            $rules['internship_certificates.*']    = 'file|mimes:jpeg,png,jpg,pdf|max:5120';

            // Conditional on eligibility criterion
            $elig = $this->input('eligibilityCriterion');
            if (in_array($elig, ['A', 'B'])) {
                $rules['training_certificate'] = 'required|file|mimes:jpeg,png,jpg,pdf|max:5120';
            }
            if (in_array($elig, ['B', 'C'])) {
                $rules['experience_certificates']   = 'required|array|min:1';
                $rules['experience_certificates.*'] = 'file|mimes:jpeg,png,jpg,pdf|max:5120';
            }
        }

        // Old candidate specific rules
        if ($this->input('candidateType') === 'old') {
            $rules['candidateId']          = 'required|string|size:7|exists:applications,candidateId';
            $rules['eligibilityCriterion'] = 'nullable|string';
            $rules['email']                = 'nullable|email:rfc,dns|max:255';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'email.unique'                      => 'This email address has already been used for an application.',
            'passportNumber.unique'             => 'This passport number has already been used for an application.',
            'candidateId.exists'                => 'Candidate ID not found. Please check your ID.',
            'candidateId.size'                  => 'Candidate ID must be exactly 7 characters.',
            'termsAccepted.accepted'            => 'You must accept the terms and conditions.',
            'eligibilityCriterion.required'     => 'Please select an eligibility criterion.',
            'eligibilityCriterion.in'           => 'Invalid eligibility criterion selected.',
            'passportImage.required'            => 'Passport image is required.',
            'passport_bio_page.required'        => 'Passport bio page is required.',
            'valid_license.required'            => 'Valid license document is required.',
            'mbbs_degree.required'              => 'MBBS degree document is required.',
            'training_certificate.required'     => 'Training/Diploma certificate is required.',
            'internship_certificates.required'  => 'At least one internship certificate is required.',
            'experience_certificates.required'  => 'At least one experience certificate is required.',
            'examCenterPreference.required'     => 'Please select an examination center.',
        ];
    }
}
