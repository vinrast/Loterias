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
					<div class="col s12 m9 l9 ">
						<div class="col s12 m3 l3">
								<input name="group1" type="radio" id="test1" />
								<label for="test1">Rango</label>
		            	</div>
		            	<div class="col s12 m4 l4">
		            			<label>Desde</label>
								<input type="date" class="datepicker">	
		            	</div>
		            	<div class="col s12 m4 l4">
		            			<label>Hasta</label>
								<input type="date" class="datepicker">
		            	</div>
		            	<div class="col s12 m3 l3">
								<input name="group1" type="radio" id="test2" />
								<label for="test2">Del</label>
		            	</div>
		            	<div class="col s12 m4 l4">
							<select class="browser-default">
								<option value="" disabled selected>Seleccione una Opcion</option>
								<option value="1">Día</option>
								<option value="2">Día Anterior</option>
								<option value="3">Mes</option>
							</select>
		            	</div>
					</div>
					

				</form>
			</div>
		</div>
	</div>
@endsection