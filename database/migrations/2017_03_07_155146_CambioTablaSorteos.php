<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CambioTablaSorteos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sorteos', function (Blueprint $table) 
        {
           $table->time('horaI');
           $table->time('horaC');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sorteos', function (Blueprint $table) {
            $table->dropColumn('horaI');
            $table->dropColumn('horaI');
        });
    }
}
