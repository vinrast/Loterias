<?php

namespace App\Http\Controllers;


use Request;
use App\Usuario;
use App\Perfil;
use App\Vista;
use App\Maxima;
use App\Jugada;
use App\Apuesta;
use Carbon\Carbon;
use Session;
use DB;

class Cargar extends Controller

{

    public function login()
    {
      
        
        Session::forget('modulos');
        Session::forget('submodulos');
        Session::forget('usuario');
        return view('login');
       
    }
    
    public function limite_jugadas()
    {
      $tipo=Request::get('datos');
      $tipos=["quiniela","pale","tripleta"];
      $consulta=DB::table('maximas')->where('id',1)->first();

      return((int)$consulta->$tipos[$tipo]);

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
        $jugadaId=$datos[5];
        $usuario=Session::get('usuario');
        $usuario=$usuario[0];

        

        $resp=[];


        $consultaJugada=Jugada::where('numero',$tripleta)->first();
        $consultaApuesta=Apuesta::where('cantidad',$apuesta)->first();
        $maxima=Maxima::where(['id'=>1])->first();
        
        $campo=$columnas[$tipoJugada-1];
       
        ////insertar jugada
        if (count($consultaJugada)==0 )//si no existe la jugada se crea
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
              
          if($apuesta>0 && $apuesta<=$maxima->$campo)
          {
               $idA=DB::table('apuestas')->insertGetId
              (['cantidad'=>$apuesta]);

              $acumulado=0;
          }

        }
        else if(count($consultaApuesta)>0)//si existe
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
                    $fecha=$this->obtenerFecha();
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
                           if(($apuesta<$diferencia) &&($apuesta>0))//apuesta permitida y quedan euros para apostar
                           {
                             array_push($resp,array($sorteosId[$i],$sorteosDe[$i],$tipoJugada,1,$diferencia-$apuesta));
                           
                             $idV=DB::table('ventas')->insertGetId
                            (['jugada_id'=>$idJ,'sorteo_id'=>$sorteosId[$i],'apuesta_id'=>$idA,'usuario'=>$usuario->username,'fila'=>$jugadaId+$i,'fecha'=>$fecha]);
                           }
                           else if($diferencia==$apuesta)//apuesta cumple con el limite de apuestas 
                           {
                             array_push($resp,array($sorteosId[$i],$sorteosDe[$i],$tipoJugada,2,0));
                               $idV=DB::table('ventas')->insertGetId
                            (['jugada_id'=>$idJ,'sorteo_id'=>$sorteosId[$i],'apuesta_id'=>$idA,'usuario'=>$usuario->username,'fila'=>$jugadaId+$i,'fecha'=>$fecha]);
                           }
                           else if($apuesta>$diferencia)//la apuesta excede los limites
                           {
                            array_push($resp,array($sorteosId[$i],$sorteosDe[$i],$tipoJugada,3,$diferencia));
                           }
                           else if(($apuesta<$diferencia) &&($apuesta==0))
                           {
                            array_push($resp,array($sorteosId[$i],$sorteosDe[$i],$tipoJugada,5,$diferencia));
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
   
    
    
    public function anularJugada()
    {
      $datos=Request::get('datos');
      $aux=0;
      for ($i=0; $i <count($datos) ; $i++) 
      { 
        $aux=$aux+(DB::table('ventas')->where('fila',$datos[$i])->delete());
      }


      return($aux);

    }

    public function obtenerApuesta($apuesta_id=48)
    {
      

      $apuesta=DB::table('apuestas')->where('id',$apuesta_id)->first();
      if(count($apuesta)!=0)
      {
        $apuesta=$apuesta->cantidad;
      }
      else
      {
        $apuesta=0;
      }


      return($apuesta);
    }

    public function obtenerAcumulado($sorteo_id=1,$jugada_id=110)
    {
      
      $acumulado=DB::table('jugada_sorteo')->where(['jugada_id'=>$jugada_id,'sorteo_id'=>$sorteo_id])->first();
      if(count($acumulado)!=0)
      {
        $acumulado=$acumulado->acumulado;
      }
      else
      {
        $acumulado=0;
      }

      return($acumulado);
    }





    public function NroTicket()
    {

      $preFijo="LTR-";

      $fecha=Carbon::now();
      $fecha=$fecha->format('dm');

      $numero=DB::table('maximas')->where('id',1)->first();
      $numero=$numero->ticket;
      $actualizar=DB::Table('maximas')->where('id',1)->update(['ticket'=>$numero->ticket+1]);

     
      return($preFijo.$fecha.$numero);
    }


    public function obtenerFecha()
    {
      $fecha=Carbon::now();
      $fecha=$fecha->toDateString();
      return($fecha);
    }
     public function obtenerHora()
    {
      $hora=Carbon::now();
      $hora=$hora->toTimeString();
      return($hora);
    }

    public function actualizarTransacciones($usuario,$idT)
    {
      
      

      $ventas=DB::table('ventas')->where('usuario',$usuario)->get();
     
      foreach ($ventas as $venta) 
      {
        DB::table('transacciones')->insert
        (['jugada_id'=>$venta->jugada_id,'sorteo_id'=>$venta->sorteo_id,'apuesta_id'=>$venta->apuesta_id,'ticket_id'=>$idT]);

         $acumulado=$this->obtenerAcumulado($venta->sorteo_id,$venta->jugada_id);
         $apuesta=($this->obtenerApuesta($venta->apuesta_id))+$acumulado;
         $consultaM=DB::table('jugada_sorteo')->where(['jugada_id'=>$venta->jugada_id,'sorteo_id'=>$venta->sorteo_id])->update(['acumulado'=>$apuesta]);
     

      }


    }


    public function generarTicket()
    {
      
     
     ////////Numero de ticket y fecha//////////////////
      $numero=$this->NroTicket();
      $fecha=$this->obtenerFecha();
      $hora=$this->obtenerHora();

     //////////////Usuario//////////////////////
      $usuario=Session::get('usuario');
      $usuario=$usuario[0];
     //////////////////////////////////////////// 

      //////////////insertar ticket////////////////////////////////////////
        $idT=DB::table('tickets')->insertGetId
      (['numero'=>$numero,'fecha'=>$fecha,'hora'=>$hora,'usuario'=>$usuario->username]);
      //////////////////////////////////////////////////////////////////////

     // /////////////////////Actualizar transacciones ////////////////////////
      $this->actualizarTransacciones($usuario->username,$idT);
     // /////////////////////////////////////////////////////////////////// 

     //  ////////////////Vaciar ventas //////////////////////////////////////////////
        $eliminar=DB::table('ventas')->where('usuario',$usuario->username)->delete();
     //  /////////////////////////////////////////////////////////////////////////////

      
     

      return($idT);

    }




    public function imprimirTicket($ticket_id)
    {
      
     $idT=$ticket_id;
     $total=0;
     $ventas=[];

     $sorteos=DB::table('sorteos')->get();
     $transacciones=DB::table('transacciones')->where('ticket_id',$idT)->get();
     $consulta=DB::table('tickets')->where('id',$idT)->first();

     foreach ($sorteos as $sorteo) 
     {
       
        $aux=[$sorteo->descripcion,[]];
        foreach ($transacciones as $transaccion) 
        {
          
          if ($transaccion->sorteo_id==$sorteo->id) 
          {
            $apuesta=DB::table('apuestas')->where(['id'=>$transaccion->apuesta_id])->first();
            $jugada=DB::Table('jugadas')->where(['id'=>$transaccion->jugada_id])->first();

           
            array_push($aux[1],[$jugada->numero,$apuesta->cantidad]);
            //array_push($aux[1],$apuesta->cantidad);
       
            $total=$total+$apuesta->cantidad;

          }
        }

        if($aux[1]!=[])
        {

         
       
          array_push($ventas,$aux);
        }
     }
     
       



        
       return view('ticket',['numero'=>$consulta->numero,'fecha'=>$consulta->fecha,'hora'=>$consulta->hora,'ventas'=>$ventas,'total'=>$total]);
    }
    



    public function apuesta()
    {
        
        $modulos=Session::get('modulos');
        $submodulos=Session::get('submodulos');
        $usuario=Session::get('usuario');
        $usuario=$usuario[0];
        $fecha=$this->obtenerFecha();
        $ventas=DB::table('ventas')->where(['usuario'=>$usuario->username,'fecha'=>$fecha])->get();
        $ventas_=[];
        $jugadaId=0;
        $total=0;
        if(count($ventas)!=0)
        {
          foreach ($ventas as $venta) 
          {
            $sorteo=DB::table('sorteos')->where('id',$venta->sorteo_id)->first();
            if($sorteo->disponible==1 && $fecha==$venta->fecha)//si el sorteo esta disponible y es la fecha del dia
            {
              $jugada=DB::table('jugadas')->where('id',$venta->jugada_id)->first();
              $apuesta=DB::table('apuestas')->where('id',$venta->apuesta_id)->first();
              $aux=[$sorteo->descripcion,$jugada->numero,$apuesta->cantidad,$venta->fila];
              $jugadaId=$venta->fila+1;
              $total=$total+$apuesta->cantidad;
              array_push($ventas_,$aux);
            }
            else
            {
              $eliminar=DB::table('ventas')->where('id',$venta->id)->delete();//elimina la venta
            }
          }

        }
        else
        {
          $ventas_=[];
        }

        $modulos=$modulos[0];
        $submodulos=$submodulos[0];

        $sorteos=DB::table('sorteos')->get();

        return view('apuesta',['modulos'=>$modulos,'submodulos'=>$submodulos,'sorteos'=>$sorteos,'ventas'=>$ventas_,'fila'=>$jugadaId,'total'=>$total]);
    }
   
    public function cerrarSession()
    {
        Session::forget('sidebar');
        Session::forget('modulos');
        Session::forget('usuario');
        Session::forget('submodulos');
        return 1;
    }
    public  function ordenarTripleta($vector)
    {
      $tripleta="";
      for ($i=0; $i < count($vector); $i++) 
      { 
          if($i==1 || $i==2)
          {
            $tripleta=$tripleta.'-'.(string)$vector[$i];
          }
          else if($i==0)
          {
            $tripleta=(String)$vector[$i];
          }
      }  

      return $tripleta;
    }


    public function jugadasGanadoras($premio1,$premio2,$premio3)
    {
      
      $respuesta=[[],[],[]];

     ///////////////////////quinielas/////////////////////////////////
     array_push($respuesta[0],[$premio1,"primerPremio"]);
     array_push($respuesta[0],[$premio2,"segundoPremio"]);
     array_push($respuesta[0],[$premio3,"tercerPremio"]);
     /////////////////////////////////////////////////////////////////


     /////////////////////pales///////////////////////////////////////
     $premio=[(integer)$premio1,(integer)$premio2];
     sort($premio,1);
     $premio=$this->ordenarTripleta($premio);
     array_push($respuesta[1],[$premio,"primerPremio"]);
    
     $premio=[(integer)$premio1,(integer)$premio3];
     sort($premio,1);
     $premio=$this->ordenarTripleta($premio);
     array_push($respuesta[1],[$premio,"segundoPremio"]);

     $premio=[(integer)$premio2,(integer)$premio3];
     sort($premio,1);
     $premio=$this->ordenarTripleta($premio);
     array_push($respuesta[1],[$premio,"tercerPremio"]);
     ////////////////////////////////////////////////////////////////


     ////////////////////tripletas////////////////////////////////////
     $premios=[(integer)$premio1,(integer)$premio2,(integer)$premio3];
     sort($premios,1);
     $tripleta=$this->ordenarTripleta($premios);
     array_push($respuesta[2],[$tripleta,"primerPremio"]);
     
     $premio=[(integer)$premio1,(integer)$premio2];
     sort($premio,1);
     $premio=$this->ordenarTripleta($premio);
     array_push($respuesta[2],[$premio,"segundoPremio"]);
    
     $premio=[(integer)$premio1,(integer)$premio3];
     sort($premio,1);
     $premio=$this->ordenarTripleta($premio);
     array_push($respuesta[2],[$premio,"segundoPremio"]);

     $premio=[(integer)$premio2,(integer)$premio3];
     sort($premio,1);
     $premio=$this->ordenarTripleta($premio);
     array_push($respuesta[2],[$premio,"segundoPremio"]);


     
     


     return $respuesta;
    }


    public function jGanadoras()
    {
      
      $premio1="12";
      $premio2="34";
      $premio3="20";
      $sorteo_id=2;


      return $this->jugadasGanadoras($premio1,$premio2,$premio3);//
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