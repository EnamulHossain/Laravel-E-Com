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
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('childcategory_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->string('code');
            $table->string('unit')->nullable();
            $table->string('tags')->nullable();
            $table->string('video')->nullable();
            $table->string('price')->nullable();
            $table->string('dicount_price')->nullable();
            $table->string('quantity')->nullable();
            $table->string('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('images')->nullable();
            $table->integer('feature')->nullable();
            $table->integer('today_deal')->nullable();
            $table->integer('status')->nullable();
            $table->integer('sku')->nullable();
            $table->integer('flash_deal_id')->nullable();
            $table->integer('cash_on_delivery')->nullable();
            $table->integer('warehouse')->nullable();
            $table->integer('admin_id')->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
            $table->foreign('childcategory_id')->references('id')->on('child_categories')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
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
