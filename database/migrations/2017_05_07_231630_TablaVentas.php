<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaVentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) 
        {
            $table->increments('id');

            $table->integer('jugada_id')->unsigned();
            $table->integer('sorteo_id')->unsigned();
            $table->integer('apuesta_id')->unsigned();
            $table->string('usuario');
            $table->integer('fila');
            $table->date('fecha');
            

            $table->foreign('jugada_id')->references('id')->on('jugadas');
            $table->foreign('sorteo_id')->references('id')->on('sorteos');
            $table->foreign('apuesta_id')->references('id')->on('apuestas');
          
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
