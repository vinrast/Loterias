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
						<input id="buscador" type="text" class="validate">
          				<label for="buscador">Buscar Ticket</label>
					</div>
				</div>	
				<div class="col s12 m12 l12 contusuarioc">
					<p class="no_ticket">No Se Encuentran Tickets en la Base de datos</p>
					<div class="col s12 m12 l12 registroloterias jugada">

						<div class="col s12 m5 l5">
							<div class="input-field">
	        					LTR-465465
	        				</div>
						</div>
						<div class="col s12 m6 l6 push-l2">
							<div class="input-field  col s6 m4 l4">
	        					<a href="#" class="accion-ticket">Imprimir</a>
	        				</div>
	        				<div class="input-field col s6 m4 l4">
	        					<a href="#" class="accion-ticket">Anular</a>
	        				</div>
	        				<div class="input-field col s6 m4 l4">
	        					<a href="#" class="accion-ticket">Pagar</a>
	        				</div>
						</div>
					</div>
				</div>
			</div>		
		</div>
	</div>
@endsection