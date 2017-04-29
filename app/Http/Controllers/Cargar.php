<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use App\Usuario;
use App\vista;
use Session;
use DB;

class Cargar extends Controller

{

    public function login()
    {
        Session::forget('sidebar');
        Session::forget('modulos');
        Session::forget('submodulos');
        return view('login');
    }

    public function loginVerificar()
    {

        $respuesta=[0];
       

             
        $user=strtoupper((string)Request::get('usuario'));
        $pwd=strtoupper((string)Request::get('clave'));
        $usuario=Usuario::where(['username'=>$user,'password'=>$pwd])->first();
        $modulos=array();
        $submodulos=array();

       

        if (count($usuario)!=0) 
        {
           $vistas=$usuario->vistas;
           foreach ($vistas as $vista ) 
           {
               
                   if ($vista->dependencia==$vista->id) 
                   {
                       array_push($modulos,$vista);
                   }
                   else
                   {
                      array_push($submodulos,$vista);
                   }
              
           }

        
          
          Session::push('modulos',$modulos);//datos del menu segun el usuario logueado
          Session::push('submodulos',$submodulos);
        

          $respuesta=[$usuario->username];
        }
      return ($respuesta);

    }


   
    public function apuesta()
    {
        
        $modulos=Session::get('modulos');
        $submodulos=Session::get('submodulos');

        $modulos=$modulos[0];
        $submodulos=$submodulos[0];

        $sorteos=DB::table('sorteos')->get();

        return view('apuesta',['modulos'=>$modulos,'submodulos'=>$submodulos,'sorteos'=>$sorteos]);
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
  
}