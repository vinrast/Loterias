@extends('baseReporteDiario')
@section('title')
    Reporte Diario
@endsection  
@section('contenido')
	
	
		
			<table  id="tablapricipal" >
				<tr class="fila_principal" >
					<td style="width:15em;">SGL<br>Sistema de Gestion de Loterias</td>
					<td style="width:30em;">Anulaciones por usuario <br> del : {{" ".$fecha_i." "}}&nbsp;&nbsp;al:{{" ".$fecha_f}} </td>
					<td style="width:15em;">Hora:{{$hora}}<br>Fecha:{{$fecha}}</td>
				</tr>

				@foreach($reporte as $llave => $registros)
				<tr class="fila_encabezado">
					<td colspan="3" >Fecha: {{$llave}}</td>
				</tr>
				<tr class="fila_cont_encabezado">
					<td >Usuarios</td>
					<td >Tickets anulados </td>
					<td >Dinero en anulaciones</td>
					
				</tr>
					@foreach($registros as $usuario)
						

							<tr  class="fila_cont">
								<td >{{"  ".$usuario['usuario']}}</td>
								<td >{{" ".$usuario['anulaciones']}}</td>
								<td >{{" ".$usuario['dinero']." € " }}</td>
							</tr>
						
					@endforeach
				@endforeach

				<tr class="fila_encabezado">
					<td colspan="3" >Anulaciones por usuarios,durante el periodo</td>
				</tr>
				<tr class="fila_cont_encabezado">
					<td >Usuarios</td>
					<td >Tickets anulados </td>
					<td >Dinero en anulaciones</td>
					
				</tr>
					@foreach($anulaciones_periodo as $llave => $total)
						<tr  class="fila_cont">
							<td >{{"  ".$llave}}</td>
							<td >{{" ".$total}}</td>
							<td >{{$dinero_anulado[$llave]." €"}}</td>
						</tr>
					@endforeach
				
				<tr class="fila_encabezado">
					<td colspan="3" >Acumulado durante el periodo , &nbsp;Tickets anulados:&nbsp;{{$acumulado_anulaciones}}<br>&nbsp;Dinero total:&nbsp;{{$acumulado_dinero." €"}}</td>
				</tr>

					

			</table>
	

@endsection