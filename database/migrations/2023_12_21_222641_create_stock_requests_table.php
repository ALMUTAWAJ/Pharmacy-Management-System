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
        Schema::create('stock_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplierID');
            $table->unsignedBigInteger('staffID');
            $table->string('subject');
            $table->integer('quantity');
            $table->unsignedBigInteger('productID');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('supplierID')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('staffID')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('productID')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_requests');
    }
};
