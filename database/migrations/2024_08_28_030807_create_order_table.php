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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id'); // Primary key
            $table->foreignId('customer_id')
                  ->constrained()
                  ->references('customer_id')
                  ->onDelete('cascade'); // Foreign key to customers table
            $table->foreignId('user_id')
                  ->constrained()
                  ->references('id')
                  ->onDelete('cascade'); // Foreign key to users table
            $table->date('order_date');
            $table->enum('status', ['Draft', 'Pending', 'Completed'])->default('Draft');
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
