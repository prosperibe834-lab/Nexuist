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
    Schema::create('kyc_verifications', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')->constrained()->onDelete('cascade');

        $table->string('first_name');
        $table->string('last_name');
        $table->string('email');
        $table->string('phone');

        $table->string('address');
        $table->string('city');
        $table->string('state');

        $table->string('document_type');

        $table->string('front_image');
        $table->string('back_image');

        $table->timestamps();
    });
}
};
