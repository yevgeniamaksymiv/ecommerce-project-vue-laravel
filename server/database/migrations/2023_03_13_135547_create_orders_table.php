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
            $table->id();

            $table->string('order_date')->nullable();
            $table->string('delivery_address')->nullable();
            $table->integer('order_amount');

            $table->unsignedBigInteger('user_id');
            $table->index('user_id', 'order_user_idx');
            $table->foreign('user_id', 'order_user_fk')->on('users')->references('id');

            $table->unsignedBigInteger('delivery_id');
            $table->index('delivery_id', 'order_delivery_idx');
            $table->foreign('delivery_id', 'order_delivery_fk')->on('deliveries')->references('id');

            $table->timestamps();
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
