@extends('baseReporteDiario')
@section('title')
    Reporte Diario
@endsection  
@section('contenido')
	
	
		
			<table  id="tablapricipal" >
				<tr class="fila_principal" >
					<td style="width:15em;">SGL<br>Sistema de Gestion de Loterias</td>
					<td style="width:30em;">Ventas por usuario <br> del : {{" ".$fecha_i." "}}&nbsp;&nbsp;al:{{" ".$fecha_f}} </td>
					<td style="width:15em;">Hora:{{$hora}}<br>Fecha:{{$fecha}}</td>
				</tr>

				@foreach($usuarios as $llave => $registros)
				<tr class="fila_encabezado">
					<td colspan="3" >Fecha: {{$llave}}</td>
				</tr>
				<tr class="fila_cont_encabezado">
					<td >Sorteos</td>
					<td >Total en ventas &nbsp;/&nbsp; Porcentaje de las ventas </td>
					<td >Comision(15%)</td>
					
				</tr>
					@foreach($registros as $usuario)
						<tr  class="fila_cont">
							<td >{{"  ".$usuario->usuario}}</td>
							<td >{{" ".$usuario->acumulado." € "}}&nbsp;{{" /&nbsp;".$usuario->porcentaje_v}}</td>
							<td >{{" ".$usuario->comision." € " }}</td>
						</tr>
					@endforeach
				@endforeach

				<tr class="fila_encabezado">
					<td colspan="3" >Acumulado en ventas durante el periodo </td>
				</tr>
				<tr class="fila_cont_encabezado">
					<td >Usuarios</td>
					<td >Total en ventas&nbsp;/&nbsp;Porcentaje de las ventas </td>
					<td >Comision para el periodo (15%)</td>
					
				</tr>
					@foreach($total_p as $llave => $total)
						<tr  class="fila_cont">
							<td >{{"  ".$llave}}</td>
							<td >{{" ".$total." €"}}&nbsp;/&nbsp;{{number_format(($total*100)/$acumulado,2,'.',',')." %"}}</td>
							<td >{{number_format((15*$total)/100,2,'.',',')." €"}}</td>
						</tr>
					@endforeach
				
				<tr class="fila_encabezado">
					<td colspan="3" >Venta total durante el periodo : &nbsp;{{$acumulado." €"}}</td>
				</tr>

					

			</table>
	

@endsection