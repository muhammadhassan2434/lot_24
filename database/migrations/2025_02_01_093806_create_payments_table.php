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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_intent_id')->unique();  // Stripe Payment Intent ID
            $table->string('order_id')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('currency', 10);
            $table->string('payment_status')->default('pending');
            $table->string('last4')->nullable();  // Last 4 digits of the card
            $table->string('brand')->nullable(); // Card brand (Visa, MasterCard)
            $table->timestamp('payment_date')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
