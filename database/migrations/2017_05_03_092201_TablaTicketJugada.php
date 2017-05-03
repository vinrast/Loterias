<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaTicketJugada extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jugada_ticket', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jugada_id')->unsigned();
            $table->integer('ticket_id')->unsigned();
            

            $table->foreign('jugada_id')->references('id')->on('jugadas');
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
        Schema::dropIfExists('jugada_ticket');
    }
}
