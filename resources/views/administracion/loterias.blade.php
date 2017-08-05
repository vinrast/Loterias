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
				<div class="col s12 m12 l12  contaddloteria">
					<a class="btn-floating btn-small waves-effect  indigo lighten-1" id="agregarlotery" href="#modaladd"><i class="material-icons">note_add</i></a>
					<a class="btn-floating btn-small waves-effect  light-green accent-3" id="limiteVenta" href="#modallimit"><i class="material-icons">lock_outline</i></a>
				</div>
				<div class="col s12 m12 l12 contloteriac" id="contloteriac">
						@foreach($sorteos as $sorteo)
							<div class="col s12 m12 l12 registroloterias" id="registroloterias">
								<div class="col s12 m6 l6 loterianombre">{{$sorteo->descripcion}}</div>
								<div class="col s12 m2 l2 push-l5 acciones">
									<a href="#modaledit" id="edit{{$sorteo->id}}" data-registro="{{$sorteo->id}}" class="editarLoteria"><i class="editar small material-icons">mode_edit</i></a>
									<a href="#" id="elim{{$sorteo->id}}" data-registro="{{$sorteo->id}}" data-nombre="{{$sorteo->descripcion}}" class="borrarLoteria"><i class="borrar small material-icons">delete</i></a>
								</div>
							</div>
						@endforeach
				</div>
			</div>

<!--/////////////////////////////////////    MODAL DE AGREGAR LOTERIA  ////////////////////////////////////////-->
			
			<div id="modaladdLotery" class="modal addloteria">
				<form id="addlotery">
					{{ csrf_field() }}
					<div class="modal-content">
				     	<h4>Agregar Loteria</h4>
				    	<div class="col s12 m12 l12 input-field">
		            		<input id="loteria" type="text" name="loteria" class="validate">
	         				<label for="loteria">Loteria</label>
		            	</div>
		            	<div class="col s12 m12 l12">
		            		<label for="horatra">Hora de Transmision</label>
		            		<input id="horatra" name="horatra" type="time" class="validate">
		            	</div>
					</div>
	    			<div class="botonera-modal">
		    			<center>
		    				<button class="btn  waves-effect red lighten-1" type="reset" name="action">Borrar</button>
		    				<button class="btn  waves-effect waves-light" id="savelotery" type="submit" name="action">Guardar</button>
		    			</center>
	    			</div>
				</form>
	    			
  			</div>
<!--///////////////////////////////////////// MODAL EDITAR /////////////////////////////////////////////////////-->			
			<div id="modaleditlotery" class="modal editloteria">
				<form id="loteriaE">
					{{ csrf_field() }}
					<input type="hidden" name="idlotery" id="idlotery">
					<div class="modal-content">
				     	<h4>Editar Loteria</h4>
				    	<div class="col s12 m12 l12 input-field">
		            		<input id="loteria_e" name="loteria_e" type="text" placeholder="Loteria" class="validate">
		            	</div>
		            	<div class="col s12 m12 l12">
		            		<label for="horatra_e">Hora de Transmision</label>
		            		<input id="horatra_e" name="horatra_e" type="time" class="validate">
		            	</div>
					</div>
	    			<div class="botonera-modal">
		    			<center>
		    				<button class="btn  waves-effect red lighten-1" type="reset" name="action">Borrar</button>
		    				<button class="btn  waves-effect waves-light" type="submit" id="editarLoteria" name="action">Guardar</button>
		    			</center>
	    			</div>
				</form>
  			</div>
<!--///////////////////////// MODAL COFIGURACIONES GENERALES /////////////////////////////////////////////////////////////////-->
			<div id="modallimit" class="modal addusuario">
				<form id="formsetgen" >
					{{ csrf_field() }}
					<input type="hidden" value="{{$maximas->id}}" id="idregistro" name="id"></input>
					<div class="modal-content">
				     	<h4>Configuraciones Generales</h4>
				    	<div class="col s12 m12 l12 input-field">
		            		<input id="quini" type="number" name="quiniela" class="validate" value="{{$maximas->quiniela}}">
	         				<label for="quini">Limite para Quinielas</label>
		            	</div>
		            	<div class="col s12 m12 l12 input-field">
		            		<input id="pale" type="number" name="pale" class="validate" value="{{$maximas->pale}}">
	         				<label for="pale">Limite para Pales</label>
		            	</div>
		            	<div class="col s12 m12 l12 input-field">
		            		<input id="tripleta" type="number" name="tripleta" class="validate" value="{{$maximas->tripleta}}">
	         				<label for="tripleta">Limite para Tripletas</label>
		            	</div>
		            	<div class="col s12 m12 l12 input-field">
		            		<select class="browser-default" name="tiempo" id="tiempo">
		            		@if($maximas->tiempoCierre==15)
								<option value="" disabled>Tiempo de Cierre de Venta</option>
								<option value="15" selected>15 minutos</option>
								<option value="20">20 minutos</option>
								<option value="30">30 minutos</option>
							@elseif($maximas->tiempoCierre==20)
								<option value="" disabled>Tiempo de Cierre de Venta</option>
								<option value="15">15 minutos</option>
								<option value="20" selected>20 minutos</option>
								<option value="30">30 minutos</option>
							@elseif($maximas->tiempoCierre==30)
								<option value="" disabled>Tiempo de Cierre de Venta</option>
								<option value="15">15 minutos</option>
								<option value="20">20 minutos</option>
								<option value="30" selected>30 minutos</option>
							@else
								<option value="" disabled selected>Tiempo de Cierre de Venta</option>
								<option value="15">15 minutos</option>
								<option value="20">20 minutos</option>
								<option value="30">30 minutos</option>
							@endif
							</select>
		            	</div>
					</div>
	    			<div class="botonera-modal">
		    			<center>
		    				<button class="btn  waves-effect red lighten-1" type="button" id="resetgen" name="action">Borrar</button>
		    				<button class="btn  waves-effect waves-light" type="submit" id="setgen" name="action">Guardar</button>
		    			</center>
	    			</div>
				</form>		
  			</div>

		</div>
	</div>
@endsection