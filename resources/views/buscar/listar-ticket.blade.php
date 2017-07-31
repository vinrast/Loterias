@extends('base2')
@section('title')
    Buscar Ticket
@endsection  
@section('contenido')
	@include('layouts/header')
	<div class="row">
			@include('layouts/sidebar')
		<div class="col s12 m9 l9 consola">

<!--//////////////////////////////////////// CONTENEDOR CON LISTADO DE TICKET ////////////////////////////////////////////////////-->
			<div class="col s12 m8 l8 push-l2 contusuario contticket">
				<div class="contusuariot" >
					<span>Lista de Tickets</span>
				</div>
				<div class="col s12 m12 l12 contaddusuario ">
					<div class="input-field col s12 m4 l4 push-l3">
						<i class="material-icons prefix">search</i>
						<input id="buscadorT" type="text" class="validate">
          				<label for="buscador">Buscar Ticket</label>
					</div>
				</div>	
				<div class="col s12 m12 l12 contusuarioc" id="listaTicket">
					<p class="no_ticket">No Se Encuentran Tickets en la Base de datos</p>
					@foreach($tickets as $ticket)
							<div class="col s12 m12 l12 registroloterias jugada"  name="_registro_" id="ticket{{$ticket["id"]}}" data-fecha="{{$ticket["fecha"]}}" data-numero="{{$ticket["numero"]}}" >

								<div class="col s12 m5 l5">
									<div class="input-field">
			        					{{$ticket["numero"]}}<br>
			        					{{"Fecha: ".$ticket["fecha"]."&nbsp;|&nbsp;".$ticket["hora"]}}
			        				</div>
			        				
								</div>
								<div class="col s12 m6 l6 push-l2">
								@foreach($ticket["botones"] as $botones)
									<div class="input-field  col s6 m4 l4" >
			        					<a href="#" class="accion-ticket boton_t" id="{{$botones["texto"].$ticket["id"]}}" data-descripcion="{{$botones["texto"]}}" data-id="{{$ticket["id"]}}" >{{$botones["texto"]}}</a>
			        				</div>
			        			@endforeach
			        				

								</div>
							</div>
					@endforeach

				</div>
			</div>	


			<!-- /////////////////////////////////////////modal pagar sorteo	///////////////////// -->
			<div id="modal_pagos" class="modal addusuario">
				
					<div class="modal-content">
				     	<h6 id="numeroT"></h6>

				    	<div class="col s12 m12 l12 contusuarioc">
		            		<table id="tablaPremios" data-ticket="" data-total="0" data-id="">
		            			

		            		</table>
		            	</div>
		            	
		            	
					</div>
	    			<div class="botonera-modal">
		    			<center>
		    				<button class="btn  waves-effect red lighten-1" type="button" name="cancelarPago" id="cancelarPago">Cancelar</button>
		    				<button class="btn  waves-effect waves-light" type="button" name="pagarTicket" id="pagarTicket">Pagar</button>
		    				

		    			</center>
	    			</div>
				
	    			
  			</div>
<!--   			////////////////////////////////////////////////////////////////////////////////////
 -->



		</div>
	</div>
@endsection