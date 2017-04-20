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
	            	<form class="login" method="" action="#">
		            	<div class="col s12 m12 l12 input-field">
		            		<input id="user" type="text" class="validate">
	         				<label for="user">Usuario</label>
		            	</div>
		            	<div class="col s12 m12 l12 input-field">
		            		<input id="password" type="password" class="validate">
	         				<label for="password">Contraseña</label>
		            	</div>
		            	<div class="col s12 m12 l12 input-field">
		            		<a href="#" class="center-align">Olvidaste la Contraseña?</a>
		            	</div>
		            	<div class="row">
		            		<button class="btn  waves-effect red lighten-1" type="" name="action">Borrar</button>
	            			<button class="btn  waves-effect waves-light" type="submit" name="action">Entrar</button>
		            	</div>
	            	</form>
	            </div>
    		</div>
		</div>
	</div>
 
@endsection