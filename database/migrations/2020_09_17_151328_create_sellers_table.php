<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile',50)->unique();
            $table->boolean('saudi')->nullable()->default(0);
            $table->boolean('active')->nullable()->default(0);
            $table->string('verification_code',50)->unique();
            $table->boolean('verified')->nullable()->default(0);
            $table->boolean('vip')->nullable()->default(0);
            $table->string('lang',10)->nullable()->default('ar');
            $table->datetime('last_login')->nullable();
            $table->integer('available_orders')->default(0);
            $table->string('photo')->nullable();
            $table->integer('rating')->default(0);
            $table->enum('user_type',['tashalih','manufacturing']);
            $table->integer('country_id');
            $table->integer('region_id');
            $table->integer('city_id');
            $table->string('address')->nullable();
            
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('phone')->nullable();
            
            $table->integer('created_by')->nullable();
            
            $table->string('api_token',80)->unique()->nullable()->default(null);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('sellers');
    }
}
