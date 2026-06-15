<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up()
{
    Schema::table('users', function (Blueprint $table) {
        // Only add columns if they don't already exist
        if (!Schema::hasColumn('users', 'uid')) {
            $table->string('uid')->unique()->nullable();
        }
        if (!Schema::hasColumn('users', 'phone')) {
            $table->string('phone')->nullable();
        }
        if (!Schema::hasColumn('users', 'country')) {
            $table->string('country')->nullable();
        }
        if (!Schema::hasColumn('users', 'balance')) {
            $table->decimal('balance', 15, 2)->default(0.00);
        }
        if (!Schema::hasColumn('users', 'crypto_balance')) {
            $table->string('crypto_balance')->nullable();
        }
        if (!Schema::hasColumn('users', 'ai_bot')) {
            $table->string('ai_bot')->default('None Active');
        }
        if (!Schema::hasColumn('users', 'kyc_status')) {
            $table->string('kyc_status')->default('Unsubmitted');
        }
        if (!Schema::hasColumn('users', 'is_admin')) {
            $table->boolean('is_admin')->default(false);
        }
        if (!Schema::hasColumn('users', 'is_bot_active')) {
            $table->boolean('is_bot_active')->default(false);
        }
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
