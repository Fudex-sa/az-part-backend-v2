<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToRepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reps', function (Blueprint $table) {
            $table->enum('type',['individual','company'])->default('individual');
            $table->enum('status',['join_request','activated','not_activated','rejected'])->default('activated');
            $table->string('id_copy')->nullable();
            $table->integer('bank_id')->nullable();
            $table->string('car_license_img')->nullable();
            $table->text('car_data')->nullable();
            $table->string('car_img')->nullable();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reps', function (Blueprint $table) {
            //
        });
    }
}
