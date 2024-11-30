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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Full country name
            $table->string('iso_code')->unique(); // ISO code (e.g., US, CA)
            $table->string('dail_code')->nullable(); // Dialing code (e.g., +1)
            $table->string('currency')->nullable(); // Currency code (e.g., USD)
            $table->string('currency_symbol')->nullable(); // Currency symbol (e.g., $)
            $table->string('time_zone')->nullable(); // Time zone (e.g., America/New_York)
            $table->string('region')->nullable(); // Region/Continent (e.g., North America)
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
