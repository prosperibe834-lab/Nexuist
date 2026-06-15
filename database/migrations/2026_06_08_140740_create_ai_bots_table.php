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
        Schema::create('ai_bots', function (Blueprint $table) {
    $table->id();

    $table->string('bot_name');
    $table->string('bot_image')->nullable();
    $table->string('bot_logo')->nullable();

    $table->string('strategy_type');
    $table->text('description')->nullable();

    $table->decimal('monthly_return', 10, 2)->default(0);
    $table->decimal('annual_return', 10, 2)->default(0);
    $table->decimal('accuracy_rate', 10, 2)->default(0);
    $table->decimal('drawdown', 10, 2)->default(0);

    $table->string('risk_level')->default('Medium');
    $table->string('trading_style')->nullable();

    $table->decimal('minimum_investment', 15, 2)->default(0);
    $table->decimal('maximum_investment', 15, 2)->default(0);

    $table->bigInteger('total_subscribers')->default(0);
    $table->decimal('total_investment', 15, 2)->default(0);

    $table->boolean('featured')->default(false);
    $table->boolean('premium')->default(false);
    $table->boolean('popular')->default(false);

    $table->enum('status', [
        'Active',
        'Inactive',
        'Coming Soon'
    ])->default('Active');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ai_bots');
    }
};
