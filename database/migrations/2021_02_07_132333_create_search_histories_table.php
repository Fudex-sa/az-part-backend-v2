<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->integer('model_id');
            $table->string('year');
            $table->integer('country_id');
            $table->integer('region_id');
            $table->integer('city_id');
            $table->enum('search_type',['manual','manual'])->default('manual');
            $table->integer('limit');
            $table->integer('user_id');
            $table->enum('user_type',['user','seller','broker']);
            $table->boolean('expired')->default(0)->comment('0=No,1=Yes');
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
        Schema::dropIfExists('search_histories');
    }
}
