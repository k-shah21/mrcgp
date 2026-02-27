<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->foreignId('handled_by_user_id')->nullable()->constrained('users')->nullOnDelete()->after('rejection_reason');
            $table->string('handled_action')->nullable()->after('handled_by_user_id');
            $table->timestamp('handled_at')->nullable()->after('handled_action');
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['handled_by_user_id']);
            $table->dropColumn(['handled_by_user_id', 'handled_action', 'handled_at']);
        });
    }
};
