<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use App\Pare;
use App\Usuario;
use App\Sorteo;
use DB;
use Carbon\Carbon;


class Administracion extends Controller{
  public function listar_usuarios(){
    $modulos=\Session::get('modulos');
    $modulos=$modulos[0];
    $submodulos=\Session::get('submodulos');
    $submodulos=$submodulos[0];
    $usuarios=DB::table('usuarios')->get();
    return view('administracion.usuarios',['modulos'=>$modulos,'submodulos'=>$submodulos,'usuarios'=>$usuarios]);
  }

  public function insertarUsuarios()
  {
    $user=strtoupper((string)Request::get('userAgr_'));
    $password=strtoupper((string)Request::get('passwordAgr_'));
    $perfil=Request::get('perfilAgr_');
    $consulta=Usuario::where('username',$user)->first();
    $resultado=[0,null,null];//existe,username,id
    
    if (count($consulta)!=0) //si existe
    {
        $resultado[1]=$consulta->username;
        $resultado[2]=$consulta->id;

    }     
    else//si no existe
    {
      
      $usuario_id=DB::table('usuarios')->insertGetId
          (

            ['username'=>$user,'password'=>$password,'perfil_id'=>$perfil]
          );

        $resultado[0]=1;
        $resultado[1]=$user;
        $resultado[2]=$usuario_id;

    }

    return($resultado);




  }


  public function listar_loterias()
  {
    $modulos=\Session::get('modulos');
    $modulos=$modulos[0];
    $submodulos=\Session::get('submodulos');
    $submodulos=$submodulos[0];
    $sorteos=DB::table('sorteos')->get();
    $maximas=DB::table('maximas')->first();
    return view('administracion.loterias',['modulos'=>$modulos,'submodulos'=>$submodulos,'sorteos'=>$sorteos,'maximas'=>$maximas]);
  }
  public function config_premio(){
    $modulos=\Session::get('modulos');
    $modulos=$modulos[0];
    $submodulos=\Session::get('submodulos');
    $submodulos=$submodulos[0];
    $quiniela=DB::table('premios')->where('id',1)->first();
    $pale=DB::table('premios')->where('id',2)->first();
    $tripleta=DB::table('premios')->where('id',3)->first();
    return view('administracion.configpremios',['modulos'=>$modulos,'submodulos'=>$submodulos,'quiniela'=>$quiniela,'pale'=>$pale,'tripleta'=>$tripleta]);
  }

  public function usuario_actual(){
    $id=Request::get('datos');
    $consulta=DB::table('usuarios')->where('id','=',$id)->first();
    if (count($consulta)==1) {
      $respuesta =  array(  $consulta->username,
                            $consulta->password,
                            $consulta->perfil_id,
                            1,
                    );
    }
    else{
      $respuesta = 0; 
    }     
      return $respuesta; 
  }

  public function modificar_usuario_actual(){
    $id=Request::get('iduser');
    $user=strtoupper((string)Request::get('userEdit_'));
    $password=strtoupper((string)Request::get('passwordEdit_'));
    $perfil=Request::get('perfilEdit_');
    $resultado=[0,null,null];//existe,username,id
    $consulta=DB::table('usuarios')->where('id','<>',$id)->where('username',$user)->first();
    if (count($consulta)!=0) {
      $resultado[1]=$consulta->username;
      $resultado[2]=$consulta->id;
    }     
    else{
      DB::table('usuarios')->where('id',$id)->update( 
                                                      [   'username'=>$user,
                                                          'password'=>$password,
                                                          'perfil_id'=>$perfil      
                                                      ]);
      $resultado[0]=1;
      $resultado[1]=$user;
      $resultado[2]=$id;
    }
    return $resultado;
  }

  public function borrar_usuario(){
    $id=Request::get('datos');
    $eliminar=0;
    $eliminar=DB::table('usuarios')->where('id', '=', $id)->delete();

    return $eliminar;
  }

