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
					
					@foreach($sorteos as $sorteo)
						<div class="col s12 m12 l12 registroloterias" id="registroloterias">
							<div class="col s12 m6 l6 loterianombre">{{$sorteo->descripcion}}</div>
							<div class="col s12 m2 l2 push-l5 acciones">
								
							</div>
						</div>
					@endforeach

				</div>
			</div>		
		</div>
	</div>
@endsection