<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hall_id');
            $table->foreign('hall_id')->references('id')->on('halls')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('movie_id');
            $table->time('start_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_schedules');
    }
}