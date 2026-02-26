<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            if (!Schema::hasColumn('applications', 'status')) {
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('termsAccepted');
            }
            if (!Schema::hasColumn('applications', 'admin_message')) {
                $table->text('admin_message')->nullable()->after('status');
            }
            if (!Schema::hasColumn('applications', 'fullName')) {
                // fullName may already exist from original migration
            }
        });

        // Add unique index on email if not already unique
        // (The original migration does not have unique on email)
        try {
            Schema::table('applications', function (Blueprint $table) {
                $table->unique('email', 'applications_email_unique');
            });
        } catch (\Exception $e) {
            // Index may already exist
        }
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn(['status', 'admin_message']);
        });
    }
};
