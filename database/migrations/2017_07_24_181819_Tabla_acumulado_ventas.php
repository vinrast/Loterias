<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaAcumuladoVentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('v_acumulados', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->float('v_acumulado');
            $table->float('c_acumulado');
            $table->float('t_acumulado')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('v_acumulados');
    }
}
