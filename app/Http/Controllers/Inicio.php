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

class Inicio extends Controller
{
   
	public function generar_nro_tickect()
   {
      $preFijo="LTR-";

      $fecha=Carbon::now();
      $fecha=$fecha->format('dmy');

      $numero=DB::table('maximas')->where('id',1)->first();
      $numero=(int)$numero->ticket;
      $actualizar=DB::table('maximas')->where('id',1)->update(['ticket'=>$numero+1]);

     
      return($preFijo.$fecha.$numero);  
   }

   public function obtener_usuario()
   {
       $usuario=Session::get('usuario');
       $usuario=$usuario[0];
       return($usuario->username);
   }

   public function obtener_fecha()
    {
      $fecha=Carbon::now();
      $fecha=$fecha->toDateString();
      return($fecha);
    }

     public function obtener_hora()
    {
      $hora=Carbon::now();
      $hora=$hora->toTimeString();
      return($hora);
    }


   public function insertar_dupleta($jugada,$tipo)//busca el id de la jugada en la tabla jugadas, de no existir la inserta ...retorna el id de la jugada
   {
   	 $consulta_jugada=DB::table('jugadas')->where(['numero'=>$jugada])->first();
   	 $resultado_consulta=count($consulta_jugada);

   	 if($resultado_consulta!=0)//si la jugada existe
   	 {
   	 	$jugada_id=$consulta_jugada->id;
   	 }
   	 else if($resultado_consulta==0)
   	 {
   	 	 $jugada_id=DB::table('jugadas')->insertGetId
          (['numero'=>$jugada,'tipo'=>$tipo]);
   	 }

   	 return($jugada_id);
   }




   public function insertar_apuesta($apuesta)//busca el id de la apuesta en la tabla apuestas, de no existir la inserta.......retorno el id de la apuesta
   {
   	 $consulta_apuesta=DB::table('apuestas')->where(['cantidad'=>$apuesta])->first();
   	 $resultado_consulta=count($consulta_apuesta);

   	 if($resultado_consulta!=0)
   	 {
   	 	$apuesta_id=$consulta_apuesta->id;
   	 }
   	 else if($resultado_consulta==0)
   	 {
   	 	$apuesta_id=DB::table('apuestas')->insertGetId
          (['cantidad'=>$apuesta]);

   	 }

   	 return($apuesta_id);
   }


   public function obtener_acumulado($jugada_id,$sorteo_id)//busca la asociacion de una jugada con un sorteo, de no existir la inserta ...retorno el acumulado y el id de la relacion
   {
   		$consulta_acumulado=DB::table('jugada_sorteo')->where(['jugada_id'=>$jugada_id,'sorteo_id'=>$sorteo_id])->first();
   		$resultado_consulta=count($consulta_acumulado);
   		$acumulado=array("acumulado"=>0,"id"=>null);


   		if($resultado_consulta!=0)//si existe un acumulado
   		{
   			$acumulado["acumulado"]=$consulta_acumulado->acumulado;
   			$acumulado["id"]=$consulta_acumulado->id;
   		}
   		else if ($resultado_consulta==0)//se crea la asociacion
   		{
   			$acumulado["id"]=DB::table('jugada_sorteo')->insertGetId
          (['jugada_id'=>$jugada_id,'sorteo_id'=>$sorteo_id,'acumulado'=>$acumulado["acumulado"]]);

   		}

   		return $acumulado;

   }


   public function validar_apuesta($limite,$acumulado,$apuesta,$jugada_id,$sorteo_id)//varifica si una apuesta se encuentra dentro de los limites
   {
   		
   		$aprobada=0;//0 negada, 1 aprovada 
   		$diferencia=(int)$limite-(int)$acumulado;//obtiene la cantidad de dinero disponible para la proxima apuesta
   		$consulta_ticket=$this->buscar_jugada_ticket($jugada_id,$sorteo_id);

   		if($consulta_ticket==0)//si no esta
   		{

		   		if($apuesta==0)
		   		{
		   			$codigo=0;//apuesta es igual a 0
		   			$aprobada=0;
		   		}
		   		else if($apuesta>0)
		   		{
		   			if($diferencia==0)
		   			{
		   				$codigo=1;//ya se a alcanzado el acumulado
		   				$aprobada=0;
		   			}
		   			else if($diferencia==$apuesta)
		   			{
		   				$codigo=2;//la apuesta cumple con el limite
		   				$aprobada=1;
		   			}
		   			else if($diferencia<$apuesta)
		   			{
		   				$codigo=3;//la apuesta excede la cantidad disponible
		   				$aprobada=0;
		   			}
		   			else if($diferencia>$apuesta)
		   			{
		   				$codigo=4;//la apuesta es aprobada y queda disponible
		   				$aprobada=1;
		   			}
		   		}
   		}
   		else if($consulta_ticket!=0)
   		{
   			$codigo=5;
   			$aprobada=0;

   		}


   		$retorno=array("diferencia"=>$diferencia,"codigo"=>$codigo,"aprobada"=>$aprobada);
   		return($retorno);


   }
   
