<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pare;
use DB;


class Administracion extends Controller{
    public function listar_usuarios(){
      $modulos=\Session::get('modulos');
      $modulos=$modulos[0];
      $submodulos=\Session::get('submodulos');
      $submodulos=$submodulos[0];
      return view('administracion.usuarios',['modulos'=>$modulos,'submodulos'=>$submodulos]);
    }
    public function listar_loterias()
    {
      $modulos=\Session::get('modulos');
      $modulos=$modulos[0];
      $submodulos=\Session::get('submodulos');
      $submodulos=$submodulos[0];
      return view('administracion.loterias',['modulos'=>$modulos,'submodulos'=>$submodulos]);
    }
    public function config_premio(){
      $modulos=\Session::get('modulos');
      $modulos=$modulos[0];
      $submodulos=\Session::get('submodulos');
      $submodulos=$submodulos[0];
      return view('administracion.configpremios',['modulos'=>$modulos,'submodulos'=>$submodulos]);
    }
}
