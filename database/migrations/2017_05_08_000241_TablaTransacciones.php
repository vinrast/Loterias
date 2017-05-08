<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaTransacciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jugada_id')->unsigned();
            $table->integer('sorteo_id')->unsigned();
            $table->integer('apuesta_id')->unsigned();
            $table->integer('ticket_id')->unsigned();
            
            

            $table->foreign('jugada_id')->references('id')->on('jugadas');
            $table->foreign('sorteo_id')->references('id')->on('sorteos');
            $table->foreign('apuesta_id')->references('id')->on('apuestas');
            $table->foreign('ticket_id')->references('id')->on('tickets');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transacciones');
    }
}
