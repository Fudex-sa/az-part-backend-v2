<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_shippings', function (Blueprint $table) {
            $table->id();
        
            $table->integer('country_id');
            $table->integer('region_id');
            $table->integer('city_id');
            $table->string('street')->nullable();
            $table->string('address')->nullable();
            $table->string('lat',100)->nullable();
            $table->string('lng',100)->nullable();
            $table->integer('rep_id')->nullable();
            $table->text('delivery_time')->nullable();
            $table->boolean('with_oil')->default(0);
            $table->enum('size',['light','medium','heavy'])->default('medium');
            
            $table->text('notes')->nullable();
            
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
        Schema::dropIfExists('order_shippings');
    }
}
