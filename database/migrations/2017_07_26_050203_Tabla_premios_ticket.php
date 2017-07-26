<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaPremiosTicket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nro_ticket',50);
            $table->string('sorteo',50);
            $table->string('jugada',50);
            $table->string('tipo',50);
            $table->integer('premio');
            $table->integer('apuesta');
            $table->float('pago');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('p_tickets');
    }
}
