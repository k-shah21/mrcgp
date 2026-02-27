<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Application;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['pending', 'approved', 'rejected']);
        $candidateType = $this->faker->randomElement(['new', 'old']);
        $createdAt = $this->faker->dateTimeBetween('-1 year', 'now');

        $firstName = $this->faker->firstName();
        $lastName = $this->faker->lastName();
        $fullName = $firstName . ' ' . $lastName;

        return [
            'email' => $this->faker->unique()->safeEmail(),
            'passportNumber' => strtoupper($this->faker->bothify('?########')),
            'candidateType' => $candidateType,
            'usualForename' => $firstName,
            'lastName' => $lastName,
            'fullName' => $fullName,
            'candidateId' => $candidateType === 'old' ? $this->faker->numerify('#####') : null,
            'poBox' => $this->faker->postcode(),
            'district' => $this->faker->citySuffix(),
            'city' => $this->faker->city(),
            'province' => $this->faker->state(),
            'country' => $this->faker->country(),
            'whatsappNumber' => $this->faker->e164PhoneNumber(),
            'emergencyContactNumber' => $this->faker->e164PhoneNumber(),
            'previousAttempts' => $this->faker->numberBetween(0, 3),
            'schoolName' => $this->faker->company() . ' Medical College',
            'schoolLocation' => $this->faker->country(),
            'qualificationYear' => $this->faker->year(),
            'countryOfExperience' => $this->faker->country(),
            'countryOfOrigin' => $this->faker->country(),
            'registrationAuthority' => 'National Medical Council',
            'registrationNumber' => $this->faker->numerify('MC-#######'),
            'registrationDate' => $this->faker->dateTimeBetween('-10 years', '-1 year'),
            'eligibilityCriterion' => $this->faker->randomElement(['Registered Medical Practitioner', 'Passed Initial Exam']),
            'examCenterPreference' => $this->faker->city(),
            'termsAccepted' => true,
            'status' => $status,
            'rejection_reason' => $status === 'rejected' ? 'Application incomplete or invalid documents.' : null,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
