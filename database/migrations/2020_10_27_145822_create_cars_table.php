<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['damaged','antique'])->default('damaged');
            $table->integer('user_id');
            $table->enum('user_type',['user','company','seller','broker','rep','admin']);
            $table->string('title');
            $table->integer('brand_id');
            $table->integer('model_id');
            $table->integer('year');
            $table->string('color');
            $table->string('kilo_no');
            $table->integer('country_id');
            $table->integer('region_id');
            $table->integer('city_id');
            $table->enum('price_type',['fixed','fees'])->default('fixed');
            $table->float('price')->nullable();
            $table->boolean('validatly')->default(1);
            $table->boolean('examination')->default(1);
            $table->text('notes')->nullable();
            $table->boolean('publish')->default(1);
            $table->integer('views')->default(1);
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
        Schema::dropIfExists('cars');
    }
}
