<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rep_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('rep_id');
            $table->integer('_from');
            $table->integer('city_id');
            $table->float('price')->default(0);
            $table->enum('car_price',['light','medium','heavy'])->default('medium');
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('rep_prices');
    }
}
