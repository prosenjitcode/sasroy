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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->integer('bookId');
            $table->integer('addressId');
            $table->integer('qty');
            $table->integer('totalPrice');
            $table->string('orderDate');
            $table->string('packDate');
            $table->string('shippingDate');
            $table->string('deliveryDate');
            $table->string('status');
            $table->string('payment');
            $table->string('razorpay_payment_id');
            $table->string('razorpay_order_id');
            $table->string('razorpay_signature');
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
