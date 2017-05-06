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
				<form id="formsetprem">
					{{csrf_field()}}
					<input name="qid" type="hidden" value="{{$quiniela->id}}"></input>
					<input name="pid" type="hidden" value="{{$pale->id}}"></input>
					<input name="tid" type="hidden" value="{{$tripleta->id}}"></input>
					<div class="col s12 m4 l4  ">
						<div class="confpremiot" >
							<span>Quiniela</span>
						</div>
						<div class="col s12 m12 l12 ">
							<div class="">
								<div class="col s12 m12 l12 input-field">
				            		<input id="1eroq" type="number" name="q1" class="validate" value="{{$quiniela->primerPremio}}">
			         				<label for="1eroq">1era Posición</label>
				            	</div>
				            	<div class="col s12 m12 l12 input-field">
				            		<input id="2doq" type="number" name="q2" class="validate" value="{{$quiniela->segundoPremio}}">
			         				<label for="2doq">2da Posición</label>
				            	</div>
				            	<div class="col s12 m12 l12 input-field">
				            		<input id="3raq" type="number" name="q3" class="validate" value="{{$quiniela->tercerPremio}}">
			         				<label for="3raq">3ra Posición</label>
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
				            		<input id="1erop" type="number" name="p1" class="validate" value="{{$pale->primerPremio}}">
			         				<label for="1erop">1era  y 2da Posición</label>
				            	</div>
				            	<div class="col s12 m12 l12 input-field">
				            		<input id="2dop" type="number" name="p2" class="validate" value="{{$pale->segundoPremio}}">
			         				<label for="2dop">1era  y 3ra Posición</label>
				            	</div>
				            	<div class="col s12 m12 l12 input-field">
				            		<input id="3rap" type="number" name="p3" class="validate" value="{{$pale->tercerPremio}}">
			         				<label for="3rap"> 2da y 3ra Posición</label>
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
				            		<input id="1erot" type="number" name="t1" class="validate" value="{{$tripleta->primerPremio}}">
			         				<label for="1erot">Tripleta</label>
				            	</div>
				            	<div class="col s12 m12 l12 input-field">
				            		<input id="2dot" type="number" name="t2" class="validate" value="{{$tripleta->segundoPremio}}">
			         				<label for="2dot">2 de 3</label>
				            	</div>
							</div>
						</div>
					</div>
					<div class="col s12 m12 l12 botonera-premios">
		    			<center>
		    				<button class="btn  waves-effect red lighten-1" type="button" id="resetprem">Limpiar</button>
		    				<button class="btn  waves-effect waves-light" type="submit" id="setprem">Guardar</button>
		    			</center>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection