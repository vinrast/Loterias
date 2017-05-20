<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pare;
use DB;
use Carbon\Carbon;


class Buscar_Ticket extends Controller{
    public function index(){
      $modulos=\Session::get('modulos');
      $modulos=$modulos[0];
      $submodulos=\Session::get('submodulos');
      $submodulos=$submodulos[0];
      return view('buscar.listar-ticket',['modulos'=>$modulos,'submodulos'=>$submodulos]);
    }
}