  public function insertar_loteria(){
    $loteria=Request::get('data');
    $sorteo=ucwords(strtolower($loteria[0]));
    $resultado=[0,null,null];
    $consulta=Sorteo::where('descripcion',$sorteo)->first();
    if (count($consulta)!=0){
        $resultado[1]=$consulta->descripcion;
    }     
    else{
      $loteria_id=DB::table('sorteos')->insertGetId
          (

            ['descripcion'=>$sorteo,'horaSorteo'=>$loteria[1]]
          );

        $resultado[0]=1;
        $resultado[1]=$sorteo;
        $resultado[2]=$loteria_id;

    }

    return $resultado;
  }
  public function loteria_actual(){
    $id=Request::get('datos');
    $consulta=DB::table('sorteos')->where('id','=',$id)->first();
    if (count($consulta)==1) {
      $respuesta =  array(  $consulta->descripcion,
                            $consulta->horaSorteo,
                            1,
                    );
    }
    else{
      $respuesta = 0; 
    }     
      return $respuesta; 
  }
  public function modificar_loteria_actual(){
    $id=Request::get('idlotery');
    $loteria=ucwords(strtolower(Request::get('loteria_e')));
    $horat=ucwords(strtolower(Request::get('horatra_e')));
    $resultado=[0,null,null];//existe,username,id
    $consulta=DB::table('sorteos')->where('id','<>',$id)->where('descripcion',$loteria)->first();
    if (count($consulta)!=0) {
      $resultado[1]=$consulta->descripcion;
    }     
    else {
      DB::table('sorteos')->where('id',$id)->update( 
                                                      [   'descripcion'=>$loteria,
                                                          'horaSorteo'=>$horat,
                                                      ]);
      $resultado[0]=1;
      $resultado[1]=$loteria;
      $resultado[2]=$id;
    }
    return $resultado;
  }
  public function borrar_loteria(){
    $id=Request::get('datos');
    $eliminar=0;
    $eliminar=DB::table('sorteos')->where('id', '=', $id)->delete();

    return $eliminar;
  }
  public function actualizar_configuracion_general(){
    $respuesta=0;
    $id=Request::get('id');
    $quiniela=Request::get('quiniela');
    $pale=Request::get('pale');
    $tripleta=Request::get('tripleta');
    $tiempo=Request::get('tiempo');
    $consulta=DB::table('maximas')->where('id','=',$id)->first();
    if (count($consulta)==1) {
      DB::table('maximas')->where('id',$id)->update( 
                                                      [   'quiniela'=>$quiniela,
                                                          'pale'=>$pale,
                                                          'tripleta'=>$tripleta,
                                                          'tiempoCierre'=>$tiempo,
                                                      ]);
      $respuesta = 1;
    }
  return $respuesta;
  }
  public function actualizar_premios(){
    $respuesta=0;
    $qid=Request::get('qid');
    $pid=Request::get('pid');
    $tid=Request::get('tid');
    $q1=Request::get('q1');
    $q2=Request::get('q2');
    $q3=Request::get('q3');
    $p1=Request::get('p1');
    $p2=Request::get('p2');
    $p3=Request::get('p3');
    $t1=Request::get('t1');
    $t2=Request::get('t2');
    $consulta1=DB::table('premios')->where('id','=',$qid)->first();
    $consulta2=DB::table('premios')->where('id','=',$pid)->first();
    $consulta3=DB::table('premios')->where('id','=',$tid)->first();
    if (count($consulta1)==1 && count($consulta2)==1 && count($consulta3)==1 ) {
      DB::table('premios')->where('id',$qid)->update( 
                                                      [   'primerPremio'=>$q1,
                                                          'segundoPremio'=>$q2,
                                                          'tercerPremio'=>$q3 
                                                      ]);
      DB::table('premios')->where('id',$pid)->update( 
                                                      [   'primerPremio'=>$p1,
                                                          'segundoPremio'=>$p2,
                                                          'tercerPremio'=>$p3,
                                                      ]);
      DB::table('premios')->where('id',$tid)->update( 
                                                      [   'primerPremio'=>$t1,
                                                          'segundoPremio'=>$t2
                                                      ]);
      $respuesta = 1;
    }
  return $respuesta;
  }

