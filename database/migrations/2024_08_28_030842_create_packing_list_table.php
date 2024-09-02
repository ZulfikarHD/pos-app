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
        Schema::create('packing_lists', function (Blueprint $table) {
            $table->id('packing_list_id'); // Primary key
            $table->foreignId('order_id')
                  ->constrained()
                  ->references('order_id')
                  ->onDelete('cascade'); // Foreign key to orders table
            $table->date('packing_date');
            $table->date('shipped_date')->nullable();
            $table->string('shipping_status')->default('Pending');
            $table->text('tracking_details')->nullable();
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packing_lists');
    }
};
