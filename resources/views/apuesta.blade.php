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
					<ul id="sorteosDisponibles">
						@foreach($sorteos as $sorteo)
							<li class="loteriai"> <input type="checkbox" id="loteria{{$sorteo->id}}" data-id="{{$sorteo->id}}" data-descripcion="{{$sorteo->descripcion}}" /><label id="la{{$sorteo->id}}" for="loteria{{$sorteo->id}}">{{$sorteo->descripcion}}</label><div id="tag{{$sorteo->id}}" class="tag">Cerrada</div></li>
						@endforeach
					</ul>
				</div>
			</div>

<!--/////////////////////////////////////////////AREA DE JUGADA A REALIZAR //////////////////////////////// -->
			
			<div class="zonaapuesta col s12 m8 l8 push-l1">
				<div class="col s12 m5 l6 jugadas">
					<div class="col s6 m3 l3 input-field jugadat">
						Jugada
					</div>
					<div class="col s6 m9 l9 jugadaa" id="tripleta">
						<div class="input-field  col s6 m4 l4">
        					<input placeholder="1ro" id="primerPremio" type="number" min="0" max="99" class="validate">
        				</div>
        				<div class="input-field col s6 m4 l4">
        					<input placeholder="2do" id="segundoPremio" type="number" min="0" max="99" class="validate">
        				</div>
        				<div class="input-field col s6 m4 l4">
        					<input placeholder="3ro" id="tercerPremio" type="number" min="0" max="99" class="validate">
        				</div>
					</div>
				</div>
				<div class="col s12 m3 l3">
					<div class="col s6 m6 l6 input-field jugadat">
						Monto
					</div>
					<div class="input-field col s6 m6 l6">
        				<input placeholder="Euros" id="Apuesta" type="number" min="1" class="validate">
        			</div>
				</div>
				<div class="col s12 m2 l2 input-field agregar ">
        			<a class="btn-floating btn-large waves-effect  indigo lighten-1" id="ADD"><i class="material-icons">add</i></a>
				</div>
			</div>

<!--///////////////////////////AREA DE JUGADAS REALIZADAS///////////////////////////////////////////////-->
			
			<div class=" zonaresultado col s12 m8 l8 push-l1">
				<div class="col s12 m12 l12">
					<div class="resultadot">
						<table>
							<tr>
								<th><input type="checkbox" id="chekJugadas" /><label for="chekJugadas"></label></th>
								<th>Sorteos</th>
								<th>Jugadas</th>
								<th>Apuestas</th>
							</tr>
						</table>
					</div>
					<div class="resultadoc" id="jugadasTickets">
						<table id="tablaJugadas">
								
						@if(count($ventas)>0)
							@foreach($ventas as $venta)
									<tr class="resultadoi" id="filaJugada{{$venta[3]}}" data-apuesta="{{$venta[2]}}">
										<th class="celda" ><input type="checkbox" class="checkJugada" id="check{{$venta[3]}}" data-idj="{{$venta[3]}}"><label for="check{{$venta[3]}}"></label></th>

										<th class="celda1">{{$venta[0]}}</th>
										<th class="celda1">{{$venta[1]}}</th>
										<th class="celda1">{{$venta[2]." €"}}</th>
									</tr> 
							@endforeach
						@endif
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
							<span id="dineroTotal">{{$total." €"}}</span>
						</div>
					</div>
					<div class="col l12 botonera center">
						<a class="waves-effect waves-light btn red" id="anularJugada">Anular</a>
						<a class="waves-effect waves-light btn" id="imprimirTicket">Imprimir</a>
					</div>
					<input  id="jugadaId" type="hidden" value="{{$fila}}">
					<input  id="valorTotal" type="hidden" value="{{$total}}">
				</div>
			</div>
		</div>
	</div>
@endsection