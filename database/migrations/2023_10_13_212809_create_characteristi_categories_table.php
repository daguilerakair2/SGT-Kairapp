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
        Schema::create('characteristi_categories', function (Blueprint $table) {
            $table->id(); // Unique identifier for the characteristic-category relationship.
            $table->foreignId('characteristic_id')->constrained('characteristics'); // Foreign key to the related characteristic.
            $table->foreignId('category_id')->constrained('categories'); // Foreign key to the related category.
            $table->string('value')->nullable(); // Value associated with the characteristic in the category.
            $table->timestamps(); // Timestamps for record creation and modification.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characteristic_categories'); // Drop the 'characteristic_categories' table when rolling back the migration.
    }
};
