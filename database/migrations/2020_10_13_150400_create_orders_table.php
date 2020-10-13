<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['manual','electronic'])->default('manual');
            $table->integer('user_id');
            $table->integer('seller_id');
            
            $table->integer('brand_id');
            $table->integer('model_id');
            $table->integer('year');
            $table->integer('country_id');
            $table->integer('region_id');
            $table->integer('city_id');
            
            $table->integer('piece_alt_id');
            $table->float('price');
            $table->string('guarantee')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('bought')->default(0);
 
            $table->integer('status')->default(1);
            $table->float('total')->default(0);
             
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
        Schema::dropIfExists('carts');
    }
}
