<?php

namespace App\Http\Controllers;

use Request;
use App\Usuario;
use App\Perfil;
use App\Vista;
use App\Maxima;
use App\Jugada;
use App\Apuesta;
use Carbon\Carbon;
use Session;
use DB;

class Mantenimiento extends Controller
{
    public function reiniciar_acumulados()
    {
    	
    	$acumulados=DB::table('jugada_sorteo')->update(["acumulado"=>0]);
    }


   




}