   public function buscar_jugada_ticket($jugada_id,$sorteo_id)
   {
   		$usuario=Session::get('usuario');
     	   $usuario=$usuario[0];

   		$consulta_ticket=DB::table('ventas')->where(['jugada_id'=>$jugada_id,'sorteo_id'=>$sorteo_id,'usuario'=>$usuario->username])->first();
   		$resultado=count($consulta_ticket);
   		return($resultado);
   }

   public function insertar_tabla_ventas($jugada_id,$sorteo_id,$apuesta_id,$fila)
   {
   	
     $usuario=Session::get('usuario');
     $usuario=$usuario[0];
     $retorno=0;

     $fecha=Carbon::now();
     $fecha=$fecha->toDateString();


   	$inser=DB::table('ventas')->insert(['jugada_id'=>$jugada_id,'sorteo_id'=>$sorteo_id,'apuesta_id'=>$apuesta_id,'usuario'=>$usuario->username,'fila'=>$fila,'fecha'=>$fecha]);
   	if($inser)
   		{$retorno=1;}

   return($retorno);

   }

   public function actualizar_acumulado($relacion_id,$nuevo_acumulado)
   {
   		$resultado=DB::table('jugada_sorteo')->where(['id'=>$relacion_id])->update(['acumulado'=>$nuevo_acumulado]);
   		return($resultado);
   }

//////////////////////////////////////metodo principal////////////////////////////////////////////////////////////////

   public function verificar_apuesta()//verifica que la apuesta cumpla, si cumple ingresa en la tabla temporal, si no envia el mensaje
   {
		  $informacion=Request::get('informacion');
   		$tipos=["quiniela","pale","tripleta"];//0 quiniela 1 pale 2 tripleta
   		$aux=[];
   		$retorno=[];
   		$cantidad_mensajes=0;
   		$fila=(int)$informacion[4];
   		$jugada=$informacion[0];
   		$tipo=(int)$informacion[1];
   		$apuesta=(int)$informacion[2];
   		$sorteos=$informacion[3];
   		$cantidad_sorteos=count($sorteos);

   		$limite=DB::table('maximas')->where('id',1)->first();
         $aux_=$tipos[$tipo];
   		$limite=$limite->$aux_;


   		$jugada_id=$this->insertar_dupleta($jugada,$tipo+1);
   		$apuesta_id=$this->insertar_apuesta($apuesta);

   		for ($i=0; $i <$cantidad_sorteos ; $i++) 
   		{ 
   			
   			$acumulado=$this->obtener_acumulado($jugada_id,$sorteos[$i][1]);
   			$validacion_apuesta=$this->validar_apuesta($limite,$acumulado["acumulado"],$apuesta,$jugada_id,$sorteos[$i][1]);
   			if($validacion_apuesta["codigo"]!=4)
   				{
   					$cantidad_mensajes=$cantidad_mensajes+1;
   				}


   			if($validacion_apuesta["codigo"]==2 || $validacion_apuesta["codigo"]==4)
   			{
   				$respuesta_ins=$this->insertar_tabla_ventas($jugada_id,$sorteos[$i][1],$apuesta_id,$fila);
   				$actualizar_ac=$this->actualizar_acumulado($acumulado["id"],(int)$acumulado["acumulado"]+(int)$apuesta);
   				array_push($aux,array("codigo"=>$validacion_apuesta["codigo"],"aprobada"=>$validacion_apuesta["aprobada"],"diferencia"=>$validacion_apuesta["diferencia"],"fila"=>$fila,"sorteo"=>$sorteos[$i][0]));
   			   $fila=$fila+1;
            }
   			else
   			{

   				array_push($aux,array("codigo"=>$validacion_apuesta["codigo"],"aprobada"=>$validacion_apuesta["aprobada"],"diferencia"=>$validacion_apuesta["diferencia"],"fila"=>$fila,"sorteo"=>$sorteos[$i][0]));

   			}

   			

   		}
   		$retorno=[$aux,$cantidad_mensajes,$fila];//
   		$retorno=json_encode($retorno);
   		
   	return($retorno);
   			



   }
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

   
   public function obtener_usuario_modulos_submodulos()
   {
   	
   		$modulos=Session::get('modulos');
   		$modulos=$modulos[0];
        $submodulos=Session::get('submodulos');
        $submodulos=$submodulos[0];
        $usuario=Session::get('usuario');
        $usuario=$usuario[0];

        $retorno=[$modulos,$submodulos,$usuario];

        return($retorno);

   }

   public function obtener_ventas_usuario($username,$fecha)
   {
   		$eliminar_ventas=DB::table('ventas')->join('sorteos','sorteos.id','=','ventas.sorteo_id')->where(['ventas.usuario'=>$username,'sorteos.abierto'=>0])->delete();
   		
   		$consultar_ventas=DB::table('ventas')->join('sorteos','sorteos.id','=','ventas.sorteo_id')->join('jugadas','jugadas.id','=','ventas.jugada_id')->join('apuestas','apuestas.id','=','ventas.apuesta_id')
   		->select('ventas.id as id','ventas.jugada_id as jugada_id','ventas.sorteo_id as sorteo_id',
   				 'ventas.apuesta_id as apuesta_id','ventas.usuario as usuario','ventas.fila as fila',
   				 'ventas.fecha as fecha','sorteos.descripcion as sorteo','jugadas.numero as jugada','apuestas.cantidad as apuesta')
   		->where(['ventas.usuario'=>$username,'sorteos.abierto'=>1])->orderBy('fila','asc')->get();

   		$resultado=count($consultar_ventas);
   		if($resultado!=0)
   			{$retorno=$consultar_ventas;}
   		else
   			{$retorno=null;}

   		return($retorno);
   }


   public function obtener_sorteos()
   {
   		$obtener_sorteos=DB::table('sorteos')->where('disponible','=',1)->get();
   		$resultado=count($obtener_sorteos);
   		if($resultado!=0)
   			{$retorno=$obtener_sorteos;}
   		else
   		{$retorno=null;}

   	return($retorno);
   }


   public function obtener_total_ventas($ventas)
   {
   	 $total=0;
   	 foreach ($ventas as $venta) 
   	 {
   	 	$total=$total+(int)$venta->apuesta;
   	 }

   	 return($total);
   }


   
   public function vista_apuesta()
   {
   		$datos=$this->obtener_usuario_modulos_submodulos();
   		$modulos=$datos[0];
   		$submodulos=$datos[1];
   		$usuario=$datos[2];


   		$total_ventas=0;
   		$proxima_jugada=0;//fila


   		$sorteos=$this->obtener_sorteos();
   		$fecha=$this->obtener_fecha();
   		$ventas=$this->obtener_ventas_usuario($usuario->username,$fecha);
   		if($ventas!=null)//si existen ventas para el usuario
   		{
   			$total_ventas=$this->obtener_total_ventas($ventas);
            $aux=count($ventas);
            $proxima_jugada=($ventas[$aux-1]->fila)+1;
           
   		}


   		
            
   		 
   		 return view('apuesta',['modulos'=>$modulos,'submodulos'=>$submodulos,'sorteos'=>$sorteos,'ventas'=>$ventas,'fila'=>$proxima_jugada,'total'=>$total_ventas]);
   		
   }


   ////////////////////////////////////////////////////anular jugadas///////////////////////////////////////////////////////////////////////////////////////////////
   public function anular_jugadas()
   {
      $informacion=Request::get('informacion');
      $filas_apuestas=$informacion[0];
      $total_apuesta=(int)$informacion[1];
      $usuario=Session::get('usuario');
      $usuario=$usuario[0];

      $cantidad_jugadas=count($filas_apuestas);

      for ($i=0; $i <$cantidad_jugadas ; $i++) 
      { 
         
        $jugada=DB::table('ventas')->where(['fila'=>$filas_apuestas[$i][0],'usuario'=>$usuario->username])->first();
        $acumulado=DB::table('jugada_sorteo')->where(['jugada_id'=>$jugada->jugada_id])->first();
        $acumulado=(int)$acumulado->acumulado-(int)$filas_apuestas[$i][1];
        DB::table('jugada_sorteo')->where(['jugada_id'=>$jugada->jugada_id])->update(['acumulado'=>$acumulado]);

        DB::table('ventas')->where(['fila'=>$filas_apuestas[$i][0],'usuario'=>$usuario->username])->delete();
        $total_apuesta=$total_apuesta-$filas_apuestas[$i][1];


      }


      return($total_apuesta);
   }

