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
        Schema::table('withdrawals', function (Blueprint $table) {
            if (! Schema::hasColumn('withdrawals', 'source_wallet')) {
                $table->string('source_wallet')->default('usdt_main')->after('method');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('withdrawals', function (Blueprint $table) {
            if (Schema::hasColumn('withdrawals', 'source_wallet')) {
                $table->dropColumn('source_wallet');
            }
        });
    }
};
