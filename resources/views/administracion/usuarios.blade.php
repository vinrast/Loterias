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
					
					@foreach($usuarios as $usuario)
							<div class="usuarios" id="listaUsuarios">
								<p class="usuarionombre" id="usuario{{$usuario->id}}">{{$usuario->username}}</p>
								<div class="acciones">
									<a href="#modaledit"  id="edit{{$usuario->id}}"><i class="small editar material-icons">mode_edit</i></a>
									<a href="" id="elim{{$usuario->id}}"><i class="borrar small material-icons">delete</i></a>
								</div>
							</div>
					@endforeach

				</div>
			</div>

<!--/////////////////////////////////////    MODAL DE AGREGAR USUARIOS  ////////////////////////////////////////-->
			
			<div id="modaladd" class="modal addusuario">
				<form id="usuarioAgregar">
					 {{ csrf_field() }}
					<div class="modal-content">
				     	<h4>Agregar Usuario</h4>
				    	<div class="col s12 m12 l12 input-field">
		            		<input id="userAgr" type="text" class="validate" name="userAgr_">
	         				<label for="userAgr">Usuario</label>
		            	</div>
		            	<div class="col s12 m12 l12 input-field">
		            		<input id="passwordAgr" type="password" class="validate" name="passwordAgr_">
	         				<label for="passwordAgr">Contraseña</label>
		            	</div>
		            	<div class="input-field col s12">
    						<select name="perfilAgr_" id="perfilAgr">
								<option value="0" disabled selected>Seleccione un perfil</option>
								<option value="1">Vendedor</option>
								<option value="2">Administrador</option>
						    </select>
    						<label>Tipo de perfil</label>
  						</div>
					</div>
	    			<div class="botonera-modal">
		    			<center>
		    				<button class="btn  waves-effect waves-light" type="button" name="insertarAgr" id="insUsuarioAgr">Guardar</button>
		    				<button class="btn  waves-effect red lighten-1" type="reset" name="restaurarAgr" id="resUsuarioAgr">Borrar</button>
		    			</center>
	    			</div>
				</form>
	    			
  			</div>
<!--///////////////////////////////////////// MODAL EDITAR /////////////////////////////////////////////////////-->			
			<div id="modaledit" class="modal editusuario">
				<form id="usuarioEditar">
				 {{ csrf_field() }}
					<div class="modal-content">
				     	<h4>Editar Usuario</h4>
				    	<div class="col s12 m12 l12 input-field">
		            		<input id="userEdit" type="text" class="validate" name="userEdit_">
	         				<label for="userEdit">Usuario</label>
		            	</div>
		            	<div class="col s12 m12 l12 input-field">
		            		<input id="passwordEdit" type="password" class="validate" name="passwordEdit_">
	         				<label for="passwordEdit">Contraseña</label>
		            	</div>
		            	<div class="input-field col s12">
    						<select name="perfilEdit_" id="perfilEdit">
								<option value="" disabled selected>Seleccione un perfil</option>
								<option value="1">Vendedor</option>
								<option value="2">Administrador</option>
						    </select>
    						<label>Tipo de perfil</label>
  						</div>
					</div>
	    			<div class="botonera-modal">
		    			<center>
		    				<button class="btn  waves-effect waves-light" type="button" name="insertarEdit_" id="insertarEdit">Guardar</button>
		    				<button class="btn  waves-effect red lighten-1" type="reset" name="restaurarEdit_" id="restaurarEdit">Borrar</button>
		    			</center>
	    			</div>
				</form>
	    			
  			</div>
		</div>
	</div>
@endsection