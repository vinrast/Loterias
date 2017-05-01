/* ////////////////////////////////////// MODAL NUEVO USUARIO /////////////////////////////////////////*/

$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
    $('select').material_select();


	$('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15 // Creates a dropdown of 15 years to control year
	});

 /*///////////////////////////////////// EDITAR USUARIOS ////////////////////////////////////////////*/

	$('#usuarioEditar').submit(function(event){
		event.preventDefault();
	});

	$(".editar").click(function(){
		datos=$(this).attr('data-registro');
		var url= '/administracion/usuarios/traer_registro';
		$.get(url, {datos:datos}, function(actualizar){
			if (actualizar[3] == 1){

				 	$('#userEdit').val(actualizar[0]);
				 	$('#passwordEdit').val(actualizar[1]);
				 	$('#perfilEdit> option[value="'+actualizar[2]+'"]').attr('selected', 'selected');

				}
			else{
				swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
			}  
		});
	});

///////////////////////////////////////////////////////////////
	/*$('.modificarPlanes').click(function()
		{

			////////////// obtener registro a modificar ////////////////////
			var datos=$(this).attr('data-id');////////////// id del boton modificar seleccionado ///////////////
			var url= '/menu/registros/planes/actualizar';//rutas[tabla];
					
			$.get(url, {datos:datos}, function(actualizar){
				if (actualizar[4] == 1){
						
				 	$('#nomPnm').val(actualizar[0]);
				 	$('#porDesm').val(actualizar[1]);
				 	$('#stPnm').val(actualizar[2]);
				 	$('#id_registro').val(actualizar[3]);
				}
				else{
					swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
				}  
			});

	});*/
////////////////////////////////////////////////////////////////////////




});