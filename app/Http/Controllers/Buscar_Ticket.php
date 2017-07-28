<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pare;
use DB;
use Carbon\Carbon;


class Buscar_Ticket extends Controller{
    public function index(){
      $enlaces=["/imprimirTicket/","/anularTicket/","/pagarTicket/"];
      $modulos=\Session::get('modulos');
      $modulos=$modulos[0];
      $submodulos=\Session::get('submodulos');
      $submodulos=$submodulos[0];
      $tickets_v=[];
      $aux=[];

      $tickets=DB::table('tickets')->orderBy('hora','desc')->get();
      foreach ($tickets as $ticket) 
      {
      	$jugadas_g=DB::table('p_tickets')->where('nro_ticket',$ticket->numero)->orderBy('fecha','desc')->get();
      	
      	 $aux=array("id"=>$ticket->id,"numero"=>$ticket->numero,"fecha"=>$ticket->fecha,"hora"=>$ticket->hora,"valor"=>$ticket->valor,"botones"=>[array("enlace"=>$enlaces[0].$ticket->id,"texto"=>"Imprimir"),array("enlace"=>$enlaces[1].$ticket->id,"texto"=>"Anular")],"registros"=>[]);
      	$n=count($jugadas_g);

      	if($n!=0)
      	{
      		$boton=0;
      		foreach ($jugadas_g as $registro) 
      		{
      			
		      		if($boton==0)
		      			{array_push($aux["botones"],array("enlace"=>$enlaces[2].$ticket->id,"texto"=>"Pagar"));$boton=1;}
		      		
		      		array_push($aux["registros"],array("premio_id"=>$registro->id,"sorteo"=>$registro->sorteo,"jugada"=>$registro->jugada,"premio"=>$registro->premio,"apuesta"=>$registro->apuesta,"pago"=>$registro->pago));
      		}

      		
      	}
      	
      
      	array_push($tickets_v, $aux);
      }
     
     return view('buscar.listar-ticket',['modulos'=>$modulos,'submodulos'=>$submodulos,'tickets'=>$tickets_v]);
    }
}

