@extends('base2')
@section('title')
    Apuestas
@endsection  
@section('contenido')
	@include('layouts/header')
	<div class="row">
			@include('layouts/sidebar')
		<div class="col s12 m9 l9 consola">

<!--////////////////////////////////////////AREA DE LOTERIAS DISPONIBLES//////////////////////////////////////-->
			
			<div class="zonaloteria  col s12 m4 l4">
				<div class="tituloloteria">
					<span>Loterias Disponibles</span>
				</div>
				<div class="loterias">
					<ul>
						<li class="loteriai"> <input type="checkbox" id="loteria" /><label for="loteria">loteria 1</label> </li>
					</ul>
				</div>
			</div>

<!--/////////////////////////////////////////////AREA DE JUGADA A REALIZAR //////////////////////////////// -->
			
			<div class="zonaapuesta col s12 m8 l8 push-l1">
				<div class="col s12 m5 l6 jugadas">
					<div class="col s6 m3 l3 input-field jugadat">
						Jugada
					</div>
					<div class="col s6 m9 l9 jugadaa" >
						<div class="input-field  col s6 m4 l4">
        					<input placeholder="1ro" id="" type="number" min="0" max="99" class="validate">
        				</div>
        				<div class="input-field col s6 m4 l4">
        					<input placeholder="2do" id="" type="number" min="0" max="99" class="validate">
        				</div>
        				<div class="input-field col s6 m4 l4">
        					<input placeholder="3ro" id="" type="number" min="0" max="99" class="validate">
        				</div>
					</div>
				</div>
				<div class="col s12 m3 l3">
					<div class="col s6 m6 l6 input-field jugadat">
						Monto
					</div>
					<div class="input-field col s6 m6 l6">
        				<input placeholder="Euros" id="" type="number" min="1" class="validate">
        			</div>
				</div>
				<div class="col s12 m2 l2 input-field agregar ">
        			<a class="btn-floating btn-large waves-effect teal lighten-2"><i class="material-icons">add</i></a>
				</div>
			</div>

<!--///////////////////////////AREA DE JUGADAS REALIZADAS///////////////////////////////////////////////-->
			
			<div class=" zonaresultado col s12 m8 l8 push-l1">
				<div class="col s12 m12 l12">
					<div class="resultadot">
						<table>
							<tr>
								<th><input type="checkbox" id="todos" /><label for="todos"></label></th>
								<th>Loterias</th>
								<th>Jugadas</th>
								<th>Apuestas</th>
							</tr>
						</table>
					</div>
					<div class="resultadoc">
						<table>
							<tr class="resultadoi">
								<th><input type="checkbox" id="#" /><label for="#"></label></th>
								<th>Loteria 1</th>
								<th>25-03-18</th>
								<th>2.00</th>
							</tr>
						</table>
					</div>
				</div>

<!--//////////////////////////////////////////  TOTALIZADOR //////////////////////////////////////////////////-->
				
				<div class="col s12 m12 l12 container ">
					<div class="totalizador">
						<div class=" totalizadort col l6">
							<span>TOTAL APUESTA</span>
						</div>
						<div class="col l6">
							<span>TOTAL</span>
						</div>
					</div>
					<div class="col l12 botonera center">
						<a class="waves-effect waves-light btn red">Anular</a>
						<a class="waves-effect waves-light btn">Imprimir</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection