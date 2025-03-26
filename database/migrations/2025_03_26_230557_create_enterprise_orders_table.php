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
        Schema::create('enterprise_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->string('supplier_name');
            $table->string('supplier_contact');
            $table->date('order_date');
            $table->string('delivery_address');
            $table->string('notes')->nullable();
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->double('total_amount', 10, 2);
            $table->boolean('is_deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enterprise_orders');
    }
};
