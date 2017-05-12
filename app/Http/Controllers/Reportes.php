<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pare;
use DB;


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
    	$hora = date("h:i a",time()-2100);
    	return $hora;
		
    }
}

