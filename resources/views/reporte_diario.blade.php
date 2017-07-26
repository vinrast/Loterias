@extends('baseReporteDiario')
@section('title')
    Reporte Diario
@endsection  
@section('contenido')
	
	
		
			<table  id="tablapricipal" >
				<tr class="fila_principal" >
					<td style="width:15em;">SGL<br>Sistema de Gestion de Loterias</td>
					<td style="width:30em;">Resumen diario de ventas</td>
					<td style="width:15em;">Hora:{{$hora}}<br>Fecha:{{$fecha}}</td>
				</tr>
				<tr class="fila_encabezado">
					<td colspan="3" >Total ventas</td>
				</tr>
				<tr  class="fila_cont">
					<td >Total Ventas:<br>{{"  ".$ventas_totales->v_acumulado." €"}}</td>
					<td >Comisiones a vendedores:<br>{{" ".$ventas_totales->c_acumulado." €"}}</td>
					<td >Total con descuentos:<br>{{$ventas_totales->t_acumulado." €"}}</td>
				</tr>
				<tr class="fila_encabezado">
					<td colspan="3" >Total ventas por sorteo</td>
				</tr>
				<tr  class="fila_cont_encabezado">
					<td >Sorteo</td>
					<td >Acumulado</td>
					<td >Porcentaje de las ventas </td>
				</tr>
				
				@foreach($ventas_sorteos as $sorteo )
				<tr class="fila_cont">
						<td >{{$sorteo->sorteo}}</td>
						<td >{{$sorteo->acumulado." €"}}</td>
						<td >{{$sorteo->porcentaje_v}}</td>
				</tr>
				@endforeach


				<tr class="fila_encabezado">
					<td colspan="3">Total ventas por tipo de jugada</td>
				</tr>
				<tr  class="fila_cont_encabezado">
					<td >Tipo jugada</td>
					<td >Acumulado</td>
					<td >Porcentaje de las ventas</td>
				</tr>
				@foreach($ventas_tipos as $tipo )
				<tr class="fila_cont">
						<td >{{$tipo->tipo_jugada}}</td>
						<td >{{$tipo->acumulado." €"}}</td>
						<td >{{$tipo->porcentaje_v}}</td>
				</tr>
				@endforeach
				<tr class="fila_encabezado">
					<td colspan="3" >Total ventas por usuario</td>
				</tr>
				<tr class="fila_cont_encabezado">
					<td >Usuario</td>
					<td >Acumulado / Porcentaje de las ventas</td>
					<td >Comision (15 %)</td>
					
				</tr>
				@foreach($ventas_usuarios as $usuario)
				
					<tr class="fila_cont">
							<td >{{$usuario->usuario}}</td>
							<td >{{$usuario->acumulado." €"." - ".$usuario->porcentaje_v}}</td>
							<td >{{$usuario->comision." €"}} </td>
					</tr>
				
				@endforeach
				<tr class="fila_encabezado">
					<td colspan="3" >Top jugadas vendidas</td>
				</tr>
				<tr class="fila_cont_encabezado">
					<td >Jugada</td>
					<td >Total</td>
					<td >Porcentaje de las ventas</td>
					
				</tr>
				@foreach($ventas_top_jugadas as $top_jugada)
				<tr class="fila_cont">
						<td >{{$top_jugada->jugada}}</td>
						<td >{{$top_jugada->acumulado." €"}}</td>
						<td >{{$top_jugada->porcentaje_v}}</td>
				</tr>
				@endforeach
				<tr class="fila_encabezado">
					<td colspan="3" >Top quinielas vendidas</td>
				</tr>
				<tr class="fila_cont_encabezado">
					<td >Quiniela</td>
					<td >Total</td>
					<td >Porcentaje de las ventas</td>
					
				</tr>
				@foreach($ventas_top_quinielas as $top_quiniela)
				<tr class="fila_cont">
						<td >{{$top_quiniela->jugada}}</td>
						<td >{{$top_quiniela->acumulado." €"}}</td>
						<td >{{$top_quiniela->porcentaje_v}}</td>
				</tr>
				@endforeach
				<tr class="fila_encabezado">
					<td colspan="3" >Top pales vendidos</td>
				</tr>
				<tr class="fila_cont_encabezado">
					<td >Pale</td>
					<td >Total</td>
					<td >Porcentaje de las ventas</td>
					
				</tr>
				@foreach($ventas_top_pales as $top_pale)
				<tr class="fila_cont">
						<td >{{$top_pale->jugada}}</td>
						<td >{{$top_pale->acumulado." €"}}</td>
						<td >{{$top_pale->porcentaje_v}}</td>
				</tr>
				@endforeach
				<tr class="fila_encabezado">
					<td colspan="3" >Top tripletas vendidas</td>
				</tr>
				<tr class="fila_cont_encabezado">
					<td >Tripleta</td>
					<td >Total</td>
					<td >Porcentaje de las ventas</td>
					
				</tr>
				@foreach($ventas_top_tripletas as $top_tripleta)
				<tr class="fila_cont">
						<td >{{$top_tripleta->jugada}}</td>
						<td >{{$top_tripleta->acumulado." €"}}</td>
						<td >{{$top_tripleta->porcentaje_v}}</td>
				</tr>
				@endforeach


			</table>
	

@endsection