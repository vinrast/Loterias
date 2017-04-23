<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pare;
use DB;

class Administracion extends Controller{
    public function listar_usuarios(){
        return view('administracion.usuarios');
    }
    
    public function listar_loterias(){
        return view('administracion.loterias');
    }
}