   /////////////////////////////////////generar ticket ////////////////////////////////

   public function obtener_total($apuestas,$n)
   {
      $acumulado=0;
      for ($i=0; $i <$n ; $i++) 
      { 
         $acumulado=$acumulado+$apuestas[$i];
      }
      return($acumulado);
   }


   public function insertar_transacciones($filas,$n,$usuario,$ticket)
   {
      
    
      for ($i=0; $i <$n ; $i++) 
      { 
         $venta=DB::table('ventas')->where(['usuario'=>$usuario,'fila'=>$filas[$i]])->first();
         if(count($venta)!=0)
         {

         
            $transaccion=DB::table('transacciones')->insert
            (['jugada_id'=>$venta->jugada_id,'sorteo_id'=>$venta->sorteo_id,'apuesta_id'=>$venta->apuesta_id,'ticket_id'=>$ticket]);
          }

      }
     $eliminar_ventas=DB::table('ventas')->where(['usuario'=>$usuario])->delete();

    
      return(0);
   }

   public function obtener_ventas_s($ticket_id,$sorteo_id)//1 quiniela 2 pale 3 tripleta
   {
      
      $ventas=DB::table('transacciones')->join('sorteos','sorteos.id','=','transacciones.sorteo_id')->join('jugadas','jugadas.id','=','transacciones.jugada_id')->join('apuestas','apuestas.id','=','transacciones.apuesta_id')
         ->select('sorteos.descripcion as sorteo','jugadas.numero as tripleta','jugadas.tipo as tipo','sorteos.id as sorteo_id','apuestas.cantidad as cantidad')
         ->where(['transacciones.ticket_id'=>$ticket_id,'sorteos.id'=>$sorteo_id])->orderBy('tipo','desc')->get();

      $cantidad_ventas=count($ventas);

      if($cantidad_ventas!=0)
         {$retorno=$ventas;}
      else
         {$retorno=null;}
      return($retorno);
   }

   public function obtener_ventas_sorteo($ticket_id)
   {
      
      $sorteos=DB::table('sorteos')->get();
      $usuario=$this->obtener_usuario();
      $retorno=[];
     
      foreach ($sorteos as $sorteo) 
      {
         $aux=$sorteo->descripcion;
         $ventas=$this->obtener_ventas_s($ticket_id,$sorteo->id);
         
         if($ventas!=null)
         {
            array_push($retorno, array("".$aux=>$ventas));
         }

      }
     return $retorno;

     
   }


    
   public function imprimir_ticket($ticket_id)
   {
     $ventas=$this->obtener_ventas_sorteo($ticket_id);
     $ticket=DB::table('tickets')->where('id',$ticket_id)->first();

      return view('ticket',['numero'=>$ticket->numero,'fecha'=>$ticket->fecha,'hora'=>$ticket->hora,'ventas'=>$ventas,'total'=>$ticket->valor]);

   }
    public function generar_ticket()
    {
       $informacion=Request::get('informacion');
       $ventas_filas=$informacion[0];
       $ventas_apuestas=$informacion[1];
       $usuario=$this->obtener_usuario();
       $cantidad_jugadas=count($ventas_filas);

       $nro_ticket=$this->generar_nro_tickect();
       $valor_ticket=$this->obtener_total($ventas_apuestas,$cantidad_jugadas);
       $fecha=$this->obtener_fecha();
       $hora=$this->obtener_hora();
       //$ventas=$this->obtener_ventas_sorteo(); 



     $ticket_id=DB::table('tickets')->insertGetId
         (['numero'=>$nro_ticket,'fecha'=>$fecha,'hora'=>$hora,'usuario'=>$usuario,'valor'=>$valor_ticket]);

     $transacciones=$this->insertar_transacciones($ventas_filas,$cantidad_jugadas,$usuario,$ticket_id);



   
    
    return $ticket_id;
    }


