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
            $rules['candidateId'] = 'required|string|size:7';
            $rules['eligibilityCriterion'] = 'nullable|string';
            $rules['email']                = 'nullable|email:rfc,dns|max:255';
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'This email address is already associated with an existing application. Please check your email for updates or supply a different email.',
            'passportNumber.unique' => 'This passport number is already registered in our system. Only one application per passport is permitted.',
            'candidateId.size' => 'Your Candidate ID must be exactly 7 characters long. Please check your records and try again.',
            'termsAccepted.accepted' => 'You must carefully review and accept the Terms and Conditions before proceeding with the application.',
            'eligibilityCriterion.required' => 'Please select an Eligibility Criterion so we can determine the exact documents required for your application.',
            'eligibilityCriterion.in' => 'The selected Eligibility Criterion is not recognized. Please choose a valid option (A, B, or C).',
            'passportImage.required' => 'A clear Passport Size Photograph is mandatory for your application profile. Please upload a profile image file.',
            'passportImage.image' => 'The uploaded file for the Passport Image must be a valid image format (e.g., jpeg, png, jpg).',
            'passportImage.max' => 'The Passport Image file size must not exceed 5MB. Please compress the image and try again.',
            'passport_bio_page.required' => 'The Bio-data Page of your Passport is required to verify your identity. Please ensure you upload a clear, legible copy.',
            'passport_bio_page.max' => 'The Passport Bio-data Page file size must not exceed 5MB.',
            'valid_license.required' => 'A Valid Medical License document is mandatory. Please provide a copy in jpeg, png, jpg, or pdf format.',
            'valid_license.max' => 'The Medical License file size must not exceed 3MB.',
            'mbbs_degree.required' => 'Your MBBS Degree Certificate is required to confirm your foundational medical qualifications.',
            'training_certificate.required' => 'A valid Training or Diploma certificate is required based on your selected Eligibility Criterion.',
            'internship_certificates.required' => 'Please upload your Internship Certificates. At least one document is required to prove your applied training.',
            'experience_certificates.required' => 'Please upload your Experience Certificates. These are required for your selected Eligibility Criterion.',
            'examCenterPreference.required' => 'You must select a preferred Examination Center to help us schedule your assessment correctly.',
            'whatsappNumber.required' => 'Your WhatsApp Number is required for potential immediate communications.',
            'emergencyContactNumber.required' => 'An Emergency Contact Number is mandatory in case we need to reach someone on your behalf urgently.',
            'poBox.required' => 'Please provide your current P.O. Box or primary address line.',
            'city.required' => 'Please provide the City for your current residence.',
            'country.required' => 'Please provide the Country of your current residence.',
            'schoolName.required' => 'The name of your Medical School is required to verify your educational background.',
            'qualificationYear.numeric' => 'The Qualification Year must be a valid numeric year.',
        ];
    }
}
