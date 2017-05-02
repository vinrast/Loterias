<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use App\Usuario;
use App\Perfil;
use App\Vista;
use App\Maxima;
use App\Jugada;
use App\Apuesta;
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
           $perfil=Perfil::where(['id'=>$usuario->perfil_id])->first();
           $vistas=$perfil->vistas;
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

    public function verificarApuesta()
    {
      
       
        $columnas=['quiniela','pale','tripleta'];
        $datos=Request::get('datos');
        $apuesta=(int)$datos[0];
        $tripleta=$datos[1];
        $tipoJugada=(int)$datos[2];

        // $datos=[1,'22-34-54',1];
        // $apuesta=$datos[0];
        // $tripleta=$datos[1];
        // $tipoJugada=$datos[2]; 

        $resp=[0,0];

        $consultaJugada=Jugada::where('numero',$tripleta)->first();
        $maxima=Maxima::where(['id'=>1])->first();
        $campo=$columnas[$tipoJugada-1];
       

        if (count($consultaJugada)==0)//si no existe la jugada se crea
        {
           $idJ=DB::table('jugadas')->insertGetId
          (['numero'=>$tripleta,'tipo'=>$tipoJugada,'acumulado'=>0]);

          $acumulado=0;

        }
        else//si existe
        {
          $idJ=$consultaJugada->id;
          $acumulado=$consultaJugada->acumulado;
         
        }
        /////////////////////////Si puede realizarse la apuesta o no /////////////////////////////////
        ///0 se encuentra cumplida, 1 exito y queda dinero, 2 se cumplio la meta con esa apuesta, 3 se sobrepasa se debe indicar cuanto falta
       if($acumulado==$maxima->$campo)
       {
         $resp[0]=0;//se cumplio la meta
       }
       elseif($acumulado<=$maxima->$campo)
       {
        
            $diferencia=($maxima->$campo)-$acumulado;
            if ($apuesta<$diferencia) //si la apuesta esmejor a lo que queda
            {
                $resp[0]=1;
                $resp[1]=$diferencia-$apuesta;
            }
            elseif($apuesta==$diferencia)//si la apuesta es igual a lo que queda//se cumple la meta
            {
                $resp[0]=2;

            }
            elseif($apuesta>$diferencia)//si la puesta se pasa
            {
                $resp[0]=3;
                $resp[1]=$diferencia;
            }
       }
       ////////////////////////////////////////////////////////////////////////////////////////////
       ////////////////////////////////////////////Apuesta ////////////////////////////////////////

        if($resp[0]==1 || $resp[0]==2)
        {      
               $consultaApuesta=Apuesta::where('cantidad',$apuesta)->first();

                if (count($consultaApuesta)==0) //si no existe se crea
                {
                  
                  $idA=DB::table('apuestas')->insertGetId
                  (['cantidad'=>$apuesta]);
                }
                else//si existe
                {
                  $idA=$consultaApuesta->id;
                }

                $idAs=DB::table('apuesta_jugada')->insertGetId
                (['apuesta_id'=>$idA,'jugada_id'=>$idJ]);

                DB::table('jugadas')->where('id',$idJ)->update(['acumulado'=>$acumulado+$apuesta]);
        }

        

      return($resp);
      
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