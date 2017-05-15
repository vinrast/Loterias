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
		document.getElementById('hora').firstChild.nodeValue = resultado[0];
		setTimeout("hora()",1000);
	});
}


function fecha(){
    var url="/prueba";
    var data;
    var posting=$.get( url,data,function(resultado){
        var meses = {   1:"Enero",
                        2:"Febrero",
                        3:"Marzo",
                        4:"Abril",
                        5:"Mayo",
                        6:"Junio",
                        7:"Julio",
                        8:"Agosto",
                        9:"Septiembre",
                        10:"Octubre",
                        11:"Noviembre",
                        12:"Diciembre"
                    };
                        

        var diasSemana = new Array( "Domingo",
                                "Lunes",
                                "Martes",
                                "Miércoles",
                                "Jueves",
                                "Viernes",
                                "Sábado");
        var f = new Date();
        fechaActual=diasSemana[resultado[3]]+" "+resultado[5]+" "+ meses[resultado[2]] +" "+resultado[4];
        document.getElementById('fecha').firstChild.nodeValue = fechaActual;
        setTimeout('fecha()',1000)
    });
}
function consulta(){
    var url="/prueba";
    var data;
    var posting=$.get( url,data,function(resultado){
        for(x in resultado[6]){
            if (resultado[1]>=resultado[6][x].horaSorteo) {
                $('#loteria'+resultado[6][x].id+'').attr('disabled','disabled');
                $('#loteria'+resultado[6][x].id+'').prop('checked', false); 
                $('#tag'+resultado[6][x].id+'').css({ display:"inline"});
                $('#la'+resultado[6][x].id+'').css({ cursor:"default"});
            }
            else{
                $('#loteria'+resultado[6][x].id+'').removeAttr('disabled','disable');
                $('#tag'+resultado[6][x].id+'').css({ display:"none"});
                $('#la'+resultado[6][x].id+'').css({ cursor:"pointer"});
            }

        }
        setTimeout("consulta()",1000);
    });
}

function inicio(){
    $( ".calendario" ).append('<span class="fecha" id="fecha">0</span><br>')
    $( ".calendario" ).append('<span class="hora"id="hora">0</span>')
hora()
fecha()
consulta()
}

