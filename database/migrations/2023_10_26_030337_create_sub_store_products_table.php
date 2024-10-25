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
        Schema::create('sub_store_products', function (Blueprint $table) {
            $table->id();
            $table->integer('price'); // Price of the product.
            $table->integer('stock'); // Available stock quantity.
            $table->boolean('status'); // Status: false = disabled, true = enabled.
            $table->boolean('delete'); // Deletion status: false = not deleted, true = deleted.
            $table->foreignId('product_id')->constrained('products'); // Foreign key to the related product.
            $table->foreignId('sub_store_id')->constrained('sub_stores'); // Foreign key to the related substore.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_store_products');
    }
};
