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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'referral_code')) {
                $table->string('referral_code')->unique()->nullable()->after('remember_token');
            }
            if (!Schema::hasColumn('users', 'referred_by')) {
                $table->foreignId('referred_by')->nullable()->constrained('users')->nullOnDelete()->after('referral_code');
            }
            if (!Schema::hasColumn('users', 'referral_earnings')) {
                $table->decimal('referral_earnings', 15, 2)->default(0.00)->after('referred_by');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'referral_earnings')) {
                $table->dropColumn('referral_earnings');
            }
            if (Schema::hasColumn('users', 'referred_by')) {
                $table->dropForeign(['referred_by']);
                $table->dropColumn('referred_by');
            }
            if (Schema::hasColumn('users', 'referral_code')) {
                $table->dropColumn('referral_code');
            }
        });
    }
};
