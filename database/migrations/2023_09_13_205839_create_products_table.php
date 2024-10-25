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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Unique identifier for the product.
            $table->string('name'); // Name of the product.
            $table->string('description'); // Description of the product.
            $table->integer('price'); // Price of the product.
            $table->boolean('variablePrice'); // Indicates if the product has a variable price.
            $table->double('reputation')->nullable(); // Reputation score (optional).
            $table->integer('custom')->nullable(); // Product Change (optional).
            $table->integer('preparationTime')->nullable(); // Preparation Time (optional).
            $table->string('productMobileId')->nullable(); // Identifier for mobile app integration (optional).
            $table->integer('store_rut'); // RUT of the associated store.
            $table->foreign('store_rut')->references('rut')->on('stores');
            $table->timestamps(); // Timestamps for record creation and modification.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products'); // Drop the 'products' table when rolling back the migration.
    }
};
