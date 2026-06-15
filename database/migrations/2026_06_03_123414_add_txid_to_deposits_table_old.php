<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('deposits', 'txid')) {

            Schema::table('deposits', function (Blueprint $table) {

                $table->string('txid')->after('user_id');

            });

        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('deposits', 'txid')) {

            Schema::table('deposits', function (Blueprint $table) {

                $table->dropColumn('txid');

            });

        }
    }
};