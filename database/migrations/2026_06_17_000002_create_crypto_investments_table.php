<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('crypto_investments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('crypto_plan_id')->constrained('crypto_plans')->cascadeOnDelete();
            $table->decimal('amount', 15, 2);
            $table->string('term');
            $table->decimal('profit_rate', 8, 2)->default(0);
            $table->decimal('current_profit', 15, 2)->default(0);
            $table->decimal('current_balance', 15, 2)->default(0);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('status')->default('Running');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('crypto_investments');
    }
};
