@extends('base2')
@section('title')
    Apuestas
@endsection  
@section('contenido')
	@include('layouts/header')
	<div class="row">
		@include('layouts/sidebar')
		<div class="col s12 m9 l9">
			<div class="cont-sorteo col s12 m4 l4">
				<table class="card-panel striped">
			        <thead>
						<tr>
							<th>Sorteos</th>
						</tr>
			        </thead>
			        <!--Cuerpo de la tabla-->
			        <tbody>
						<tr>
							<td>
								<p>
									<input type="checkbox" id="sorteo" />
									<label for="sorteo">Loteria 1</label>
    							</p>
    						</td>
						</tr>
						<tr>
							<td>
								<p>
									<input type="checkbox" id="sorteo2" />
									<label for="sorteo2">Loteria 2</label>
    							</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>
									<input type="checkbox" id="sorteo3" />
									<label for="sorteo3">Loteria 3</label>
    							</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>
									<input type="checkbox" id="sorteo4" />
									<label for="sorteo4">Loteria 4</label>
    							</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>
									<input type="checkbox" id="sorteo5" />
									<label for="sorteo5">Loteria 5</label>
    							</p>
							</td>
						</tr>
			        </tbody>
      			</table>
			</div>
			<div class="cont-apuesta card-panel col s12 m8 l8">
				<div class="col s12 m5 l5">
					<div class="col col s6 m3 l3">
						Jugadas
					</div>
					<div class="input-field col s6 m3 l3">
        				<input placeholder="1ro" id="" type="number" min="0" max="99" class="validate">

        			</div>
        			<div class="input-field col s6 m3 l3">
        				<input placeholder="2do" id="" type="number" min="0" max="99" class="validate">

        			</div>
        			<div class="input-field col s6 m3 l3">
        				<input placeholder="3ro" id="" type="number" min="0" max="99" class="validate">

        			</div>
				</div>
				<div class="col s12 m5 l5">
					<div class="col col s6 m6 l6">
						Monto
					</div>
					<div class="input-field col s6 m6 l6">
        				<input placeholder="Monto" id="" type="number" min="1" class="validate">
        			</div>
				</div>
				<div class="col s12 m2 l2">
					<br>
        			<a class="btn-floating btn-large waves-effect waves-light"><i class="material-icons">add</i></a>
				</div>
			</div>
			<div class="card-panel col s12 m8 l8">
				<div class="col s12 m12 l12">
					<table class=" card-panel striped">
				        <thead>
							<tr>
								<th>
									<input type="checkbox" id="todos" />
									<label for="todos"></label>
								</th>
								<th>Loterias</th>
								<th>Jugadas</th>
								<th>Apuestas</th>
							</tr>
				        </thead>
				        <!--Cuerpo de la tabla-->
				        <tbody>
							<tr>
								<td>
									<p>
										<input type="checkbox" id="jugada" />
										<label for="jugada"></label>
	    							</p>
	    						</td>
	    						<td>
	    							loteria 1
	    						</td>
	    						<td>
	    							numeros
	    						</td>
	    						<td>
	    							2.00
	    						</td>
							</tr>
							<tr>
								<td>
									<p>
										<input type="checkbox" id="jugada4" />
										<label for="jugada4"></label>
	    							</p>
								</td>
								<td>
	    							loteria 1
	    						</td>
								<td>
	    							numeros
	    						</td>
	    						<td>
	    							2.00
	    						</td>
							</tr>
				        </tbody>
      				</table>
				</div>
				<div class="col s12 m12 l12 container ">
					<div class="card-panel center">
						<div class="col l6">
							<span>TOTAL APUESTA</span>
						</div>
						<div class="col l6">
							<span>TOTAL</span>
						</div>
					</div>
					<div class="col l12 center">
					<br>
						<a class="waves-effect waves-light btn red">Anular</a>
						<a class="waves-effect waves-light btn">Imprimir</a>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection