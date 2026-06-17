<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_investments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('stock_plan_id')->constrained('stock_plans')->cascadeOnDelete();
            $table->decimal('amount', 15, 2);
            $table->enum('term', ['daily', 'monthly', 'yearly'])->default('monthly');
            $table->decimal('profit_rate', 8, 2)->default(0);
            $table->decimal('current_profit', 15, 2)->default(0);
            $table->decimal('current_balance', 15, 2)->default(0);
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['Running', 'Completed', 'Cancelled'])->default('Running');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_investments');
    }
};
