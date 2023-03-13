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
        Schema::create('order_product', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');

            $table->index('order_id', 'order_product_order_idx');
            $table->index('product_id', 'order_product_product_idx');

            $table->foreign('order_id', 'order_product_order_fk')->on('orders')->references('id');
            $table->foreign('product_id', 'order_product_product_fk')->on('products')->references('id');

            $table->integer('count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_product');
    }
};
