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
        Schema::create('stores', function (Blueprint $table) {
            $table->integer('rut')->primary(); // Unique identifier for the store.
            $table->char('checkDigit', 1); // Check digit for the RUT.
            $table->string('companyName'); // Full company name.
            $table->string('description'); // Description of the store.
            $table->string('fantasyName'); // Fantasy or trade name.
            $table->string('pathProfile'); // Path to the store's profile image.
            $table->string('pathBackground'); // Path to the store's background image.
            $table->boolean('itinerant'); //  0 = fixed, 1 = itinerant.
            $table->boolean('custom'); // 0 = standard, 1 = custom products(time of preparation).
            $table->boolean('status'); // Status of the store (active, inactive, etc).
            $table->timestamps(); // Timestamps for record creation and modification.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores'); // Drop the 'stores' table when rolling back the migration.
    }
};
