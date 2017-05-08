<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabalaJugadaSorteo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jugada_sorteo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jugada_id')->unsigned();
            $table->integer('sorteo_id')->unsigned();
            $table->integer('acumulado')->default(0);

            $table->foreign('jugada_id')->references('id')->on('jugadas');
            $table->foreign('sorteo_id')->references('id')->on('sorteos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jugada_sorteo');
    }
}
