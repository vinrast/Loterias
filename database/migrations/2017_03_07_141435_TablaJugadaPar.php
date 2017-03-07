<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaJugadaPar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jugada_pare', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('jugada_id')->unsigned();
            $table->integer('pare_id')->unsigned();

            $table->foreign('jugada_id')->references('id')->on('jugadas');
            $table->foreign('pare_id')->references('id')->on('pares');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jugada_pare');
    }
}
