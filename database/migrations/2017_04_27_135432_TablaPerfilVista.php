<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaPerfilVista extends Migration
{
   
    public $timestamps=false;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfil_vista', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('perfil_id')->unsigned();
            $table->integer('vista_id')->unsigned();

            $table->foreign('perfil_id')->references('id')->on('perfiles');
            $table->foreign('vista_id')->references('id')->on('vistas');

           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('perfil_vista');
    }
}