   public function obtener_fecha()
    {
      $fecha=Carbon::now();
      $fecha=$fecha->toDateString();
      return($fecha);
    }



public function convertir_cadena($array)
{
  $longitud=count($array);
  $cadena="";


  for ($i=0; $i <$longitud ; $i++) 
  { 
        if($array[$i]>=0 && $array[$i]<=9)
        {
          $aux="0".(string)$array[$i];

        } else{$aux=(string)$array[$i];}

        if($i==1||$i==2)
        {
          $cadena=$cadena."-".$aux;
        }
        else
        {
          $cadena=$cadena.$aux;
        }

  }
  
  return $cadena;
}



public function calcular_jugadas_quinielas($jugada)
{
  $jugada=explode("-", $jugada);
  $quinielas=array("1er"=>(string)$jugada[0],"2do"=>(string)$jugada[1],"3er"=>(string)$jugada[2]);
  return $quinielas;
}

public function calcular_jugadas_pales($jugada="10-09-01")
{
  $jugada=explode("-",$jugada);
  $pale1=[(int)$jugada[0],(int)$jugada[1]];
  $pale2=[(int)$jugada[0],(int)$jugada[2]];
  $pale3=[(int)$jugada[1],(int)$jugada[2]];
  
 sort($pale1);
 sort($pale2);
 sort($pale3);
 
  $pale1=$this->convertir_cadena($pale1);
  $pale2=$this->convertir_cadena($pale2);
  $pale3=$this->convertir_cadena($pale3);

  $pales=array("1er"=>$pale1,"2do"=>$pale2,"3er"=>$pale3);

  return $pales;
}

public function calcular_jugadas_tripletas($jugada)
{
  $jugada=explode("-",$jugada);
  $tripleta=[(int)$jugada[0],(int)$jugada[1],(int)$jugada[2]];
  sort($tripleta);
  $tripleta=$this->convertir_cadena($tripleta);
  $tripletas=array("1er"=>$tripleta);
  return $tripletas;
  }
  

  public function buscar_transacciones($jugadas,$sorteo)
  {
   $fecha=$this->obtener_fecha();
   $tipos=array("1"=>"quiniela","2"=>"pale","3"=>"tripleta");
   $premios=array("1er"=>"primerPremio","2do"=>"segundoPremio","3er"=>"tercerPremio");

    foreach ($jugadas as $llave => $valor) 
    {
     
        $consulta=DB::table('tickets')->join('transacciones','tickets.id','=','transacciones.ticket_id')
                                    ->join('jugadas','transacciones.jugada_id','=','jugadas.id')
                                    ->join('sorteos','transacciones.sorteo_id','=','sorteos.id')
                                    ->join('apuestas','transacciones.apuesta_id','=','apuestas.id')
                                    ->select('tickets.numero as nro_ticket','sorteos.descripcion as sorteo','jugadas.numero as jugada',
                                              'jugadas.tipo as tipo','apuestas.cantidad as apuesta')
                                    ->where(['tickets.fecha'=>$fecha,'sorteos.descripcion'=>$sorteo,'jugadas.numero'=>$valor])->get();
      
        $c_registros=count($consulta);
        
        if($c_registros>0)
        {
          foreach ($consulta as $consulta) 
          {
            $premio=DB::table('premios')->where('id',$consulta->tipo)->first();
            if($llave=="1er")
            {
              
              $premio=$premio->primerPremio;
              $premio_="Primer premio";
            }
            else if($llave=="2do")
            {
              
              $premio=$premio->segundoPremio;
              $premio_="Segundo Premio";
            }
            else if($llave=="3er")
            {
              
              
              $premio=$premio->tercerPremio;
              $premio_="Tercer Premio";
            }
            
            $tipo=$tipos[$consulta->tipo];

    
            $pago=$consulta->apuesta*$premio;
            
            DB::table('p_tickets')->insert
            (
              ['nro_ticket'=>$consulta->nro_ticket,'sorteo'=>$consulta->sorteo,'jugada'=>$valor,'tipo'=>$tipo,'premio'=>$premio_,'apuesta'=>$consulta->apuesta,'pago'=>$pago,'fecha'=>$fecha]
            );
          }
            
        }

        

   }
   return 0;
 }

 public function cantidad_de_tickets($registros)
 {
   $tickets=[];
   foreach ($registros as $ticket) 
   {
    if(in_array($ticket->nro_ticket, $tickets)==FALSE)
      {array_push($tickets, $ticket->nro_ticket);}
   }

   return(count($tickets));
 }

public function buscar_tripletas($sorteo,$fecha)
{
  $tripletas=DB::table('tickets')->join('transacciones','transacciones.ticket_id','=','tickets.id')
                                ->join('jugadas','transacciones.jugada_id','=','jugadas.id')
                                ->join('sorteos','transacciones.sorteo_id','=','sorteos.id')
                                ->join('apuestas','transacciones.apuesta_id','=','apuestas.id')
                                ->select('tickets.numero as numero','tickets.fecha as fecha','jugadas.numero as jugada',
                                        'jugadas.tipo as tipo','sorteos.descripcion as sorteo','apuestas.cantidad as apuesta')

                                ->where(['jugadas.tipo'=>3,'sorteos.descripcion'=>$sorteo,'tickets.fecha'=>$fecha])
                                ->get();

  return $tripletas;
}

public function insertar_ganadores($jugadas,$ganadora,$dupletas,$fecha,$premios)
{
  
        foreach ($jugadas as $tripleta) 
        {
          if ($tripleta->jugada==$ganadora['1er']) //si coinciden 
          {
              DB::table('p_tickets')->insert
                  (

                    ['nro_ticket'=>$tripleta->numero,'sorteo'=>$tripleta->sorteo,'jugada'=>$tripleta->jugada,'tipo'=>'tripleta','premio'=>'Primer Premio','apuesta'=>$tripleta->apuesta,'pago'=>($premios->primerPremio*$tripleta->apuesta),'fecha'=>$fecha]
                  );//insertar en tickets premiados
          }
          else if($tripleta->jugada!=$ganadora['1er'])//si no coinciden  que las dupletas de uatripleta coincidan con las dupletas de otra 
          {
            $dupletas_tripleta=$this->calcular_jugadas_pales($tripleta->jugada);
            foreach ($dupletas_tripleta as $pale) 
            {
              if(in_array($pale,$dupletas)==true)
              {
                DB::table('p_tickets')->insert
                  (

                    ['nro_ticket'=>$tripleta->numero,'sorteo'=>$tripleta->sorteo,'jugada'=>$tripleta->jugada,'tipo'=>'tripleta','premio'=>'Segundo Premio','apuesta'=>$tripleta->apuesta,'pago'=>($premios->segundoPremio*$tripleta->apuesta),'fecha'=>$fecha]
                  );//insertar en tickets premiados
              }
            }

          }

        }



}


