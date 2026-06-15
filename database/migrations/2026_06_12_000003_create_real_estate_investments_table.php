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
        Schema::create('real_estate_investments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('property_id')
                ->constrained('real_estate_properties')
                ->cascadeOnDelete();
            $table->decimal('investment_amount', 15, 2);
            $table->decimal('tokens_purchased', 20, 8);
            $table->decimal('token_price', 15, 2);
            $table->decimal('apy', 6, 2);
            $table->decimal('expected_profit', 15, 2);
            $table->enum('investment_status', ['Active', 'Completed', 'Cancelled'])->default('Active');
            $table->dateTime('investment_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_estate_investments');
    }
};
