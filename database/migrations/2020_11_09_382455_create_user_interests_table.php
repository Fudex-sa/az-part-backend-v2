<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_interests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('brand_id');
            $table->unsignedInteger('car_model_id');
            $table->unsignedInteger('city_id');
            $table->string('year', 50);
            $table->enum('price_type', ['fees','fixed']);
            $table->integer('price_from');
            $table->integer('price_to');

            $table->timestamps();
        });


        // Schema::table('user_interests', function (Blueprint $table) {
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        //     $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        //     $table->foreign('car_model_id')->references('id')->on('modells')->onDelete('cascade');
        //     $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_interests');
    }
}
