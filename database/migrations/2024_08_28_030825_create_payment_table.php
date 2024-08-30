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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id'); // Primary key
            $table->foreignId('invoice_id')
                  ->constrained()
                  ->references('invoice_id')
                  ->onDelete('cascade'); // Foreign key to invoices table
            $table->date('payment_date');
            $table->decimal('amount_paid', 10, 2); // Amount paid with 2 decimal places
            $table->string('payment_method'); // Payment method (e.g., Credit Card, Cash)
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
