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
        Schema::create('mycategory_myproduct', function (Blueprint $table) {
            $table->unsignedBigInteger("category_id");
            $table->unsignedBigInteger("products_id");

            $table->foreign('category_id')->references('id')->on('mycategories')->onDelete('cascade');
            $table->foreign('products_id')->references('id')->on('myproducts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mycategory_myproduct');
    }
};
