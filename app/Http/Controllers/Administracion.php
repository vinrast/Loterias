<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pare;
use DB;


class Administracion extends Controller{
    public function listar_usuarios(){
        return view('administracion.usuarios');
    }
    
    public function listar_loterias()
    {
       	$modulos=\Session::get('modulos');
       	$modulos=$modulos[0];
		$submodulos=\Session::get('submodulos');
       	$submodulos=$submodulos[0];

        return view('administracion.loterias',['modulos'=>$modulos,'submodulos'=>$submodulos]);
    }
}
