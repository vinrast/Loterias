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
			<div class="col s12 m12 l12 push-l1  contpremio">
				<form>
					<div class="col s12 m12 l12  ">
						<div class="confpremiot" >
							<span>Reportes</span>
						</div>
					</div>
					<div class="col s12 m6 l6 ">
							<div class="">
								<div class="input-field">
				            		<input id="1ero" type="number" class="validate">
			         				<label for="1ero">1era Posición</label>
				            	</div>
				            	<div class="input-field">
				            		<input id="2do" type="number" class="validate">
			         				<label for="2do">2da Posición</label>
				            	</div>
				            	<div class="input-field">
				            		<input id="3ra" type="number" class="validate">
			         				<label for="3ra">3ra Posición</label>
				            	</div>
							</div>
					</div>
					

				</form>
			</div>
		</div>
	</div>
@endsection