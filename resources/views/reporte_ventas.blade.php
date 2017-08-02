@extends('baseReporteDiario')
@section('title')
    Reporte Diario
@endsection  
@section('contenido')
	
	
		
			<table  id="tablapricipal" >
				<tr class="fila_principal" >
					<td style="width:15em;">SGL<br>Sistema de Gestion de Loterias</td>
					<td style="width:30em;">Total en ventas<br> del : {{" ".$fecha_i." "}}&nbsp;&nbsp;al:{{" ".$fecha_f}} </td>
					<td style="width:15em;">Hora:{{$hora}}<br>Fecha:{{$fecha}}</td>
				</tr>

				@foreach($ventas[0] as $venta)
				<tr class="fila_encabezado">
					<td colspan="3" >Fecha: {{$venta->fecha}}</td>
				</tr>

					<tr  class="fila_cont">
						<td >Total Ventas:<br>{{"  ".$venta->v_acumulado." €"}}</td>
						<td >Comisiones a vendedores:<br>{{" ".$venta->c_acumulado." €"}}</td>
						<td >Total con descuentos:<br>{{$venta->t_acumulado." €"}}</td>
					</tr>
				@endforeach

				<tr class="fila_encabezado">
					<td colspan="3" >Totales </td>
				</tr>

					<tr  class="fila_cont">
						<td >Total Ventas:<br>{{"  ".$ventas[1]." €"}}</td>
						<td >Comisiones a vendedores:<br>{{" ".$ventas[2]." €"}}</td>
						<td >Total con descuentos:<br>{{$ventas[3]." €"}}</td>
						
					</tr>

			</table>
	

@endsection