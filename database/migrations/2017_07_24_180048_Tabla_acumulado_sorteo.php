<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaAcumuladoSorteo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_acumulados', function (Blueprint $table) 

        {
            $table->increments('id');
            $table->string('sorteos');
            $table->date('fecha');
            $table->float('acumulado')->default(0);

            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_acumulados');
    }
}
