<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pare;
use DB;
use Carbon\Carbon;


class Reportes extends Controller{
    public function index(){
      $modulos=\Session::get('modulos');
      $modulos=$modulos[0];
      $submodulos=\Session::get('submodulos');
      $submodulos=$submodulos[0];
      return view('reportes.index',['modulos'=>$modulos,'submodulos'=>$submodulos]);
    }

    public function hora()
    {
      $consulta = DB::table('sorteos')->select('id','horaSorteo')->get();
      $cierre=DB::table('maximas')->select('tiempoCierre')->first();
    	$hora = date("h:i a",time());
      $hora_ = date("H:i:s",time());
      $mes = date("n",time());
      $dia = date("w",time());
      $dia_mes = date("j",time());
      $anio = date("Y",time());
      if ($cierre->tiempoCierre == 15) {
        for ($i=0; $i <count($consulta); $i++) { 
          $consulta[$i]->horaSorteo = date("H:i:s",strtotime ( '-15 minute' , strtotime ( $consulta[$i]->horaSorteo ) )) ;
        }
      }
      elseif($cierre->tiempoCierre == 20) {
        for ($i=0; $i <count($consulta); $i++) { 
          $consulta[$i]->horaSorteo = date("H:i:s",strtotime ( '-20 minute' , strtotime ( $consulta[$i]->horaSorteo ) )) ;
        }
      }
      elseif($cierre->tiempoCierre == 30) {
        for ($i=0; $i <count($consulta); $i++) { 
          $consulta[$i]->horaSorteo = date("H:i:s",strtotime ( '-30 minute' , strtotime ( $consulta[$i]->horaSorteo ) )) ;
        }
      }
      $resultado = array( $hora,
                          $hora_,
                          $mes,
                          $dia,
                          $anio,
                          $dia_mes,
                          $consulta,
                        );
    	return $resultado;
		
    }
}