 public function tripletas_ganadoras($jugada,$sorteo)
 {
   
  $fecha=$this->obtener_fecha();
  $jugada_ganadora=$this->calcular_jugadas_tripletas($jugada);//trae la jugada ordenada
  $dupletas_ganadora=$this->calcular_jugadas_pales($jugada);//dupletas de la jugada ganadora
  $premios=DB::table('premios')->where('id',3)->first();//trae los premios configurados para tripletas
  
  ///obtener las tripletas para este sorteo revisa
  $consulta=$this->buscar_tripletas($sorteo,$fecha);

  //insertar verificar si existen jugadas premiadas para la tripleta e ingresar en la tabla de tciekts premiados
  $this->insertar_ganadores($consulta,$jugada_ganadora,$dupletas_ganadora,$fecha,$premios);


  return 0;
  
 }
  public function calcular_jugadas_ganadoras($jugada,$sorteo)
  {
    $fecha=$this->obtener_fecha();
    $retorno=[0,0,0];
    $quinielas=$this->calcular_jugadas_quinielas($jugada);
    $pales=$this->calcular_jugadas_pales($jugada);
    $tripletas=$this->calcular_jugadas_tripletas($jugada);
    $this->buscar_transacciones($quinielas,$sorteo);
    $this->tripletas_ganadoras($jugada,$sorteo);
    //$this->buscar_transacciones($tripletas,$sorteo);
    $this->buscar_transacciones($pales,$sorteo);

    ////////////////////////////// obtener cantidad de tickets premiados ///////////////////////////////////////
    $consulta=DB::table('p_tickets')->where(['fecha'=>$fecha,'sorteo'=>$sorteo])->orderBy('pago','desc')->get();
    $suma=DB::table('p_tickets')->where(['fecha'=>$fecha,'sorteo'=>$sorteo])->sum('pago');
    $n=$this->cantidad_de_tickets($consulta);
    if($n!=0)
    {
      $retorno=[1,$n,$suma];
    }


    return ($retorno);
  }
  
    
  public function insertar_jugada_ganadora()
{
  $datos=Request::get('datos');
  $cierre=DB::table('cierres')->where('echo',0)->first();//turno abierto
  $fecha=$cierre->fecha;
  $jugada=$datos[0];
  $sorteo=$datos[1];
  $consulta=DB::table('s_jugadas')->where(['fecha'=>$fecha,'sorteo'=>$sorteo])->first();
  $retorno=0;
  if($consulta->jugada=="XX-XX-XX")
  {
      
      $retorno=DB::table('s_jugadas')->where(['fecha'=>$fecha,'sorteo'=>$sorteo])->update(['jugada'=>$jugada,'status'=>'disabled']);
      $aux=$this->calcular_jugadas_ganadoras($jugada,$sorteo);
  }
  return ([$retorno,$aux]);
}
  

  public function insertar_jugada_dia(){
    
    $modulos=\Session::get('modulos');
    $modulos=$modulos[0];
    $submodulos=\Session::get('submodulos');
    $submodulos=$submodulos[0];
    $cierre=DB::table('cierres')->where('echo',0)->first();
    if(count($cierre)!=0)
    {
        $fecha=$cierre->fecha;

        $sorteos=DB::table('sorteos')->join('s_jugadas','sorteos.descripcion','=','s_jugadas.sorteo')->select('sorteos.descripcion as descripcion','sorteos.id as id','s_jugadas.jugada as jugada','s_jugadas.fecha as fecha','s_jugadas.status as status')
                                    ->where(['s_jugadas.fecha'=>$fecha])->get();

       $sorteos_jugadas=[];
       $sorteos_activos=[];
       foreach ($sorteos as $sorteo) 
       {
          $aux=["","",""];
          if ($sorteo->jugada!="XX-XX-XX") 
          {
            $jugada=explode("-",$sorteo->jugada);
            $sorteos_activos[$sorteo->descripcion]=0;
            if (count($jugada)==3) 
            {
              $aux[0]=$jugada[0];
              $aux[1]=$jugada[1];
              $aux[2]=$jugada[2];
            }
            elseif (count($jugada)==2) 
            {
              $aux[0]=$jugada[0];
              $aux[1]=$jugada[1];
            }
            elseif (condition) 
            {
              $aux[0]=$jugada;
            }
            $sorteos_jugadas[$sorteo->descripcion]=$aux;

          }
          else
          {
            $sorteos_activos[$sorteo->descripcion]=1;
            $sorteos_jugadas[$sorteo->descripcion]=$aux;
          }

       }
    
    }
    else
    {
      $sorteos_jugadas=[];
      $sorteos_activos=[];
      $sorteos=[];
    }
    return view('administracion.jugada_dia',['modulos'=>$modulos,'submodulos'=>$submodulos,'sorteos'=>$sorteos,'jugada'=>$sorteos_jugadas,'activos'=>$sorteos_activos]);
  }


  public function verificar()
  {
    $arreglo=array('1er'=>'33-44','2do'=>'90-09','3er'=>'78-98');
    
    foreach ($arreglo as $valores) 
    {
      echo $valores;
      echo "<br>";
    }
    return 0;
  }
}
