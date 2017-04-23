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
					<span>Usuarios</span>
				</div>
				<div class="col s12 m12 l12 push-l5 contaddusuario ">
					<a class="btn-floating btn-small waves-effect  indigo lighten-1" href="#modaladd"><i class="material-icons">perm_identity</i></a>
				</div>
				<div class="col s12 m12 l12 contusuarioc">
					<div class="usuarios">
						<p class="usuarionombre">Vincen Santaella</p>
						<div class="acciones">
							<a href="#modaledit"><i class="small editar material-icons">mode_edit</i></a>
							<a href=""><i class="borrar small material-icons">delete</i></a>
						</div>
					</div>
				</div>
			</div>

<!--/////////////////////////////////////    MODAL DE AGREGAR USUARIOS  ////////////////////////////////////////-->
			
			<div id="modaladd" class="modal addusuario">
				<form class="#" action="#" method="#">
					<div class="modal-content">
				     	<h4>Agregar Usuario</h4>
				    	<div class="col s12 m12 l12 input-field">
		            		<input id="user" type="text" class="validate">
	         				<label for="user">Usuario</label>
		            	</div>
		            	<div class="col s12 m12 l12 input-field">
		            		<input id="password" type="password" class="validate">
	         				<label for="password">Contraseña</label>
		            	</div>
		            	<div class="input-field col s12">
    						<select>
								<option value="" disabled selected>Seleccione un perfil</option>
								<option value="1">Vendedor</option>
								<option value="2">Administrador</option>
						    </select>
    						<label>Tipo de perfil</label>
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
			<div id="modaledit" class="modal editusuario">
				<form class="#" action="#" method="#">
					<div class="modal-content">
				     	<h4>Editar Usuario</h4>
				    	<div class="col s12 m12 l12 input-field">
		            		<input id="user" type="text" class="validate">
	         				<label for="user">Usuario</label>
		            	</div>
		            	<div class="col s12 m12 l12 input-field">
		            		<input id="password" type="password" class="validate">
	         				<label for="password">Contraseña</label>
		            	</div>
		            	<div class="input-field col s12">
    						<select>
								<option value="" disabled selected>Seleccione un perfil</option>
								<option value="1">Vendedor</option>
								<option value="2">Administrador</option>
						    </select>
    						<label>Tipo de perfil</label>
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