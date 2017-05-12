$(document).ready(function(){

    $('#modaladd').modal();

	$('#Ingresar__').click(function(e){
		e.preventDefault();
	});

});

function hora(){
	var url="/prueba";
	var data;
	var posting=$.get( url,data,function(resultado){
		document.getElementById('hora').firstChild.nodeValue = resultado
		setTimeout("hora()",1000);
	});
}


function fecha(){
    var meses = new Array ( "Enero",
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

    var diasSemana = new Array( "Domingo",
                            "Lunes",
                            "Martes",
                            "Miércoles",
                            "Jueves",
                            "Viernes",
                            "Sábado");
    var f = new Date();
    fechaActual=diasSemana[f.getDay()]+" "+ f.getDate()+" "+ meses[f.getMonth()] +" "+ f.getFullYear();
    document.getElementById('fecha').firstChild.nodeValue = fechaActual
    setTimeout('fecha()',1000)
}

function inicio(){
    $( ".calendario" ).append('<span class="fecha" id="fecha">0</span><br>')
    $( ".calendario" ).append('<span class="hora"id="hora">0</span>')
hora()
//fecha()
}

