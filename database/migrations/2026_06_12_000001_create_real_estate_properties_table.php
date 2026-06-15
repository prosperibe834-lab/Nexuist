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
        Schema::create('real_estate_properties', function (Blueprint $table) {
            $table->id();
            $table->string('property_name');
            $table->string('slug')->unique();
            $table->string('property_type');
            $table->text('description')->nullable();
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('address');
            $table->unsignedSmallInteger('bedrooms')->default(0);
            $table->unsignedSmallInteger('bathrooms')->default(0);
            $table->unsignedSmallInteger('living_rooms')->default(0);
            $table->unsignedSmallInteger('kitchens')->default(0);
            $table->unsignedSmallInteger('parking_spaces')->default(0);
            $table->decimal('property_size', 12, 2)->default(0);
            $table->unsignedSmallInteger('year_built')->nullable();
            $table->decimal('market_value', 15, 2)->default(0);
            $table->decimal('token_price', 15, 8)->default(0);
            $table->decimal('total_tokens', 20, 8)->default(0);
            $table->decimal('available_tokens', 20, 8)->default(0);
            $table->decimal('sold_tokens', 20, 8)->default(0);
            $table->decimal('minimum_investment', 15, 2)->default(0);
            $table->decimal('maximum_investment', 15, 2)->default(0);
            $table->decimal('estimated_apy', 6, 2)->default(0);
            $table->decimal('expected_annual_return', 15, 2)->default(0);
            $table->enum('property_status', ['Active', 'Upcoming', 'Under Review', 'Suspended', 'Sold Out'])->default('Active');
            $table->boolean('featured_property')->default(false);
            $table->string('main_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_estate_properties');
    }
};
