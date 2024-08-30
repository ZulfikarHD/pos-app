<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('order_item_id'); // Primary key
            $table->foreignId('order_id')
                  ->constrained()
                  ->references('order_id')
                  ->onDelete('cascade'); // Foreign key to orders table
            $table->foreignId('product_id')
                  ->constrained()
                  ->references('product_id')
                  ->onDelete('cascade'); // Foreign key to products table
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2); // Storing unit price with 2 decimal places
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item');
    }
};
