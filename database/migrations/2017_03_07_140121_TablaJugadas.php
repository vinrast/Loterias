<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaJugadas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jugadas', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('quiniela')->unsigned();
            $table->integer('pale')->unsigned();
            $table->integer('tripleta')->unsigned();
            $table->float('apuesta');
            $table->integer('tipoj');
            $table->integer('ticket_id')->unsigned();
            $table->integer('sorteo_id')->unsigned();

            $table->foreign('quiniela')->references('id')->on('pares');
            $table->foreign('pale')->references('id')->on('pares');
            $table->foreign('tripleta')->references('id')->on('pares');
            $table->foreign('ticket_id')->references('id')->on('tickets');
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
        Schema::dropIfExists('jugadas');
    }
}
