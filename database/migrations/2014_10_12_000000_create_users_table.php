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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Unique identifier for the user.
            $table->string('name'); // The user name.
            $table->string('email')->unique(); // Unique email address for the user.
            $table->timestamp('email_verified_at')->nullable(); // Timestamp for email verification.
            $table->string('password'); // Encrypted user password
            $table->boolean('temporary_password')->default(true); // Temporary password flag.
            $table->rememberToken(); // Token for "remember me" functionality.
            $table->timestamps(); // Timestamps for record creation and modification.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users'); // Drop the 'users' table when rolling back the migration.
    }
};
