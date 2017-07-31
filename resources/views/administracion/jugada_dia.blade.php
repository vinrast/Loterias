@extends('base2')
@section('title')
    Administracion
@endsection  
@section('contenido')
	@include('layouts/header')
	<div class="row">
			@include('layouts/sidebar')
		<div class="col s12 m9 l9 consola">

<!--//////////////////////////////////////// CONTENEDOR CON LISTADO DE USUARIOS ////////////////////////////////-->
			<div class="col s12 m8 l8 push-l2 contusuario">
				<div class="contusuariot" >
					<span>Resultados del Día</span>
				</div>
				<div class="col s12 m12 l12 contaddusuario ">

				</div>	
				<div class="col s12 m12 l12 contusuarioc">
					<p class="no_sorteo">No Hay Sorteos Abiertos Para Insertar Jugada Ganadora</p>
					@foreach($sorteos as $sorteo)
						<div class="col s12 m12 l12 registroloterias jugada">

							<div class="col s12 m5 l5">
								<div class="input-field descripcion">
		        					{{$sorteo->descripcion}}
		        				</div>
							</div>
							<div class="col s12 m4 l4">
								<div class="input-field  col s6 m4 l4">
		        					<input placeholder="1ro" id="primerPremio{{$sorteo->id}}" type="number" min="0" max="99" value="{{$jugada[$sorteo->descripcion][0]}}" class="validate" data-id="{{$sorteo->id}}" {{$sorteo->status}}>
		        				</div>
		        				<div class="input-field col s6 m4 l4">
		        					<input placeholder="2do" id="segundoPremio{{$sorteo->id}}" type="number" min="0" max="99" value="{{$jugada[$sorteo->descripcion][1]}}" class="validate" data-id="{{$sorteo->id}}" {{$sorteo->status}}>
		        				</div>
		        				<div class="input-field col s6 m4 l4">
		        					<input placeholder="3ro" id="tercerPremio{{$sorteo->id}}" type="number" min="0" max="99" value="{{$jugada[$sorteo->descripcion][2]}}" class="validate" data-id="{{$sorteo->id}}" {{$sorteo->status}}>
		        				</div>
							</div>
							<div class="col s12 m2 l2 ">
							@if($activos[$sorteo->descripcion]==1)
								<div class="input-field col s6 m4 l4" id="contenedor{{$sorteo->id}}">
		        					<a class="waves-effect light-blue lighten-3 btn-flat guardar_jugada" id="guardar{{$sorteo->id}}" data-id="{{$sorteo->id}}" data-descripcion="{{$sorteo->descripcion}}">Guardar</a>
		        				</div>
		        			@endif
							</div>
						</div>
					@endforeach

				</div>

				<div class="col l12 botonera center">
						<a class="waves-effect waves-light btn red" id="cierreDiario">Cerrar Turno</a>
						<a class="waves-effect waves-light btn" id="abrirDiario">Abrir Turno</a>
					</div>
			</div>		
		</div>
	</div>
@endsection