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
    if ($monto_total_ventas!=0) 
    {
    
      $porcentaje=(int)($monto_individual*$porcentaje)/$monto_total_ventas;
      $porcentaje=number_format($porcentaje,2,'.',',');//toma los 2 primeros decimales
    }
    else{$porcentaje=0;}
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

  public function obtener_jugadas_ganadoras($fecha)
  {
    $jugadas_p=[];
    $jugadas_s=DB::table('s_jugadas')->where('fecha',$fecha)->get();
    foreach ($jugadas_s as $jugada) 
    {
      $premios=DB::table('p_tickets')->where(['sorteo'=>$jugada->sorteo,'fecha'=>$fecha])->sum('pago');
      $actualizar=DB::table('s_jugadas')->where('id',$jugada->id)->update(['premios'=>$premios]);
      $jugadas_p[$jugada->sorteo]= array('jugada' => $jugada->jugada,'sorteo'=>$jugada->sorteo,'total'=>$premios);

    }
    return $jugadas_p;
  }

  public function obtener_anulaciones($fecha)
  {
    $anulaciones=[];
    $usuarios=DB::table('usuarios')->get();

    foreach ($usuarios as $usuario) 
    {
      $acumulado=DB::table('anulaciones')->where(['usuario'=>$usuario->username,'fecha'=>$fecha])->sum('valor');
      $consulta=DB::table('anulaciones')->where(['usuario'=>$usuario->username,'fecha'=>$fecha])->get();
      $cantidad=count($consulta);
      $anulaciones[$usuario->username]=array('usuario' =>$usuario->username,'cantidad'=>$cantidad,'valor'=>$acumulado );
    }
    return $anulaciones;
  }


 public function obtener_pagos($fecha)
 {
   $pagos=[];
   $usuarios=DB::table('usuarios')->get();

    foreach ($usuarios as $usuario) 
    {
      $acumulado=DB::table('pago_tickets')->where(['usuario'=>$usuario->username,'fecha'=>$fecha])->sum('pago');
      $consulta=DB::table('pago_tickets')->where(['usuario'=>$usuario->username,'fecha'=>$fecha])->get();
      $cantidad=count($consulta);
      $pagos[$usuario->username]=array('usuario' =>$usuario->username,'cantidad'=>$cantidad,'valor'=>$acumulado );
    }
    return $pagos;
 }


  public function resumen_diario_ventas($fecha)
  {
      
      $hora=$this->obtener_hora();
      $ventas_totales=DB::table('v_acumulados')->where('fecha',$fecha)->first();
      $ventas_sorteos=DB::table('s_acumulados')->where('fecha',$fecha)->orderBy('acumulado','desc')->get();
      $ventas_tipos=DB::table('t_acumulados')->where('fecha',$fecha)->orderBy('acumulado','desc')->get();
      $ventas_usuarios=DB::table('u_acumulados')->where('fecha',$fecha)->orderBy('acumulado','desc')->get();
      $ventas_top_jugadas=DB::table('j_acumulados')->where('fecha',$fecha)->take(10)->orderBy('acumulado','desc')->get();
      $ventas_top_quinielas=$this->obtener_top_jugadas(1,5,$fecha);
      $ventas_top_pales=$this->obtener_top_jugadas(2,5,$fecha);
      $ventas_top_tripletas=$this->obtener_top_jugadas(3,5,$fecha);
      $jugadas_ganadoras=$this->obtener_jugadas_ganadoras($fecha);
      $anulaciones=$this->obtener_anulaciones($fecha);
      $pagos=$this->obtener_pagos($fecha);

      




       return view('reporte_diario',['ventas_totales'=>$ventas_totales,
                                     'ventas_sorteos'=>$ventas_sorteos,
                                     'hora'=>$hora,
                                     'fecha'=>$fecha,
                                     'ventas_tipos'=>$ventas_tipos,
                                     'ventas_usuarios'=>$ventas_usuarios,
                                     'ventas_top_jugadas'=>$ventas_top_jugadas,
                                     'ventas_top_quinielas'=>$ventas_top_quinielas,
                                     'ventas_top_pales'=>$ventas_top_pales,
                                     'ventas_top_tripletas'=>$ventas_top_tripletas,
                                     'jugadas_ganadoras'=>$jugadas_ganadoras,
                                     'anulaciones'=>$anulaciones,
                                     'pagos'=>$pagos]);
    

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
        
        if ($acumulado==0){$porcentaje_v=0;$comision=0;}

        DB::table('u_acumulados')->insert
              (['usuario'=>$usuario->username,'fecha'=>$fecha,'acumulado'=>$acumulado,'porcentaje_v'=>$porcentaje_v,'comision'=>$comision]);
  
    
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

public function fecha_cierre()//si existe abiertos
{
  $cierre=DB::table('cierres')->where('echo',0)->first();
  if(count($cierre)!=0)
  {$fecha=$cierre->fecha;}
  else
  {$fecha=null;}
  
  return $fecha;

}

public function verificar_jugadas($fecha)
{
  
  $jugadas_ganadoras=DB::table('s_jugadas')->where(['fecha'=>$fecha,'jugada'=>'XX-XX-XX'])->get();//busca los sorteos que no poseen jugadas asociadas
  $pendientes=count($jugadas_ganadoras);
  if($pendientes==0)
    {$retorno=1;}//no existen jugadas pendientes
  else
    {$retorno=0;}//existen jugadas pendientes
  return $retorno;


}

public function cierre_diario()//realiza el cierre diario 
{
  $retorno=0;//1 si no se ha realizado la apertura 2 si existen jugadas pendientes
  $fecha=$this->fecha_cierre();
  if($fecha!=null)//null si no se identifico la apertura del sistema
  {
      $verificar=$this->verificar_jugadas($fecha);
      if($verificar==1)//si no existen sorteos pendientes por asociar jugadas 
      {
                $tickets=DB::table('tickets')->where('fecha',$fecha)->get();
                $cierre=DB::table('cierres')->where('fecha',$fecha)->first();
                  

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



            
        }
        else
        {
          $retorno=2;
        }
  }
  else
  {
    $retorno=1;
  }

  return [$retorno,$fecha]; 


}



///////////////////////////Reporte individual de ventas por rango/////////////////////////////////

public function ventas_rango($fecha_i="2017-07-31",$fecha_f="2017-08-1")
{
  $registros=DB::table('v_acumulados')->where('fecha','>=',$fecha_i)->where('fecha','<=',$fecha_f)->orderBy('fecha','desc')->get();
  $acumulado_c=DB::table('v_acumulados')->where('fecha','>=',$fecha_i)->where('fecha','<=',$fecha_f)->sum('c_acumulado');
  $acumulado_v=DB::table('v_acumulados')->where('fecha','>=',$fecha_i)->where('fecha','<=',$fecha_f)->sum('v_acumulado');
  $acumulado_t=DB::table('v_acumulados')->where('fecha','>=',$fecha_i)->where('fecha','<=',$fecha_f)->sum('t_acumulado');
  
  return [$registros,$acumulado_v,$acumulado_c,$acumulado_t];
}

public function reporte_ventas($fecha_i="2017-07-31",$fecha_f="2017-08-1")
{
  $ventas=$this->ventas_rango($fecha_i,$fecha_f);
  $fecha=$this->obtener_fecha();
  $hora=$this->obtener_hora();
  return view('reporte_ventas',['ventas'=>$ventas,'fecha_i'=>$fecha_i,'fecha_f'=>$fecha_f,'fecha'=>$fecha,'hora'=>$hora]);

}
///////////////////////////////////////Reporte individual de jugadas ganadoras por rango ////////////////////////////////////////////

public function obtener_descripcion_tabla($sorteos_id,$tabla,$campo)
{
   
   $n=count($sorteos_id);
   $descripciones=[];
   for ($i=0; $i <$n ; $i++) 
   { 
     $registro=DB::table($tabla)->where('id',$sorteos_id[$i])->first();

     array_push($descripciones,$registro->$campo);
   }

   return $descripciones;
}

public function transformar_fecha($fecha)
{
 $fecha_f=explode('-', $fecha);
 $fecha_f=Carbon::create($fecha_f[0],$fecha_f[1],$fecha_f[2]);
 return $fecha_f;
}

public function capturar_jugada($n,$fecha_b,$descripciones,$total)
{
  $registros=[];
  $acumulado=$total;
  for ($i=0; $i <$n ; $i++) 
      { 
        
        $dia=DB::table('s_jugadas')->where(['fecha'=>$fecha_b,'sorteo'=>$descripciones[$i]])->first();
        if (count($dia)!=0) 
        {
          $acumulado[$descripciones[$i]]=$acumulado[$descripciones[$i]]+$dia->premios;
          array_push($registros,$dia);
        }
          
        
      }

    return [$registros,$acumulado];
}

public function jugadas_sorteadas_rango($fecha_i,$fecha_f)
{
 
 
 $reporte=[];

 $sorteos_id=[1];
 $n_id=count($sorteos_id);
 $descripciones=$this->obtener_descripcion_tabla($sorteos_id,'sorteos','descripcion');

 $fecha_i=$this->transformar_fecha($fecha_i);
 $fecha_f=$this->transformar_fecha($fecha_f);
 $total=$this->inicializar_total($descripciones,$n_id);

 

   while ($fecha_i<=$fecha_f) 
   {
      $fecha_b=$fecha_i->toDateString();
      $resultado=$this->capturar_jugada($n_id,$fecha_b,$descripciones,$total);
      $temp=$resultado[0];//regitros
      $total=$resultado[1];

      if(count($resultado[0])!=0)//si se obtuvieron registros
        {
          $reporte[$fecha_i->toDateString()]=$temp;
        }
      
      
      $fecha_i=$fecha_i->addDay();//avanza a la siguienete fecha

   }


 
  return [$reporte,$total];

}

public function reporte_jugadas_sorteadas($fecha_i="2017-07-31",$fecha_f="2017-08-02")
{
  $hora=$this->obtener_hora();
  $fecha=$this->obtener_fecha();
  $resultado=$this->jugadas_sorteadas_rango($fecha_i,$fecha_f);
  $sorteos=$resultado[0];
  $total_p=$resultado[1];
  $total=array_sum($total_p);

   return view('reporte_jugadas_sorteadas',['sorteos'=>$sorteos,'fecha_i'=>$fecha_i,'fecha_f'=>$fecha_f,'fecha'=>$fecha,'hora'=>$hora,'acumulado'=>$total,'total_p'=>$total_p]);

}

/////////////////////////////////////////////Reporte individual ventas por sorteo////////////////////////////////////////////////////////////////////
public function capturar_acumulado($n,$fecha_b,$descripciones,$total,$tabla,$campo)//s_acumulados , sorteo
{
  $registros=[];
  $acumulado=$total;
  for ($i=0; $i <$n ; $i++) 
      { 
        
        $dia=DB::table($tabla)->where(['fecha'=>$fecha_b,$campo=>$descripciones[$i]])->first();
        if(count($dia)!=0)
          { 
            $acumulado[$descripciones[$i]]=$acumulado[$descripciones[$i]]+$dia->acumulado;
            array_push($registros,$dia);
          }
        
      }

    return [$registros,$acumulado];
}

public function inicializar_total($descripciones,$n)
{
 
  
  $arreglo=[];
  for ($i=0; $i <$n ; $i++) 
  { 
    $arreglo[$descripciones[$i]]=0;
    
  }
  return $arreglo;
}

public function ventas_sorteos_rango($fecha_i,$fecha_f)
{
  

 $reporte=[];

 $sorteos_id=[1,3];
 $n_id=count($sorteos_id);
 $descripciones=$this->obtener_descripcion_tabla($sorteos_id,'sorteos','descripcion');

 $fecha_i=$this->transformar_fecha($fecha_i);
 $fecha_f=$this->transformar_fecha($fecha_f);
 $total=$this->inicializar_total($descripciones,$n_id);


 

   while ($fecha_i<=$fecha_f) 
   {
      $fecha_b=$fecha_i->toDateString();
      $resultado=$this->capturar_acumulado($n_id,$fecha_b,$descripciones,$total,'s_acumulados','sorteo');
      $temp=$resultado[0];//regitros
      $total=$resultado[1];//acumulados

      if(count($resultado[0])!=0)//si se obtuvieron registros
        {
          $reporte[$fecha_i->toDateString()]=$temp;
        }
      
      
      $fecha_i=$fecha_i->addDay();//avanza a la siguienete fecha

   }


 
  return [$reporte,$total];
}

public function reporte_ventas_sorteo($fecha_i="2017-08-01",$fecha_f="2017-08-02")
{
  $hora=$this->obtener_hora();
  $fecha=$this->obtener_fecha();
  $resultado=$this->ventas_sorteos_rango($fecha_i,$fecha_f);
  $sorteos=$resultado[0];
  $total_p=$resultado[1];
  $total=array_sum($total_p);


   return view('reporte_ventas_sorteo',['sorteos'=>$sorteos,'fecha_i'=>$fecha_i,'fecha_f'=>$fecha_f,'fecha'=>$fecha,'hora'=>$hora,'acumulado'=>$total,'total_p'=>$total_p]);
}

  
///////////////////////////////////////Reporte individual de ventas por usuario ////////////////////////////////////////


public function ventas_usuario_rango($fecha_i,$fecha_f)
{
   $reporte=[];

   $usuarios_id=[1,2,4,5];
   $n_id=count($usuarios_id);
   $descripciones=$this->obtener_descripcion_tabla($usuarios_id,'usuarios','username');

   $fecha_i=$this->transformar_fecha($fecha_i);
   $fecha_f=$this->transformar_fecha($fecha_f);
   $total=$this->inicializar_total($descripciones,$n_id);

   while ($fecha_i<=$fecha_f) 
     {
        $fecha_b=$fecha_i->toDateString();
        $resultado=$this->capturar_acumulado($n_id,$fecha_b,$descripciones,$total,'u_acumulados','usuario');
        $temp=$resultado[0];//regitros
        $total=$resultado[1];//acumulados

        if(count($resultado[0])!=0)//si se obtuvieron registros
        {
          $reporte[$fecha_i->toDateString()]=$temp;
        }
        
        
        $fecha_i=$fecha_i->addDay();//avanza a la siguienete fecha

     }

 return [$reporte,$total];
}

public function reporte_ventas_usuario($fecha_i="2017-07-31",$fecha_f="2017-08-03")
{
  
  $hora=$this->obtener_hora();
  $fecha=$this->obtener_fecha();
  $resultado=$this->ventas_usuario_rango($fecha_i,$fecha_f);
  $usuarios=$resultado[0];
  $total_p=$resultado[1];
  $total=array_sum($total_p);
  

  return view('reporte_ventas_usuario',['usuarios'=>$usuarios,'fecha_i'=>$fecha_i,'fecha_f'=>$fecha_f,'fecha'=>$fecha,'hora'=>$hora,'acumulado'=>$total,'total_p'=>$total_p]);

}
///////////////////////////////// reporte pagos por usuario ///////////////////////////////////////////////////////////////

public function contar_tickets($fecha_i,$fecha_f,$username)
{
        $tickets=DB::table('pago_tickets')->where('fecha','>=',$fecha_i)->where('fecha','<=',$fecha_f)
                                          ->where('usuario','=',$username)->orderBy('fecha')->get();

        $cantidad=[];
        if(count($tickets)!=0)
        {
            foreach ($tickets as $ticket) 
            {
              if(in_array($ticket->nro_ticket,$cantidad)==false)
              {
                array_push($cantidad,$ticket->nro_ticket);
              }
            }
        }

        return count($cantidad);


}

public function sumar_pagos($fecha_i,$fecha_f,$username)
{
  $acumulado=DB::table('pago_tickets')->where('fecha','>=',$fecha_i)->where('fecha','<=',$fecha_f)
                                    ->where('usuario','=',$username)->sum('pago');

  return $acumulado;
}



public function pagos_por_rango($fecha_i,$fecha_f)
{
  $reporte=[];

  $usuarios_id=[1,2];
  $n_id=count($usuarios_id);
  $descripciones=$this->obtener_descripcion_tabla($usuarios_id,'usuarios','username');
  $fecha_i=$this->transformar_fecha($fecha_i);
  $fecha_f=$this->transformar_fecha($fecha_f);

  $tickets_periodo=$this->inicializar_total($descripciones,$n_id);
  $total_pagos=$this->inicializar_total($descripciones,$n_id);

  for($i=0;$i<$n_id;$i++)//obtiene los acumulados por usuario
  {
    $tickets_periodo[$descripciones[$i]]=$this->contar_tickets($fecha_i->toDateString(),$fecha_f->toDateString(),$descripciones[$i]);
    $total_pagos[$descripciones[$i]]=$this->sumar_pagos($fecha_i->toDateString(),$fecha_f->toDateString(),$descripciones[$i]);
  }



  while ($fecha_i<=$fecha_f) 
     {
        $fecha_b=$fecha_i->toDateString();
        $temp=[];
        $elementos=[];
        for ($i=0; $i <$n_id ; $i++) 
        { 
           
           
           $usuario=$descripciones[$i];
           $temp["tickets"]=$this->contar_tickets($fecha_b,$fecha_b,$descripciones[$i]);
           $temp["dinero"]=$this->sumar_pagos($fecha_b,$fecha_b,$descripciones[$i]);
           $temp["usuario"]=$descripciones[$i];
           array_push($elementos,$temp);
        }
       
      

        if(count($elementos)!=0)//si se obtuvieron registros
        {
          $reporte[$fecha_i->toDateString()]=$elementos;
        }
        
        
        $fecha_i=$fecha_i->addDay();//avanza a la siguienete fecha

     }
  return [$reporte,$tickets_periodo,$total_pagos];


}

public function reporte_pagos_usuario($fecha_i="2017-07-31",$fecha_f="2017-08-03")
{
  $hora=$this->obtener_hora();
  $fecha=$this->obtener_fecha();
  $resultado=$this->pagos_por_rango($fecha_i,$fecha_f);
  $reporte=$resultado[0];
  $cantidad_tickets=$resultado[1];
  $dinero_pagado=$resultado[2];
  $total_pagos=array_sum($dinero_pagado);
  $total_tickets=array_sum($cantidad_tickets);

  return view('reporte_pagos_usuario',['reporte'=>$reporte,
                                       'fecha_i'=>$fecha_i,
                                       'fecha_f'=>$fecha_f,
                                       'fecha'=>$fecha,
                                       'hora'=>$hora,
                                       'tickets_periodo'=>$cantidad_tickets,
                                       'dinero_periodo'=>$dinero_pagado,
                                       'acumulado_tickets'=>$total_tickets,
                                       'acumulado_pagos'=>$total_pagos]
                                       );

}


///////////////////// Reporte idividual , anulaciones /////////////////////////////////////////////////////////////////////////////////////
public function anulaciones_periodo($fecha_i,$fecha_f)
{
  $registros=DB::table('anulaciones')->where('fecha','>=',$fecha_i)
                                     ->where('fecha','<=',$fecha_f)
                                     ->get();
  return count($registros);
}


public function anulaciones_dinero($fecha_i,$fecha_f)
{
  $acumulado=DB::table('anulaciones')->where('fecha','>=',$fecha_i)
                                     ->where('fecha','<=',$fecha_f)
                                     ->sum('valor');
  return $acumulado;
}

public function anulaciones_usuario_periodo($fecha_i,$fecha_f,$username)
{
  $anulaciones=DB::table('anulaciones')->where('fecha','>=',$fecha_i)
                                       ->where('fecha','<=',$fecha_f)
                                       ->where('usuario','=',$username)->get();
  return count($anulaciones);
}

public function anulaciones_dinero_usuario($fecha_i,$fecha_f,$username)
{
  $anulaciones=DB::table('anulaciones')->where('fecha','>=',$fecha_i)
                                       ->where('fecha','<=',$fecha_f)
                                       ->where('usuario','=',$username)->sum('valor');
  return $anulaciones;
}


public function anulaciones_por_rango($fecha_i,$fecha_f)
{
  $reporte=[];

  $usuarios_id=[1,2];
  $n_id=count($usuarios_id);
  $descripciones=$this->obtener_descripcion_tabla($usuarios_id,'usuarios','username');
  $fecha_i=$this->transformar_fecha($fecha_i);
  $fecha_f=$this->transformar_fecha($fecha_f);
  
  $anulaciones_usuario=[];
  $dinero_usuario=[];
  for ($i=0; $i <$n_id ; $i++) //anulaciones por usuario durante el periodo
  { 
    $anulaciones_usuario[$descripciones[$i]]=$this->anulaciones_usuario_periodo($fecha_i->toDateString(),$fecha_f->toDateString(),$descripciones[$i]);
    

    $dinero_usuario[$descripciones[$i]]=$this->anulaciones_dinero_usuario($fecha_i->toDateString(),$fecha_f->toDateString(),$descripciones[$i]);
  
  }

  while ($fecha_i<=$fecha_f) 
     {
        $fecha_b=$fecha_i->toDateString();
        $temp=[];
        $elementos=[];
        for ($i=0; $i <$n_id ; $i++) 
        { 
           
           
           $usuario=$descripciones[$i];
           $temp["anulaciones"]=$this->anulaciones_usuario_periodo($fecha_b,$fecha_b,$descripciones[$i]);
           $temp["dinero"]=$this->anulaciones_dinero_usuario($fecha_b,$fecha_b,$descripciones[$i]);
           $temp["usuario"]=$descripciones[$i];
           array_push($elementos,$temp);
        }

        if(count($elementos)!=0)//si se obtuvieron registros
        {
          $reporte[$fecha_i->toDateString()]=$elementos;
        }
        
        
        $fecha_i=$fecha_i->addDay();

      }
       
      
   return [$reporte,$anulaciones_usuario,$dinero_usuario];

}


public function reporte_anulaciones_usuario($fecha_i="2017-07-31",$fecha_f="2017-08-03")
{
  
  $hora=$this->obtener_hora();
  $fecha=$this->obtener_fecha();
  $resultado=$this->anulaciones_por_rango($fecha_i,$fecha_f);
  $reporte=$resultado[0];
  $cantidad_anulaciones=$resultado[1];
  $dinero_anulado=$resultado[2];
  $total_dinero=array_sum($dinero_anulado);
  $total_anulaciones=array_sum($cantidad_anulaciones);

  return view('reporte_anulaciones_usuario',['reporte'=>$reporte,
                                       'fecha_i'=>$fecha_i,
                                       'fecha_f'=>$fecha_f,
                                       'fecha'=>$fecha,
                                       'hora'=>$hora,
                                       'anulaciones_periodo'=>$cantidad_anulaciones,
                                       'dinero_anulado'=>$dinero_anulado,
                                       'acumulado_anulaciones'=>$total_anulaciones,
                                       'acumulado_dinero'=>$total_dinero]
                                       );



}



















  ////////////////////////////////////Controladores vincen/////////////////////////////////
    public function index(){
      $modulos=\Session::get('modulos');
      $modulos=$modulos[0];
      $submodulos=\Session::get('submodulos');
      $submodulos=$submodulos[0];
      $usuario=\Session::get('usuario');
      $usuario=$usuario[0];
      $perfil=\DB::table('usuarios')->where('username','=',$usuario->username)->first();
      $reportes_asociados=\DB::table('perfil_reportes')
                              ->join('reportes','perfil_reportes.id_reportes', '=', 'reportes.id')  
                              ->where('perfil_reportes.id_perfiles','=',$perfil->perfil_id)
                              ->get();
      return view('reportes.index',['modulos'=>$modulos,'submodulos'=>$submodulos,'reportes'=>$reportes_asociados,'perfil'=>$perfil->perfil_id]);
    }

    public function crear_combo(){
      $datos=\Request::get('datos');
      $usuario=\Session::get('usuario');
      $usuario=$usuario[0];
      if ($datos[0]==2 || $datos[0]==3 || $datos[0]==4) {
        if ($datos[1]==1) {
          $consulta=\DB::table('usuarios')->get();
        }
        else{
          $consulta=\DB::table('usuarios')->where('username','=',$usuario->username)->get();
        }
      }
      return($consulta);
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

