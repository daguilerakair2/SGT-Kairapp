<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('store_product_orders', function (Blueprint $table) {
            $table->id(); // Unique identifier for the store product order.
            $table->integer('quantity'); // Quantity of the product in the order.
            $table->integer('buyPrice'); // Price of the product in the order.
            $table->string('note')->nullable(); // Note of the product in the order.
            $table->string('productMobile_id'); // Unique identifier for the product in the order.
            $table->foreignId('store_order_id')->constrained('store_orders'); // Foreign key to the related order.
            $table->foreignId('sub_store_product_id')->constrained('sub_store_products'); // Foreign key to the related store product.
            $table->timestamps(); // Timestamps for record creation and modification.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_product_orders'); // Drop the 'store_product_orders' table when rolling back the migration.
    }
};
