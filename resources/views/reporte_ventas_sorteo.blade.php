@extends('baseReporteDiario')
@section('title')
    Reporte Diario
@endsection  
@section('contenido')
	
	
		
			<table  id="tablapricipal" >
				<tr class="fila_principal" >
					<td style="width:15em;">SGL<br>Sistema de Gestion de Loterias</td>
					<td style="width:30em;">Ventas por sorteo <br> del : {{" ".$fecha_i." "}}&nbsp;&nbsp;al:{{" ".$fecha_f}} </td>
					<td style="width:15em;">Hora:{{$hora}}<br>Fecha:{{$fecha}}</td>
				</tr>

				@foreach($sorteos as $llave => $registros)
				<tr class="fila_encabezado">
					<td colspan="3" >Fecha: {{$llave}}</td>
				</tr>
				<tr class="fila_cont_encabezado">
					<td >Sorteos</td>
					<td >Total en ventas</td>
					<td >Procentaje en ventas del dia</td>
					
				</tr>
					@foreach($registros as $sorteo)
						<tr  class="fila_cont">
							<td >{{"  ".$sorteo->sorteo}}</td>
							<td >{{" ".$sorteo->acumulado." €"}}</td>
							<td >{{" ".$sorteo->porcentaje_v." %"}}</td>
						</tr>
					@endforeach
				@endforeach

				<tr class="fila_encabezado">
					<td colspan="3" >Acumulado en ventas durante el periodo </td>
				</tr>
				<tr class="fila_cont_encabezado">
					<td >Sorteos</td>
					<td >Total en ventas</td>
					<td >Procentaje en ventas del periodo</td>
					
				</tr>
					@foreach($total_p as $llave => $total)
						<tr  class="fila_cont">
							<td >{{"  ".$llave}}</td>
							<td >{{" ".$total." €"}}</td>
							<td >{{number_format(($total*100)/$acumulado,2,'.',',')." %"}}</td>
						</tr>
					@endforeach
				
				<tr class="fila_encabezado">
					<td colspan="3" >Venta total durante el periodo : &nbsp;{{$acumulado." €"}}</td>
				</tr>

					

			</table>
	

@endsection