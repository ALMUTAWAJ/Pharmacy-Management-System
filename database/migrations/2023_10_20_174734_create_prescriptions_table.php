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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customerID');
            $table->foreign('customerID')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('orderID');
            $table->foreign('orderID')->references('id')->on('orders');
            $table->unsignedBigInteger('staffID')->nullable();
            $table->foreign('staffID')->references('id')->on('users')->nullable();
            $table->boolean('approval');
            $table->string('prescription_upload');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};