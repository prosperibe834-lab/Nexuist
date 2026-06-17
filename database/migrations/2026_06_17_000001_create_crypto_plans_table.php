<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('crypto_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tier')->nullable();
            $table->text('description')->nullable();
            $table->decimal('minimum_investment', 15, 2)->default(0);
            $table->decimal('maximum_investment', 15, 2)->default(0);
            $table->decimal('daily_roi', 8, 2)->default(0);
            $table->decimal('monthly_roi', 8, 2)->default(0);
            $table->decimal('yearly_roi', 8, 2)->default(0);
            $table->unsignedInteger('duration_days')->default(30);
            $table->decimal('bonus', 15, 2)->default(0);
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('crypto_plans');
    }
};
