<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supervisors', function (Blueprint $table) {
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
            
            $table->string('photo')->nullable();
            $table->integer('rating')->default(0);
            $table->enum('user_type',['supervisor','admin'])->default('supervisor');

            $table->string('api_token',80)->unique()->nullable()->default(null);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('supervisors');
    }
}
