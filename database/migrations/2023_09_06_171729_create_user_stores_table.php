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
        Schema::create('user_stores', function (Blueprint $table) {
            $table->id(); // Unique identifier for the user-store relationship.
            $table->foreignId('user_id')->constrained('users'); // Foreign key to the related user.
            $table->integer('store_rut'); // RUT of the associated store.
            $table->foreign('store_rut')->references('rut')->on('stores'); // Foreign key to the associated store.
            $table->foreignId('role_id')->constrained('roles'); // Foreign key to the related role.
            $table->integer('subStore_id')->nullable(); // Identifier for a related substore (optional).
            $table->boolean('admin'); // Admin: false = inactive, true = active.
            $table->boolean('status'); // Status: false = inactive, true = active.
            $table->boolean('delete'); // Deletion status: false = not deleted, true = deleted.
            $table->timestamps(); // Timestamps for record creation and modification.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_stores'); // Drop the 'user_stores' table when rolling back the migration.
    }
};
