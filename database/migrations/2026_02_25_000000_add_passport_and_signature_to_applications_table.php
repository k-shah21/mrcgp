<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            if (!Schema::hasColumn('applications', 'passportNumber')) {
                $table->string('passportNumber')->unique()->nullable()->after('email');
            }
            if (!Schema::hasColumn('applications', 'candidateType')) {
                $table->enum('candidateType', ['new', 'old'])->default('new')->after('passportNumber');
            }
            if (!Schema::hasColumn('applications', 'contactNumber')) {
                $table->string('contactNumber')->nullable()->after('candidateType');
            }
            if (!Schema::hasColumn('applications', 'signature')) {
                $table->text('signature')->nullable()->after('contactNumber');
            }
            if (!Schema::hasColumn('applications', 'bioDataPagePath')) {
                $table->string('bioDataPagePath')->nullable()->after('signature');
            }
            if (!Schema::hasColumn('applications', 'validLicensePagePath')) {
                $table->string('validLicensePagePath')->nullable()->after('bioDataPagePath');
            }
            if (!Schema::hasColumn('applications', 'experienceCertificatePath')) {
                $table->string('experienceCertificatePath')->nullable()->after('validLicensePagePath');
            }
            if (!Schema::hasColumn('applications', 'otherDocumentsPaths')) {
                $table->json('otherDocumentsPaths')->nullable()->after('experienceCertificatePath');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn([
                'passportNumber',
                'candidateType',
                'contactNumber',
                'signature',
                'bioDataPagePath',
                'validLicensePagePath',
                'experienceCertificatePath',
                'otherDocumentsPaths',
            ]);
        });
    }
};
