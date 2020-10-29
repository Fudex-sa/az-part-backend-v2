<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElectronicEnginesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electronic_engines', function (Blueprint $table) {
            $table->id();            
            $table->integer('user_id');
            $table->enum('user_type',['user','company','seller','broker','rep','admin'])->default('user');
            $table->integer('seller_id');
            $table->integer('order_id')->nullable();

            $table->integer('brand_id');
            $table->integer('model_id');
            $table->integer('year');
            $table->integer('country_id');
            $table->integer('region_id');
            $table->integer('city_id');
            
            $table->integer('piece_alt_id');
            $table->string('photo')->nullable();
            $table->integer('qty')->default(1);
            $table->float('price')->nullable();
            $table->string('guarantee')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('bought')->default(0);
            $table->string('color')->nullable();            

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
        Schema::dropIfExists('electronic_engines');
    }
}
