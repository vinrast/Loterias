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
        Session::forget('usuario');
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
          Session::push('usuario',$usuario);
        

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
        $sorteosId=$datos[3];
        $sorteosDe=$datos[4];
        $usuario=Session::get('usuario');
        $usuario=$usuario[0];

        

        $resp=[];


        $consultaJugada=Jugada::where('numero',$tripleta)->first();
        $consultaApuesta=Apuesta::where('cantidad',$apuesta)->first();
        $maxima=Maxima::where(['id'=>1])->first();
        
        $campo=$columnas[$tipoJugada-1];
       
        ////insertar jugada
        if (count($consultaJugada)==0)//si no existe la jugada se crea
        {
           $idJ=DB::table('jugadas')->insertGetId
          (['numero'=>$tripleta,'tipo'=>$tipoJugada]);

          $acumulado=0;

        }
        else//si existe
        {
          $idJ=$consultaJugada->id;
        }
        ///////////////////////////////////////////////
        //insertar apuesta//////////////////////////
         if (count($consultaApuesta)==0)//si no existe la jugada se crea
        {
           $idA=DB::table('apuestas')->insertGetId
          (['cantidad'=>$apuesta]);

          $acumulado=0;

        }
        else//si existe
        {
          $idA=$consultaApuesta->id;
        }

        
        ///////////////////sorteoJugada/////////////////////////////
                  $longitud=count($sorteosId);
                  
                  for ($i=0; $i <$longitud ; $i++) 
                  { 
                    
                     $consultaSorteoJugada=DB::table('jugada_sorteo')->where(['jugada_id'=>$idJ,'sorteo_id'=>$sorteosId[$i]])->first();
                      if (count($consultaSorteoJugada)==0) //si no existe
                        {
                          $idSj=DB::table('jugada_sorteo')->insertGetId
                          (['jugada_id'=>$idJ,'sorteo_id'=>$sorteosId[$i]]);
                           $acumuladoSj=0;

                      
                         
                        }
                    else
                    {
                      $idSj=$consultaSorteoJugada->id;
                      $acumuladoSj=$consultaSorteoJugada->acumulado;
                    }

                    $consultaVentas=DB::table('ventas')->where(['jugada_id'=>$idJ,'sorteo_id'=>$sorteosId[$i]])->first();
                    if (count($consultaVentas)==0) 
                    {
                        # code...
                        
                        if ($acumuladoSj==$maxima->$campo)
                        {
                          array_push($resp,array($sorteosId[$i],$sorteosDe[$i],$tipoJugada,0,0));

                        }
                        else if($acumuladoSj<$maxima->$campo)
                        {

                           $diferencia=($maxima->$campo)-$acumuladoSj;
                           if($apuesta<$diferencia)//apuesta permitida y quedan euros para apostar
                           {
                             array_push($resp,array($sorteosId[$i],$sorteosDe[$i],$tipoJugada,1,$diferencia-$apuesta));
                           
                             $idV=DB::table('ventas')->insertGetId
                            (['jugada_id'=>$idJ,'sorteo_id'=>$sorteosId[$i],'apuesta_id'=>$idA,'usuario_id'=>$usuario->id]);
                           }
                           else if($diferencia==$apuesta)//apuesta cumple con el limite de apuestas 
                           {
                             array_push($resp,array($sorteosId[$i],$sorteosDe[$i],$tipoJugada,2,0));
                               $idV=DB::table('ventas')->insertGetId
                            (['jugada_id'=>$idJ,'sorteo_id'=>$sorteosId[$i],'apuesta_id'=>$idA,'usuario_id'=>$usuario->id]);
                           }
                           else if($apuesta>$diferencia)//la apuesta excede los limites
                           {
                            array_push($resp,array($sorteosId[$i],$sorteosDe[$i],$tipoJugada,3,$diferencia));
                           }
                           

                        }
                    }
                    else
                    {
                       array_push($resp,array($sorteosId[$i],$sorteosDe[$i],$tipoJugada,4,0));
                    }


                  }


     
        

      return($resp);
      
    }
   
    
     public function imprimirTicket()
    {
      
      $consultaM=DB::table('maximas')->where('id',2)->first();
     
      $fecha=date('d').'-'.date('m').'-'.date('y');//fecha del servidor
      $numero='ltr-'.date('d').date('m').'-'.$consultaM->ticket;
      $consultaM=DB::table('maximas')->where('id',2)->update(['ticket'=>$consultaM->ticket+1]);
      $usuario=Session::get('usuario');
      $usuario=$usuario[0];

       $idT=DB::table('tickets')->insertGetId
      (['numero'=>$numero,'fecha'=>$fecha,'usuario_id'=>$usuario->id]);


      $ventas=DB::table('ventas')->where('usuario_id',$usuario->id)->get();
      foreach ($ventas as $venta) 
      {
        DB::table('transacciones')->insert
        (['jugada_id'=>$venta->jugada_id,'sorteo_id'=>$venta->sorteo_id,'apuesta_id'=>$venta->apuesta_id,'ticket_id'=>$idT]);
      }

      $eliminar=DB::table('ventas')->where('usuario_id',$usuario->id)->delete();

      return([$fecha,$numero,$usuario->id]);

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