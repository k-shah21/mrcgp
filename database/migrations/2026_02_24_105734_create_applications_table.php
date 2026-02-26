<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('fullName');
            $table->string('passportImagePath')->nullable();
            $table->string('usualForename');
            $table->string('lastName');
            $table->string('candidateId')->nullable();
            $table->string('poBox');
            $table->string('district');
            $table->string('city');
            $table->string('province');
            $table->string('country');
            $table->string('whatsappNumber');
            $table->string('emergencyContactNumber');
            $table->string('previousAttempts');
            $table->string('schoolName');
            $table->string('schoolLocation');
            $table->string('qualificationYear');
            $table->string('countryOfExperience');
            $table->string('countryOfOrigin');
            $table->string('registrationAuthority');
            $table->string('registrationNumber');
            $table->date('registrationDate');
            $table->string('eligibilityCriterion');
            $table->string('examCenterPreference');
            $table->boolean('termsAccepted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
