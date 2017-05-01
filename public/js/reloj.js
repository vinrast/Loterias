var puntos = ":"
function hora(){
	var fecha = new Date()
	var hora = fecha.getHours()
	var minuto = fecha.getMinutes()
	var meridiano = " am"
	if(hora > 12){hora -= 12; meridiano = " pm"}
	if (hora < 10) {hora = "0" + hora}
	if (minuto < 10) {minuto = "0" + minuto}
	puntos == ":" ? puntos = " " : puntos = ":"
	var horita = hora + puntos + minuto + meridiano
	document.getElementById('hora').firstChild.nodeValue = horita
	tiempo = setTimeout('hora()',1000)
}
function fecha(){
	var meses = new Array (	"Enero",
						"Febrero",
						"Marzo",
						"Abril",
						"Mayo",
						"Junio",
						"Julio",
						"Agosto",
						"Septiembre",
						"Octubre",
						"Noviembre",
						"Diciembre");

	var diasSemana = new Array(	"Domingo",
							"Lunes",
							"Martes",
							"Miércoles",
							"Jueves",
							"Viernes",
							"Sábado");
	var f = new Date();
	fechaActual=diasSemana[f.getDay()]+" "+ f.getDate()+" "+ meses[f.getMonth()] +" "+ f.getFullYear();
	document.getElementById('fecha').firstChild.nodeValue = fechaActual
}

function inicio(){
	$( ".calendario" ).append('<span class="fecha" id="fecha">0</span><br>')
	$( ".calendario" ).append('<span class="hora"id="hora">0</span>')
hora()
fecha()
}
$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('#modaladd').modal();

//////////////////////////////////////// FUNCIONALIDAD DEL SIDEBAR ////////////////////////////////////////////////


});

