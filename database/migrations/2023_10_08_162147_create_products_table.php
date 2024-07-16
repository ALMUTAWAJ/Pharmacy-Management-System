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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image');
            $table->double('price');
            $table->string('category');
            $table->string('description');
            $table->boolean('prescription_req');
            $table->unsignedBigInteger('supplierID');
            $table->foreign('supplierID')->references('id')->on('suppliers')->onDelete('cascade');;
            $table->bigInteger('stock');
            $table->date('exp_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
