<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CambioTablaSorteosApuesta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sorteos', function (Blueprint $table) {
            $table->float('acumulado_q')->default(0);
            $table->float('acumulado_p')->default(0);
            $table->float('acumulado_t')->default(0);
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
            $table->dropColumn('acumulado_q');
            $table->dropColumn('acumulado_p');
            $table->dropColumn('acumulado_t');//
        });
    }
}
