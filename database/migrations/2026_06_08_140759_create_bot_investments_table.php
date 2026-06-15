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
        Schema::create('bot_investments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('bot_id')
                ->constrained('ai_bots')
                ->cascadeOnDelete();

            $table->decimal('investment_amount', 15, 2);

            $table->decimal('current_profit', 15, 2)
                ->default(0);

            $table->decimal('current_balance', 15, 2)
                ->default(0);

            $table->date('start_date');

            $table->date('end_date');

            $table->enum('status', [
                'Running',
                'Completed',
                'Cancelled',
            ])->default('Running');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bot_investments');
    }
};
