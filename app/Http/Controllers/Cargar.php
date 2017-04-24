<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use App\Usuario;
use App\vista;
use Session;
use DB;

class Cargar extends Controller

{public function login()
    {
        Session::forget('sidebar');
        return view('login');
    }

    public function loginVerificar()
    {

        $respuesta=[0];
       

        $user=Request::get('usuario');
        $pwd=Request::get('clave');
        $columnas=array("Apuestas","Tickets","Reportes","Administracion");
        $sidebar=array();

        $usuario=Usuario::where(['username'=>$user,'password'=>$pwd])->first();
        $vistas=DB::table('vistas')->get();

        if (count($usuario)!=0) 
        {
           for ($i=0; $i <4 ; $i++)
           {
              if ($usuario->$columnas[$i]==1)
              {
                array_push($sidebar,Vista::where(['descripcion'=>$columnas[$i]])->first());
              }
           }
           
          Session::push('sidebar',$sidebar);//datos del menu segun el usuario logueado
          $respuesta=[$usuario->username];
        }
       return ($respuesta);

    }


   
    public function apuesta()
    {
        
        $sidebar=Session::get('sidebar');
        $sidebar=$sidebar[0];
        $sorteos=DB::table('sorteos')->get();

        return view('apuesta',['sidebar'=>$sidebar,'sorteos'=>$sorteos]);
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
