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
				<div class="col s12 m12 l12 contaddusuario ">
					<a class="btn-floating btn-small waves-effect  indigo lighten-1" href="#modaladd"><i class="material-icons">perm_identity</i></a>
				</div>
				<div class="col s12 m12 l12 contusuarioc">
					
					@foreach($usuarios as $usuario)
							<div class=" col s12 m12 l12 usuarios" id="listaUsuarios">
								<div class="col s12 m6 l6 usuarionombre" id="usuario{{$usuario->id}}">{{$usuario->username}}</div>
								<div class="col s12 m2 l2 push-l5 acciones">
									<a href="#modaledit" class="editar" data-registro="{{$usuario->id}}" id="edit{{$usuario->id}}"><i class="small material-icons">mode_edit</i></a>
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
								<option value="2">Vendedor</option>
								<option value="1">Administrador</option>
						    </select>
    						<label>Tipo de perfil</label>
  						</div>
					</div>
	    			<div class="botonera-modal">
		    			<center>
		    				<button class="btn  waves-effect red lighten-1" type="reset" name="restaurarAgr" id="resUsuarioAgr">Borrar</button>
		    				<button class="btn  waves-effect waves-light" type="button" name="insertarAgr" id="insUsuarioAgr">Guardar</button>
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
		            		<input id="userEdit" type="text" class="validate" placeholder="Usuario" name="userEdit_">
	         				
		            	</div>
		            	<div class="col s12 m12 l12 input-field">
		            		<input id="passwordEdit" type="password" class="validate" placeholder="Contraseña" name="passwordEdit_">
		            	</div>
		            	<div class="input-field col s12">
    						<select name="perfilEdit_" id="perfilEdit">
								<option value="" selected disabled>Seleccione un perfil</option>
								<option value="2">Vendedor</option>
								<option value="1">Administrador</option>
						    </select>
    						<label>Tipo de perfil</label>
  						</div>
					</div>
	    			<div class="botonera-modal">
		    			<center>
		    				<button class="btn  waves-effect red lighten-1" type="reset" name="restaurarEdit_" id="restaurarEdit">Borrar</button>
		    				<button class="btn  waves-effect waves-light" type="button" name="insertarEdit_" id="insertarEdit">Guardar</button>
		    			</center>
	    			</div>
				</form>
	    			
  			</div>
		</div>
	</div>
@endsection