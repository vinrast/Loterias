<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pare;
use DB;
use Carbon\Carbon;


class Reportes extends Controller
{


  //////////////////////////Controladores Tayupo////////////////////////////

 
  

  public function obtener_porcentaje($monto_total_ventas,$monto_individual,$porcentaje)
  {
    $porcentaje=(int)($monto_individual*$porcentaje)/$monto_total_ventas;
    $porcentaje=number_format($porcentaje,2,'.',',');//toma los 2 primeros decimales
    return $porcentaje;
  }

  public function obtener_comision($total_ventas,$porcentaje_C)
  {
    $porcentaje=(int)($porcentaje_C*$total_ventas)/100;
    $porcentaje=number_format($porcentaje,2,'.',',');//toma los 2 primeros decimales
    return $porcentaje;
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

  


  public function calcular_acumulado_tipo($tickets,$tipo,$total_ventas)
  {
    $acumulado=0;
    foreach ($tickets as $ticket) 
    {
      $acumulado=(int)$acumulado+(int)$this->acumulado_tipo_jugada($ticket->id,$tipo);
    }
    $porcentaje=$this->obtener_porcentaje($total_ventas,$acumulado,100);
    return [$acumulado,$porcentaje];
  }

  public function acumulado_tipo_jugada($ticket_id,$tipo)
  {
    
      $acumulado=DB::table('transacciones')->join('jugadas','jugadas.id','=','transacciones.jugada_id')->join('apuestas','apuestas.id','=','transacciones.apuesta_id')
                                          ->where(['transacciones.ticket_id'=>$ticket_id,'jugadas.tipo'=>$tipo])
                                          ->sum('apuestas.cantidad');

    
        return $acumulado;
  }


  public function obtener_top_jugadas($tipo,$top,$fecha)
  {
    $jugadas=DB::table('j_acumulados')->join('jugadas','j_acumulados.jugada','=','jugadas.numero')->select('j_acumulados.jugada as jugada','j_acumulados.acumulado as acumulado','j_acumulados.porcentaje_v as porcentaje_v')
                                     ->where(['j_acumulados.fecha'=>$fecha,'jugadas.tipo'=>$tipo])->take($top)->orderBy('acumulado','desc')->get();

    return $jugadas;
}


  public function resumen_diario_ventas()
  {
      $fecha=$this->obtener_fecha();
      $hora=$this->obtener_hora();
      $ventas_totales=DB::table('v_acumulados')->where('fecha',$fecha)->first();
      $ventas_sorteos=DB::table('s_acumulados')->where('fecha',$fecha)->orderBy('acumulado','desc')->get();
      $ventas_tipos=DB::table('t_acumulados')->where('fecha',$fecha)->orderBy('acumulado','desc')->get();
      $ventas_usuarios=DB::table('u_acumulados')->where('fecha',$fecha)->orderBy('acumulado','desc')->get();
      $ventas_top_jugadas=DB::table('j_acumulados')->where('fecha',$fecha)->take(10)->orderBy('acumulado','desc')->get();
      $ventas_top_quinielas=$this->obtener_top_jugadas(1,5,$fecha);
      $ventas_top_pales=$this->obtener_top_jugadas(2,5,$fecha);
      $ventas_top_tripletas=$this->obtener_top_jugadas(3,5,$fecha);



       return view('reporte_diario',['ventas_totales'=>$ventas_totales,
                                     'ventas_sorteos'=>$ventas_sorteos,
                                     'hora'=>$hora,
                                     'fecha'=>$fecha,
                                     'ventas_tipos'=>$ventas_tipos,
                                     'ventas_usuarios'=>$ventas_usuarios,
                                     'ventas_top_jugadas'=>$ventas_top_jugadas,
                                     'ventas_top_quinielas'=>$ventas_top_quinielas,
                                     'ventas_top_pales'=>$ventas_top_pales,
                                     'ventas_top_tripletas'=>$ventas_top_tripletas]);
    

  }


 
//////////////////////////////////////////////////////Cierre diario//////////////////////////////////////////////////////////////////

public function obtener_total_ventas($fecha)//ventas del dia actual
{
  
  $acumulado_ventas=DB::table('tickets')->where('fecha',$fecha)->sum('valor');
  return $acumulado_ventas;
}


public function obtener_ventas_usuario($total_ventas,$fecha)
{
  
  $usuarios=DB::table('usuarios')->get();
  foreach ($usuarios as $usuario ) 
  {
  
    $acumulado=0;
    $acumulado=$acumulado+(int)DB::table('tickets')->where(['fecha'=>$fecha,'usuario'=>$usuario->username])->sum('valor');
    $porcentaje_v=(string)$this->obtener_porcentaje($total_ventas,$acumulado,100)." %";
    $comision=$this->obtener_comision($acumulado,15);//indica el porcentaje que le corresponde

    if($acumulado>0)
    {
        DB::table('u_acumulados')->insert
              (['usuario'=>$usuario->username,'fecha'=>$fecha,'acumulado'=>$acumulado,'porcentaje_v'=>$porcentaje_v,'comision'=>$comision]);
  
    }
  }
 


}

public function obtener_ventas_sorteos($total_ventas,$fecha)
{
   
   $sorteos=DB::table('sorteos')->where('disponible',1)->get();
   $tickets=DB::table('tickets')->where('fecha',$fecha)->get();

   foreach ($sorteos as $sorteo) 
   {
     
   
        $acumulado=0;
        foreach ($tickets as $ticket) 
        {
          
          $acumulado=(int)$acumulado+(int)DB::table('transacciones')->join('apuestas','transacciones.apuesta_id','=','apuestas.id')
                                                                      ->where(['transacciones.ticket_id'=>$ticket->id,'transacciones.sorteo_id'=>$sorteo->id])
                                                                      ->sum('apuestas.cantidad');
        }
       
        if($acumulado!=0)
        {
          $porcentaje=(string)$this->obtener_porcentaje($total_ventas,$acumulado,100)." %";
        }
        else if($acumulado==0)
        {
          $porcentaje="0 %";
        }
          
        
         DB::table('s_acumulados')->insert
          (['sorteo'=>$sorteo->descripcion,'fecha'=>$fecha,'acumulado'=>$acumulado,'porcentaje_v'=>$porcentaje]);
    }
      


}

public function obtener_ventas_tipo_jugada($total_ventas,$tickets_dia,$fecha)
{
         $resultado=$this->calcular_acumulado_tipo($tickets_dia,1,$total_ventas);
         $porcentaje=(string)$resultado[1]." %";

         DB::table('t_acumulados')->insert
         (['tipo_jugada'=>'Quiniela','fecha'=>$fecha,'acumulado'=>$resultado[0],'porcentaje_v'=>$porcentaje]);
         

         $resultado=$this->calcular_acumulado_tipo($tickets_dia,2,$total_ventas);
         $porcentaje=(string)$resultado[1]." %";
         
         DB::table('t_acumulados')->insert
         (['tipo_jugada'=>'Pale','fecha'=>$fecha,'acumulado'=>$resultado[0],'porcentaje_v'=>$porcentaje]);


         $resultado=$this->calcular_acumulado_tipo($tickets_dia,3,$total_ventas);
         $porcentaje=(string)$resultado[1]." %";
         
         DB::table('t_acumulados')->insert
         (['tipo_jugada'=>'Tripleta','fecha'=>$fecha,'acumulado'=>$resultado[0],'porcentaje_v'=>$porcentaje]);




}

public function obtener_ventas_jugada($total_ventas,$fecha)
{
    $jugadas=DB::table('jugadas')->get();
    foreach ($jugadas as $jugada) 
    {
      $acumulado=0;
      $acumulado=DB::table('jugada_sorteo')->where([['jugada_id','=',$jugada->id],['acumulado','>',0]])->sum('acumulado');
      $porcentaje=(string)$this->obtener_porcentaje((int)$total_ventas,(int)$acumulado,100)." %";

      if ($acumulado>0) 
      {
         
         DB::table('j_acumulados')->insert
           (['jugada'=>$jugada->numero,'fecha'=>$fecha,'acumulado'=>$acumulado,'porcentaje_v'=>$porcentaje]);
       } 
        
    }


}

public function obtener_total_comisiones($fecha)
{
  $comisiones=DB::table('u_acumulados')->where('fecha',$fecha)->sum('comision');
  $comisiones=number_format($comisiones,2,'.',',');
  return $comisiones;

}

public function reiniciar_acumulados()
    {
      
      $acumulados=DB::table('jugada_sorteo')->delete();
    }

public function reiniciar_tickets()
{
  $actualizar=DB::table('maximas')->where('id',1)->update(["ticket"=>1]);
}

public function cerrar_sorteos()
{
  $sorteos=DB::table('sorteos')->where('disponible',1)->update(['abierto'=>0]);
}



public function cierre_diario()//realiza el cierre diario 
{
  $fecha=$this->obtener_fecha();
  $tickets=DB::table('tickets')->where('fecha',$fecha)->get();
  $cierre=DB::table('cierres')->where('fecha',$fecha)->first();
    if($cierre->echo==0)
    {

        
        $ventas_totales=$this->obtener_total_ventas($fecha);//obtiene las ventas del dia 
        $this->obtener_ventas_usuario($ventas_totales,$fecha);//obtiene las vetas del usuario y guarda los acumulados
        $this->obtener_ventas_sorteos($ventas_totales,$fecha,$tickets);//obtiene las ventas por sorteo
        $this->obtener_ventas_tipo_jugada($ventas_totales,$tickets,$fecha);//obtiene las ventas por tipo de jugada
        $this->obtener_ventas_jugada($ventas_totales,$fecha);//obtiene las ventas por jugada
        $comisiones=$this->obtener_total_comisiones($fecha);//obtiene el total de comisiones
        $ventas_descuento=$ventas_totales-$comisiones;//total descuentos
        $this->reiniciar_acumulados();
        $this->reiniciar_tickets();
        $this->cerrar_sorteos();

        DB::table('v_acumulados')->insert
            (['fecha'=>$fecha,'v_acumulado'=>$ventas_totales,'c_acumulado'=>$comisiones,'t_acumulado'=>$ventas_descuento]);


        DB::table('cierres')->where('id',$cierre->id)->update(['echo'=>1]);



        $retorno=1;
    }
    else if($cierre->echo==1)
    {
      $retorno=0;
    }

  return $retorno; 


}












  ////////////////////////////////////Controladores vincen/////////////////////////////////
    public function index(){
      $modulos=\Session::get('modulos');
      $modulos=$modulos[0];
      $submodulos=\Session::get('submodulos');
      $submodulos=$submodulos[0];
      return view('reportes.index',['modulos'=>$modulos,'submodulos'=>$submodulos]);
    }



    public function hora()
    {
      $consulta = DB::table('sorteos')->select('id','horaSorteo')->get();
      $cierre=DB::table('maximas')->select('tiempoCierre')->first();
    	$hora = date("h:i a",time());
      $hora_ = date("H:i:s",time());
      $mes = date("n",time());
      $dia = date("w",time());
      $dia_mes = date("j",time());
      $anio = date("Y",time());
      if ($cierre->tiempoCierre == 15) {
        for ($i=0; $i <count($consulta); $i++) { 
          $consulta[$i]->horaSorteo = date("H:i:s",strtotime ( '-15 minute' , strtotime ( $consulta[$i]->horaSorteo ) )) ;
        }
      }
      elseif($cierre->tiempoCierre == 20) {
        for ($i=0; $i <count($consulta); $i++) { 
          $consulta[$i]->horaSorteo = date("H:i:s",strtotime ( '-20 minute' , strtotime ( $consulta[$i]->horaSorteo ) )) ;
        }
      }
      elseif($cierre->tiempoCierre == 30) {
        for ($i=0; $i <count($consulta); $i++) { 
          $consulta[$i]->horaSorteo = date("H:i:s",strtotime ( '-30 minute' , strtotime ( $consulta[$i]->horaSorteo ) )) ;
        }
      }
      $resultado = array( $hora,
                          $hora_,
                          $mes,
                          $dia,
                          $anio,
                          $dia_mes,
                          $consulta,
                        );
    	return $resultado;
		
    }


   
}

