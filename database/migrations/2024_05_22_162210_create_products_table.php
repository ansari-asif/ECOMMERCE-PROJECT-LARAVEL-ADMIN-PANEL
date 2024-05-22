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
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('sku')->nullable();
            $table->unsignedBigInteger('category');
            $table->unsignedBigInteger('sub_category');
            $table->unsignedBigInteger('brand');
            $table->text('short_desc')->nullable();
            $table->text('description')->nullable();
            $table->text('additional_info')->nullable();
            $table->text('shipping_returns')->nullable();
            $table->boolean('status')->default(false);
            $table->foreign('category')->references('id')->on('product_category')->onDelete('cascade');
            $table->foreign('sub_category')->references('id')->on('product_sub_category')->onDelete('cascade');
            $table->foreign('brand')->references('id')->on('brand')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
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
