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
        Schema::create('delivery_evidence', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('photo_url');
            $table->string('photo_type');
            $table->timestamp('uploaded_at')->useCurrent();
            $table->string('uploaded_by');
            $table->timestamps();

            $table->foreign('order_id')->references('invoice_number')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_evidence');
    }
};
