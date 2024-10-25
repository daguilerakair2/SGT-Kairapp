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
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // Unique identifier for the role.
            $table->string('name'); // Name of the role. Values: AdministratorKairapp = 1, AdministratorStore = 2, AdministratorSubStore = 3, Collaborator = 4.
            $table->timestamps(); // Timestamps for record creation and modification.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles'); // Drop the 'roles' table when rolling back the migration.
    }
};
