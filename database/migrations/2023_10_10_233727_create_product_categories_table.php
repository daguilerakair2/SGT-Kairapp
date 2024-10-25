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
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id(); // Unique identifier for the product-category relationship.
            $table->foreignId('product_id')->constrained('products'); // Foreign key to the related product.
            $table->foreignId('category_id')->constrained('categories'); // Foreign key to the related category.
            $table->timestamps(); // Timestamps for record creation and modification.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories'); // Drop the 'product_categories' table when rolling back the migration.
    }
};
