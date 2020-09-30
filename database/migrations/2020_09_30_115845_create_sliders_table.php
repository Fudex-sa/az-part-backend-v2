<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('img');
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_hi')->nullable();

            $table->text('content_ar')->nullable();
            $table->text('content_en')->nullable();
            $table->text('content_hi')->nullable();

            $table->boolean('active')->default(1);
            $table->integer('sort')->default(0);
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
        Schema::dropIfExists('sliders');
    }
}
