<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaPagosTicket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pago_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nro_ticket',50);
            $table->string('sorteo',50);
            $table->string('premio',50);
            $table->string('jugada',50);
            $table->string('tip',50);
            $table->integer('apuesta');
            $table->float('pago');
            $table->string('usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pago_tickets');
    }
}
