@extends('base2')
@section('title')
    Administracion
@endsection  
@section('contenido')
	@include('layouts/header')
	<div class="row">
			@include('layouts/sidebar')
		<div class="col s12 m9 l9  consola">

<!--//////////////////////////////////////// CONFIGURACION DE PREMIOS  ///////////////////////////////////////////////////////-->
			<div class="col s12 m12 l12 push-l1  contpremio">
				<form>
					<div class="col s12 m4 l4  ">
						<div class="confpremiot" >
							<span>Quiniela</span>
						</div>
						<div class="col s12 m12 l12 ">
							<div class="">
								<div class="col s12 m12 l12 input-field">
				            		<input id="1ero" type="number" class="validate">
			         				<label for="1ero">1era Posición</label>
				            	</div>
				            	<div class="col s12 m12 l12 input-field">
				            		<input id="2do" type="number" class="validate">
			         				<label for="2do">2da Posición</label>
				            	</div>
				            	<div class="col s12 m12 l12 input-field">
				            		<input id="3ra" type="number" class="validate">
			         				<label for="3ra">3ra Posición</label>
				            	</div>
							</div>
						</div>
					</div>
					<div class="col s12 m4 l4 ">
						<div class="confpremiot" >
							<span>Pale</span>
						</div>
						<div class="col s12 m12 l12 ">
							<div class="">
								<div class="col s12 m12 l12 input-field">
				            		<input id="1ero" type="number" class="validate">
			         				<label for="1ero">1era  y 2da Posición</label>
				            	</div>
				            	<div class="col s12 m12 l12 input-field">
				            		<input id="2do" type="number" class="validate">
			         				<label for="2do">1era  y 3ra Posición</label>
				            	</div>
				            	<div class="col s12 m12 l12 input-field">
				            		<input id="3ra" type="number" class="validate">
			         				<label for="3ra"> 2da y 3ra Posición</label>
				            	</div>
							</div>
						</div>
					</div>
					<div class="col s12 m4 l4 ">
						<div class="confpremiot" >
							<span>Tripleta</span>
						</div>
						<div class="col s12 m12 l12 ">
							<div class="">
								<div class="col s12 m12 l12 input-field">
				            		<input id="1ero" type="number" class="validate">
			         				<label for="1ero">Tripleta</label>
				            	</div>
				            	<div class="col s12 m12 l12 input-field">
				            		<input id="2do" type="number" class="validate">
			         				<label for="2do">2 de 3</label>
				            	</div>
							</div>
						</div>
					</div>
					<div class="col s12 m12 l12 botonera-premios">
		    			<center>
		    				<button class="btn  waves-effect red lighten-1" type="reset" name="action">Borrar</button>
		    				<button class="btn  waves-effect waves-light" type="submit" name="action">Guardar</button>
		    			</center>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection