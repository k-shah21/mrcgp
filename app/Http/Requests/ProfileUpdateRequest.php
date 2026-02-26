<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Your name is required to update your profile.',
            'name.string' => 'The name provided must be a valid text string.',
            'name.max' => 'The name provided is too long. Please shorten it.',
            'email.required' => 'An email address is mandatory for your account.',
            'email.string' => 'The email address must be a valid text string.',
            'email.lowercase' => 'The email address must be in lowercase letters.',
            'email.email' => 'The email address format appears to be incorrect (e.g., name@example.com).',
            'email.max' => 'The email address provided is too long. Please verify and try again.',
            'email.unique' => 'This email address is already associated with another account.',
        ];
    }
}
