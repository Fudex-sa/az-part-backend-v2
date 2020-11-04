<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['manual','electronic'])->default('manual');
            $table->integer('shipping_id');
            $table->integer('user_id');
            $table->float('sub_total');
            $table->float('delivery_price')->nullable();
            $table->float('taxs')->default(0);
            $table->integer('coupon_id')->nullable();
            $table->float('coupon_value')->default(0);
            $table->float('total');
            $table->integer('status')->default(1);
            $table->integer('package_sub_id')->nullable();
             
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
