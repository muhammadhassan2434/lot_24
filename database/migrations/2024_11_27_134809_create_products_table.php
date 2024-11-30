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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('title'); // Product title
            $table->text('description')->nullable(); // Product description
            $table->unsignedBigInteger('category_id')->nullable(); // Foreign key for category
            $table->decimal('regular_price', 10, 2); // Regular price
            $table->decimal('sale_price', 10, 2)->nullable(); // Sale price
            $table->decimal('wholesale_price', 10, 2)->nullable(); // Wholesale price
            $table->string('badges')->nullable(); // Product badges (e.g., "New", "Best Seller")
            $table->integer('minimal_order')->default(1); // Minimal order quantity
            $table->integer('product_stock')->default(0); // Product stock quantity
            $table->enum('stock_status', ['in_stock', 'out_of_stock', 'pre_order'])->default('in_stock'); // Stock status
            $table->string('sku')->nullable(); // Stock Keeping Unit (SKU)
            $table->string('ean')->nullable(); // European Article Number (EAN)
            $table->unsignedBigInteger('country_id')->nullable(); // Foreign key for country
            $table->text('tags')->nullable(); // Tags for product (comma-separated)
            $table->text('payment_option')->nullable(); // Payment options (JSON or comma-separated)
            $table->text('delivery_option')->nullable(); // Delivery options (JSON or comma-separated)
            $table->timestamps(); // Created at and updated at timestamps

            // Foreign key constraints
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
