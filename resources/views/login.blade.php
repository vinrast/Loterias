@extends('base')
@section('title')
    Login
@endsection  
@section('contenido')
    
	<div class="row">
		<div class="col s12 m4 l4 offset-m4 offset-l4">
			<div class="card">
	            <div class="container card-content">
	            	<span class="card-title center-align">Gestion de Loterias</span>
	            	<form class="login" method="post" action="/loginVerificar" id="formLogin" >
		            	 {{ csrf_field() }}
		            	<div class="col s12 m12 l12 input-field">
		            		<input id="user" name="usuario" type="text" class="validate">
	         				<label for="user">Usuario</label>
		            	</div>
		            	<div class="col s12 m12 l12 input-field">
		            			<input id="password" name="clave" type="password" class="validate">
	         				<label for="password">Contraseña</label>
		            	</div>
		            	<div class="col s12 m12 l12 input-field">
		            		<a href="#" class="center-align">Olvidaste la Contraseña?</a>
		            	</div>
		            	<div class="row">
		            		<button class="btn  waves-effect red lighten-1" type="reset" name="reiniciar">Borrar</button>
	            			<button class="btn  waves-effect waves-light" type="submit" name="ingre" id="Ingresar__">Entrar</button>
		            	</div>
	            	</form>
	            </div>
    		</div>
		</div>
	</div>
 
@endsection