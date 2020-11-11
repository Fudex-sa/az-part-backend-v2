<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCountryAndRegionToUserInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_interests', function (Blueprint $table) {
            $table->integer('country_id')->nullable();
            $table->integer('region_id')->nullable();
        });

        // Schema::table('user_interests', function (Blueprint $table) {
        //     $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        //     $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_interests', function (Blueprint $table) {
            //
        });
    }
}
