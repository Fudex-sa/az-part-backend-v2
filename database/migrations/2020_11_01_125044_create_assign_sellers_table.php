<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_sellers', function (Blueprint $table) {
            $table->id();
            $table->integer('seller_id');
            $table->integer('request_id');
            $table->integer('status_id')->default(1);
            $table->float('price')->nullable();
            $table->enum('seller_type',['broker','tashalih','manufacturing'])->default('tashalih');            
            $table->boolean('composition')->default(0);
            $table->boolean('return_possibility')->default(0);
            $table->boolean('delivery_possibility')->default(0);
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
        Schema::dropIfExists('assign_sellers');
    }
}
