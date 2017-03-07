<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaSorteo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sorteos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion');
            $table->integer('loteria_id')->unsigned();
            $table->foreign('loteria_id')->references('id')->on('loterias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sorteos');
    }
}
