<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pare;
use DB;

class Administracion extends Controller{
    public function usuarios(){
        return view('usuarios');
    }
    
}
