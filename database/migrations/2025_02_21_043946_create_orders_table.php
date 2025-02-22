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
            $table->string('invoice_number')->primary();
            $table->string('customer_number');
            $table->string('customer_name');
            $table->string('fiscal_data')->nullable();
            $table->date('order_date');
            $table->text('delivery_address');
            $table->text('notes')->nullable();
            $table->foreignId('status_id')->constrained('order_statuses');
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();

            $table->foreign('customer_number')->references('customer_number')->on('customers')->onDelete('cascade');
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
