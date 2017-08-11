@extends('baseReporteDiario')
@section('title')
    Reporte Diario
@endsection  
@section('contenido')
	
	
		
			<table  id="tablapricipal" >
				<tr class="fila_principal" >
					<td style="width:15em;">SGL<br>Sistema de Gestion de Loterias</td>
					<td style="width:30em;">Pagos por usuario <br> del : {{" ".$fecha_i." "}}&nbsp;&nbsp;al:{{" ".$fecha_f}} </td>
					<td style="width:15em;">Hora:{{$hora}}<br>Fecha:{{$fecha}}</td>
				</tr>

				@foreach($reporte as $llave => $registros)
				<tr class="fila_encabezado">
					<td colspan="3" >Fecha: {{$llave}}</td>
				</tr>
				<tr class="fila_cont_encabezado">
					<td >Usuarios</td>
					<td >Tickets pagados </td>
					<td >Dinero en pagos</td>
					
				</tr>
					@foreach($registros as $usuario)
						

							<tr  class="fila_cont">
								<td >{{"  ".$usuario['usuario']}}</td>
								<td >{{" ".$usuario['tickets']}}</td>
								<td >{{" ".$usuario['dinero']." € " }}</td>
							</tr>
						
					@endforeach
				@endforeach

				<tr class="fila_encabezado">
					<td colspan="3" >Acumulado por usuarios,durante el periodo</td>
				</tr>
				<tr class="fila_cont_encabezado">
					<td >Usuarios</td>
					<td >Tickets pagados </td>
					<td >Dinero en pagos</td>
					
				</tr>
					@foreach($tickets_periodo as $llave => $total)
						<tr  class="fila_cont">
							<td >{{"  ".$llave}}</td>
							<td >{{" ".$total}}</td>
							<td >{{$dinero_periodo[$llave]." €"}}</td>
						</tr>
					@endforeach
				
				<tr class="fila_encabezado">
					<td colspan="3" >Acumulado durante el periodo , &nbsp;Tickets pagados:&nbsp;{{$acumulado_tickets}}<br>&nbsp;Dinero total:&nbsp;{{$acumulado_pagos." €"}}</td>
				</tr>

					

			</table>
	

@endsection