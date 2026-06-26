<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add demo_balance to users table
        if (!Schema::hasColumn('users', 'demo_balance')) {
            Schema::table('users', function (Blueprint $table) {
                $table->decimal('demo_balance', 15, 2)->default(100000.00)->after('balance');
            });
        }

        // Create demo_trades table for storing demo trading history
        Schema::create('demo_trades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('asset'); // BTC, ETH, AAPL, etc.
            $table->enum('direction', ['BUY', 'SELL']);
            $table->decimal('amount', 15, 2); // Principal amount
            $table->decimal('leverage', 5, 2)->default(1); // Leverage multiplier
            $table->integer('duration_minutes'); // Duration of the trade
            $table->decimal('notional_value', 18, 2); // Amount * leverage
            $table->enum('status', ['OPEN', 'CLOSED'])->default('OPEN');
            $table->decimal('pnl', 15, 2)->nullable(); // Profit/Loss
            $table->enum('result', ['WIN', 'LOSS', 'BREAK_EVEN'])->nullable();
            $table->timestamp('opened_at');
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('demo_trades');
        
        if (Schema::hasColumn('users', 'demo_balance')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('demo_balance');
            });
        }
    }
};
