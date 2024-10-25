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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->string('path'); // Path to the image server.
            $table->string('name'); // Name of the image.
            $table->string('size'); // Size of the image (kb,mb).
            $table->string('extension'); // Extension of the image (jpeg,png,webp..).
            $table->foreignId('product_id')->constrained('products'); // Foreign key to the related product.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
