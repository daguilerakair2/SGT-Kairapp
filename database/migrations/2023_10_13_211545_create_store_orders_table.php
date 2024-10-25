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
        Schema::create('store_orders', function (Blueprint $table) {
            $table->id(); // Unique identifier for the store order.
            $table->integer('subTotal'); // Total amount for the store order.
            $table->date('date');
            $table->boolean('pending'); // 0 = delivered, 1 = pending.
            $table->string('orderMobile_id')->nullable();
            $table->string('storeMobile_id')->nullable();
            $table->foreignId('sub_store_id')->constrained('sub_stores'); // Foreign key to the related substore.
            $table->timestamps(); // Timestamps for record creation and modification.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_orders'); // Drop the 'store_orders' table when rolling back the migration.
    }
};
