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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->decimal('discount', 8, 2); // Discount amount or percentage
            $table->unsignedBigInteger('influencer_id')->nullable(); // To track influencer
            $table->dateTime('expiry_date')->nullable(); // Optional expiration
            $table->string('status')->default('active');
            $table->timestamps();

            $table->foreign('influencer_id')->references('id')->on('influencers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
