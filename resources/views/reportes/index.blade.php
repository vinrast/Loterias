@extends('base2')
@section('title')
    Administracion
@endsection  
@section('contenido')
	@include('layouts/header')
	<div class="row">
			@include('layouts/sidebar')
		<div class="col s12 m9 l9 consola">

<!--//////////////////////////////////////// XXXX ////////////////////////////////-->
	
			<div class="col s12 m12 l12 push-l1  contpremio">
				<form>
					<div class="col s12 m12 l12  ">
						<div class="confpremiot" >
							<span>Reportes</span>
						</div>
					</div>
					<div class="col s12 m9 l9 ">
						<div class="col s12 m3 l3">
								<input name="tiempo" type="radio" id="rango"  value="1" class="tiempo" checked/>
								<label for="rango">Rango</label>
		            	</div>
		            	<div class="col s12 m4 l4">
		            			<label>Desde</label>
								<input type="date" class="datepicker rango">	
		            	</div>
		            	<div class="col s12 m4 l4">
		            			<label>Hasta</label>
								<input type="date" class="datepicker rango">
		            	</div>
		            	<div class="col s12 m3 l3">
								<input name="tiempo" type="radio" id="opcion" value="2" class="tiempo" />
								<label for="opcion">Del</label>
		            	</div>
		            	<div class="col s12 m4 l4">
							<select name="opcion" class="browser-default opcion" disabled>
								<option value="" disabled selected>Seleccione una Opcion</option>
								<option value="1">Día</option>
								<option value="2">Día Anterior</option>
								<option value="3">Mes</option>
							</select>
		            	</div>
					</div>
					<div class="col s12 m12 l12 tiporeporte">
						<span>Tipo de Reporte</span>
		            </div>
					<div class="col s12 m9 l9 opcionesreporte">
		            	<div class="col s12 m4 l4">
		            		<input type="hidden" value="{{$perfil}}" id="perfil" />
							<select class="browser-default" id="combo_tipo_reporte">
								<option disabled selected>Seleccione una Opción</option>
							@foreach($reportes as $reporte)
								<option value="{{$reporte->id}}">{{$reporte->nombre_reporte}}</option>
							@endforeach
							</select>
		            	</div>
		            	<div class="col s12 m4 l4" id="cont_select">
		            		<select multiple class="browser-default combo_usuario">
								<option disabled selected></option>
							@foreach($reportes as $reporte)
								<option value="{{$reporte->id}}">{{$reporte->nombre_reporte}}</option>
							@endforeach
							</select>
		            	</div>
					</div>
					<div class="col s12 m12 l12 botoneraReporte">
						<a class="waves-effect waves-light btn red" >Limpiar</a>
						<a class="waves-effect waves-light btn" >Generar</a>
		            </div>
					

				</form>
			</div>
		</div>
	</div>
@endsection