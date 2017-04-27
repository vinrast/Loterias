<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaVistas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vistas', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('descripcion',100);
            $table->string('ruta',100);
            $table->integer('padre')->default(1);
            $table->integer('dependencia')->unsigned();
            $table->foreign('dependencia')->references('id')->on('vistas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vistas');
    }
}