    public function pagar_ticket($numero="LTR-27071")
    {
      $registros=DB::table('p_tickets')->where('nro_ticket',$numero)->get();
      $fecha=$this->obtener_fecha();
      $usuario=$this->obtener_usuario();
      


      foreach ($registros as $pago) 
      {
        $insertar=DB::table('pago_tickets')->insert//registra las jugadas que fueron pagas para unticket
          (['nro_ticket'=>$pago->nro_ticket,'sorteo'=>$pago->sorteo,'premio'=>$pago->premio,'jugada'=>$pago->jugada,'tipo'=>$pago->tipo,'apuesta'=>$pago->apuesta,'pago'=>$pago->pago,'usuario'=>$usuario,'fecha'=>$fecha]);
      }

      $eliminar_ventas=DB::table('p_tickets')->where('nro_ticket',$numero)->delete();

      if($eliminar_ventas!=0 && $insertar!=0)
        {$retorno=1;}
      else
        {$retorno=0;}
      
      return $retorno;

    }

    public function premios_ticket($numero="LTR-27077")
    {
      $fecha=DB::table('tickets')->where('numero',$numero)->first();
      $fecha=$fecha->fecha;
      $jugadas=DB::table('p_tickets')->join('s_jugadas','s_jugadas.sorteo','=','p_tickets.sorteo')->select('p_tickets.nro_ticket as nro_ticket','p_tickets.sorteo as sorteo',
                                                                                                           'p_tickets.jugada as jugada','p_tickets.premio as premio','p_tickets.apuesta as apuesta',
                                                                                                           'p_tickets.pago as pago','s_jugadas.jugada as ganadora')
                                                                                                  ->where(['p_tickets.nro_ticket'=>$numero,'s_jugadas.fecha'=>$fecha])->get();

      $sorteos_pendientes=DB::table('s_jugadas')->where(['fecha'=>$fecha,'jugada'=>'XX-XX-XX'])->get();
     
      return [$jugadas,$sorteos_pendientes];

    }


    public function restar_acumulados($transacciones)
    {
      foreach ($transacciones as $transaccion) 
      {
        $acumulado=DB::table('jugada_sorteo')->where(['jugada_id'=>$transaccion->jugada_id,'sorteo_id'=>$transaccion->sorteo_id])->first();
        
        $acumulado=$acumulado->acumulado;

        $apuesta=DB::table('apuestas')->where('id',$transaccion->apuesta_id)->first();
        $apuesta=$apuesta->cantidad;

        $acumulado=$acumulado-$apuesta;

        $actualizar=DB::table('jugada_sorteo')->where(['jugada_id'=>$transaccion->jugada_id,'sorteo_id'=>$transaccion->sorteo_id])->update(['acumulado'=>$acumulado]);
      }
      return $acumulado;

    }


    public function anular_ticket($ticket_id)
    {
      $ticket=DB::table('tickets')->where('id',$ticket_id)->first();
      $numero=$ticket->numero;
      $usuario=$this->obtener_usuario();

      $insertar=DB::table('anulaciones')->insert//registrar los tickets anulados
          (['nro_ticket'=>$ticket->numero,'valor'=>$ticket->valor,'fecha'=>$ticket->fecha,'usuario'=>$usuario]);

      
      $transacciones=DB::table('transacciones')->where('ticket_id',$ticket_id)->get();
      
      $this->restar_acumulados($transacciones);
      ////////eliminaciones////////////////////////////
      $transacciones=DB::table('transacciones')->where('ticket_id',$ticket_id)->delete();
      $premiados=DB::table('p_tickets')->where('nro_ticket',$numero)->delete();
      
      $retorno=DB::table('tickets')->where('id',$ticket_id)->delete();
      return $retorno;
    }

///////////////abrir sistema//////////////////////////////////////////////////////////////////////////////
   public function abrir_sistema()
   {
     $cierres=DB::table('cierres')->where('echo',0)->get();//busca los turnos abiertos
     $cantidad=count($cierres);
     $retorno=0;
     if($cantidad==0)
     {

         $fecha=$this->obtener_fecha();
         ///////abrir los sorteos
         $sorteos=DB::table('sorteos')->where(['disponible'=>1])->update(['abierto'=>1]);
         ///////habilitar el registro de cierre
         DB::table('cierres')->insert
              (['fecha'=>$fecha,'echo'=>0]);
         //////habilitar registros para jugada del dia 
         $sorteos=DB::table('sorteos')->where(['disponible'=>1])->get();
         foreach ($sorteos as $sorteo) 
         {
           DB::table('s_jugadas')->insert
             (['sorteo'=>$sorteo->descripcion,'jugada'=>"XX-XX-XX",'fecha'=>$fecha,'status'=>""]);
         }
         $retorno=1;
      }

     return $retorno;
     
   }


}
