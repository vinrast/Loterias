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
		        					<input placeholder="1ro" id="primerPremio" type="number" min="0" max="99" class="validate">
		        				</div>
		        				<div class="input-field col s6 m4 l4">
		        					<input placeholder="2do" id="segundoPremio" type="number" min="0" max="99" class="validate">
		        				</div>
		        				<div class="input-field col s6 m4 l4">
		        					<input placeholder="3ro" id="tercerPremio" type="number" min="0" max="99" class="validate">
		        				</div>
							</div>
							<div class="col s12 m2 l2 ">
								<div class="input-field col s6 m4 l4">
		        					<a class="waves-effect light-blue lighten-3 btn-flat">Guardar</a>
		        				</div>
							</div>
						</div>
					@endforeach

				</div>
			</div>		
		</div>
	</div>
@endsection