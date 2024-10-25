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
        Schema::create('sub_stores', function (Blueprint $table) {
            $table->id(); // Unique identifier for the sub-store.
            $table->string('name'); // Name of the sub-store.
            $table->string('address'); // Address of the sub-store.
            $table->double('latitude'); // Latitude coordinates.
            $table->double('longitude'); // Longitude coordinates.
            $table->double('reputation')->nullable(); // Reputation score (optional).
            $table->double('commission')->nullable(); // Commission rate (optional).
            $table->string('subStoreMobileId')->nullable(); // Identifier for mobile app integration.
            $table->bigInteger('phone'); // Phone number of the sub-store.
            $table->boolean('status'); // Status of the sub-store (active, inactive, etc).
            $table->foreignId('city_id')->constrained('cities'); // Foreign key to the city where the sub-store is located.
            $table->integer('store_rut'); // RUT of the parent store.
            $table->foreign('store_rut')->references('rut')->on('stores'); // Foreign key to the parent store.
            $table->timestamps(); // Timestamps for record creation and modification.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_stores'); // Drop the 'sub_stores' table when rolling back the migration.
    }
};
