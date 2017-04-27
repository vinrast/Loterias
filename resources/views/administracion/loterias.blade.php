@extends('base2')
@section('title')
    Administracion
@endsection  
@section('contenido')
	@include('layouts/header')
	<div class="row">
			@include('layouts/sidebar')
		<div class="col s12 m9 l9 consola">

<!--//////////////////////////////////////// CONTENEDOR CON LISTADO DE LOTERIAS ////////////////////////////////-->
			
			<div class="col s12 m8 l8 push-l2 contloteria">
				<div class="contloteriat" >
					<span>Loterias</span>
				</div>
				<div class="col s12 m12 l12 push-l5 contaddloteria">
					<a class="btn-floating btn-small waves-effect  indigo lighten-1" href="#modaladd"><i class="material-icons">note_add</i></a>
					<a class="btn-floating btn-small waves-effect  purple darken-1" href="#modalset"><i class="material-icons">power_settings_new</i></a>
				</div>
				<div class="col s12 m12 l12 contloteriac">
					<div class="registroloterias">
						<p class="loterianombre">Loteria Pale</p>
						<div class="acciones">
							<a href="#modaledit"><i class="small editar material-icons">mode_edit</i></a>
							<a href=""><i class="borrar small material-icons">delete</i></a>
						</div>
					</div>
				</div>
			</div>

<!--/////////////////////////////////////    MODAL DE AGREGAR LOTERIA  ////////////////////////////////////////-->
			
			<div id="modaladd" class="modal addloteria">
				<form class="#" action="#" method="#">
					<div class="modal-content">
				     	<h4>Agregar Loteria</h4>
				    	<div class="col s12 m12 l12 input-field">
		            		<input id="user" type="text" class="validate">
	         				<label for="user">Loteria</label>
		            	</div>
		            	<div class="col s12 m12 l10input-field">
		            		<label for="horatra">Hora de Transmision</label>
		            		<input id="horatra" type="time" class="validate">
		            	</div>
					</div>
	    			<div class="botonera-modal">
		    			<center>
		    				<button class="btn  waves-effect waves-light" type="submit" name="action">Guardar</button>
		    				<button class="btn  waves-effect red lighten-1" type="reset" name="action">Borrar</button>
		    			</center>
	    			</div>
				</form>
	    			
  			</div>
<!--///////////////////////////////////////// MODAL EDITAR /////////////////////////////////////////////////////-->			
			<div id="modaledit" class="modal editloteria">
				<form class="#" action="#" method="#">
					<div class="modal-content">
				     	<h4>Editar Loteria</h4>
				    	<div class="col s12 m12 l12 input-field">
		            		<input id="user" type="text" class="validate">
	         				<label for="user">Loteria</label>
		            	</div>
		            	<div class="col s12 m12 l10input-field">
		            		<label for="horatra">Hora de Transmision</label>
		            		<input id="horatra" type="time" class="validate">
		            	</div>
					</div>
	    			<div class="botonera-modal">
		    			<center>
		    				<button class="btn  waves-effect waves-light" type="submit" name="action">Guardar</button>
		    				<button class="btn  waves-effect red lighten-1" type="reset" name="action">Borrar</button>
		    			</center>
	    			</div>
				</form>
  			</div>
<!--///////////////////////// MODAL CONFIGURACION CIERRE TURNO//////////////////////////////////////////////////-->
			<div id="modalset" class="modal sethorario">
				<form class="#" action="#" method="#">
					<div class="modal-content">
				     	<h4>Tiempo para Cierre de Sorteos</h4>
				    	<div class="col s12 m12 l12 input-field">
		            		<select>
								<option value="" disabled selected>Seleccione una opcion</option>
								<option value="15">15 minutos</option>
								<option value="20">20 minutos</option>
								<option value="30">30 minutos</option>
							</select>
							<label>Tiempo anterior al sorteo</label>
		            	</div>
					</div>
	    			<div class="botonera-modal">
		    			<center>
		    				<button class="btn  waves-effect waves-light" type="submit" name="action">Guardar</button>
		    				<button class="btn  waves-effect red lighten-1" type="reset" name="action">Borrar</button>
		    			</center>
	    			</div>
				</form>
  			</div>

		</div>
	</div>
@endsection