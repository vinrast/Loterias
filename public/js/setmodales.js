/* ////////////////////////////////////// SETEAR MODALES Y CALENDARIOS /////////////////////////////////////////*/

$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();


	$('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15 // Creates a dropdown of 15 years to control year
	});

 /*///////////////////////////////////// LLENAR MODAL  EDITAR USUARIOS ///////////////////////////////////////////////////////*/

	$(".editarUsuario").click(function(){
		datos=$(this).attr('data-registro');
		var url= '/administracion/usuarios/traer_registro';
		$.get(url, {datos:datos}, function(actualizar){
			if (actualizar[3] == 1){

				 	$('#userEdit').val(actualizar[0]);
				 	$('#passwordEdit').val(actualizar[1]);
				 	$('#perfilEdit> option[value="'+actualizar[2]+'"]').attr('selected', 'true');
				 	$('#iduser').val(datos);

				}
			else{
				swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
			}  
		});
	});

////////////////////////////////////////  MODIFICAR USUARIOS  ///////////////////////////////////////////////////////////////////
	
	$('#insertarEdit').click(function(event){
		event.preventDefault();
	});

	$('#insertarEdit').click(function()
		{
			var usuario=$('#userEdit').val();
			var clave=$('#passwordEdit').val();
			var perfil=$('#perfilEdit').val();
			var formulario=$('#usuarioEditar');
			var data=formulario.serialize();
			var url="/administracion/usuarios/modificarUsuario";
		
			if (usuario=="" || clave==""|| perfil==null) 
			{
				swal({
						title:'Campos vacios!!!!!',//Contenido del modal
						text: '<p style="font-size: 1.5em;">'+'Debe llenar todos los Campos'+'</p>',
						timer:2000,//Tiempo de retardo en ejecucion del modal
						type: "error",
						showConfirmButton:false,//Eliminar boton de confirmacion
						html: true
					});

						


			}
			else
			{
				var posting=$.post( url,data,function(resultado)
				{
					if (resultado[0]==0) 
					{
						swal({
						title:'Registro existente!!!!!',//Contenido del modal
						text: '<p style="font-size: 1.5em;">'+'El usuario: '+resultado[1]+ ' se encuentra creado en el sistema </p>',
						timer:2000,//Tiempo de retardo en ejecucion del modal
						type: "error",
						showConfirmButton:false,//Eliminar boton de confirmacion
						html: true
					});

					}
					else
					{
						//$('#listaUsuarios').append('   <div class="col s12 m6 l6 usuarionombre" id="usuario'+resultado[2]+'">'+resultado[1]+'</div>       <div class="col s12 m2 l2 push-l5 acciones">     <a href="#modaledit"  id="edit'+resultado[2]+'"><i class="small editar material-icons">mode_edit</i></a>    <a href="" id="elim'+resultado[2]+'"><i class="borrar small material-icons">delete</i></a>   </div>');

						swal({

								title:'Edición exitosa!!!.',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+'El  usuario se modifico correctamente en el sistema </p>',
								timer:1800,//Tiempo de retardo en ejecucion del modal
								type: "success",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html:true
														
							});
						setTimeout(function(){location.href = "/administracion/usuarios";},2000);

					}



				});
				posting.fail(function() {
				
				swal({
						title:'Error inesperado!!',//Contenido del modal
						text: '<p style="font-size: 1.5em;">'+'Pongase en contacto con el administrador'+'</p>',
						timer:2000,//Tiempo de retardo en ejecucion del modal
						type: "error",
						showConfirmButton:false,//Eliminar boton de confirmacion
						html: true
					});
				});

			}
	});


////////////////////////////////////////////    BORRAR USUARIOS  //////////////////////////////////////////////////////////////////

	$(".borrarUsuario").click(function(){
		datos=$(this).attr('data-registro');
		user=$(this).attr('data-nombre');
		swal({
			title: "Borrar Usuario",
			text: "Esta seguro que desea borrar a "+ user + " de la base de datos ?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#26a69a",
			confirmButtonText: "Si, Borrar Usuario",
			cancelButtonText: "No, continuar aca",
			closeOnConfirm: false,
			closeOnCancel: true
		},
		function(isConfirm){
		 	if(isConfirm){
		 		var url= '/administracion/usuarios/borrar';//ruta del controlador 
				$.get(url, {datos:datos}, function(resultado){
				   	if(resultado>0){
					   		
				   		swal({
							title:'Usuario Borrado!!',//Contenido del modal
							text: '<p style="font-size: 1.5em;">'+ user +' fue borrado de la base de datos'+'</p>',
							timer:1800,//Tiempo de retardo en ejecucion del modal
							type: "success",
							showConfirmButton:false,//Eliminar boton de confirmacion
							html: true
						});
						setTimeout(function(){location.href = "/administracion/usuarios";},2000);
					}
				   	else{
					   	swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
					}
			 	}); 
	 		}
		});
	});


//////////////////////////////////////////////  AGREGAR LOTERIA  //////////////////////////////////////////////////////////////////////

	$('#savelotery').click(function(event){
		event.preventDefault();
	});
	$('#savelotery').click(function(){
		var loteria=$('#loteria').val();
		var horat=$('#horatra').val();
		var data=[loteria,horat];
		var url="/administracion/addlotery";
	
		if (loteria=="" || horat==""){
			swal({
				title:'Campos vacios!!!!!',//Contenido del modal
				text: '<p style="font-size: 1.5em;">'+'Debe llenar todos los Campos'+'</p>',
				timer:2000,//Tiempo de retardo en ejecucion del modal
				type: "error",
				showConfirmButton:false,//Eliminar boton de confirmacion
				html: true
			});
		}
		else{
			var posting=$.get(url,{data:data},function(resultado){
				if (resultado[0]==0){
					swal({
						title:'Registro existente!!!!!',//Contenido del modal
						text: '<p style="font-size: 1.5em;">'+'La loteria: '+resultado[1]+ ' se encuentra creada en el sistema </p>',
						timer:2000,//Tiempo de retardo en ejecucion del modal
						type: "error",
						showConfirmButton:false,//Eliminar boton de confirmacion
						html: true
					});
				}
				else{
					$('#registroloterias').append('   <div class="col s12 m6 l6 loterianombre">'+resultado[1]+'</div>       <div class="col s12 m2 l2 push-l5 acciones">     <a href="#modaledit"  id="edit'+resultado[2]+'"><i class="small editar material-icons">mode_edit</i></a>    <a href="" id="elim'+resultado[2]+'"><i class="borrar small material-icons">delete</i></a>   </div>');

					swal({
						title:'Insercion exitosa!!!.',//Contenido del modal
						text: '<p style="font-size: 1.5em;">'+'La loteria: '+resultado[1]+' se inserto correctamente en el sistema </p>',
						timer:2500,//Tiempo de retardo en ejecucion del modal
						type: "success",
						showConfirmButton:false,//Eliminar boton de confirmacion
						html:true								
					});
					$('#loteria').val('');
			 		$('#horatra').val('');

				}
			});
			posting.fail(function() {
			
				swal({
					title:'Error inesperado!!',//Contenido del modal
					text: '<p style="font-size: 1.5em;">'+'Pongase en contacto con el administrador'+'</p>',
					timer:2000,//Tiempo de retardo en ejecucion del modal
					type: "error",
					showConfirmButton:false,//Eliminar boton de confirmacion
					html: true
				});
			});
		}
	});
/////////////////////////////////////////////// LLENAR MODAL DE EDITAR LOTERIA ////////////////////////////////////////////////////////

	$(".editarLoteria").click(function(){
		datos=$(this).attr('data-registro');
		var url= '/administracion/loterias/traer_loteria';
		$.get(url, {datos:datos}, function(actualizar){
			if (actualizar[2] == 1){
			 	$('#loteria_e').val(actualizar[0]);
			 	$('#horatra_e').val(actualizar[1]);
			 	$('#idlotery').val(datos);
			}
			else{
				swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
			}
		});
	});

////////////////////////////////////////////// MODIFICAR LOTERIA //////////////////////////////////////////////////////////////////////

	$('#editarLoteria').click(function(event){
		event.preventDefault();
	});

	$('#editarLoteria').click(function()
		{
			var loteria=$('#loteria_e').val();
			var horat=$('#horatra_e').val();
			var formulario=$('#loteriaE');
			var data=formulario.serialize();
			var url="/administracion/loterias/modificarLoteria";
		
			if (loteria=="" || horat=="") 
			{
				swal({
						title:'Campos vacios!!!!!',//Contenido del modal
						text: '<p style="font-size: 1.5em;">'+'Debe llenar todos los Campos'+'</p>',
						timer:2000,//Tiempo de retardo en ejecucion del modal
						type: "error",
						showConfirmButton:false,//Eliminar boton de confirmacion
						html: true
					});

						


			}
			else
			{
				var posting=$.post( url,data,function(resultado){
					if (resultado[0]==0){
						swal({
						title:'Registro existente!!!!!',//Contenido del modal
						text: '<p style="font-size: 1.5em;">'+'La loteria: '+resultado[1]+ ' se encuentra creada en el sistema </p>',
						timer:2000,//Tiempo de retardo en ejecucion del modal
						type: "error",
						showConfirmButton:false,//Eliminar boton de confirmacion
						html: true
					});

					}
					else{
						swal({

								title:'Modificación Exitosa!!!.',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+'La loteria se modifico correctamente en el sistema </p>',
								timer:1800,//Tiempo de retardo en ejecucion del modal
								type: "success",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html:true
														
							});
						setTimeout(function(){location.href = "/administracion/loterias";},2000);
					}
				});
				posting.fail(function() {
					swal({
							title:'Error inesperado!!',//Contenido del modal
							text: '<p style="font-size: 1.5em;">'+'Pongase en contacto con el administrador'+'</p>',
							timer:2000,//Tiempo de retardo en ejecucion del modal
							type: "error",
							showConfirmButton:false,//Eliminar boton de confirmacion
							html: true
						});
				});

			}
	});

//////////////////////////////////////////// BORRAR LOTERIA //////////////////////////////////////////////////////////////////////////
	$(".borrarLoteria").click(function(){
		datos=$(this).attr('data-registro');
		lotery=$(this).attr('data-nombre');
		swal({
			title: "Eliminar Loteria",
			text: "Esta seguro que desea borrar la loteria "+ lotery + " de la base de datos ?",
			type: "warning",
			showCancelButton: true,
			confirmButtonColor: "#26a69a",
			confirmButtonText: "Si, Borrar Loteria",
			cancelButtonText: "No, continuar aca",
			closeOnConfirm: false,
			closeOnCancel: true
		},
		function(isConfirm){
		 	if(isConfirm){
		 		var url= '/administracion/loterias/borrar';//ruta del controlador 
				$.get(url, {datos:datos}, function(resultado){
				   	if(resultado>0){
					   		
				   		swal({
							title:'Loteria Eliminada!!',//Contenido del modal
							text: '<p style="font-size: 1.5em;">La loteria '+ lotery +' fue eliminada de la base de datos'+'</p>',
							timer:1800,//Tiempo de retardo en ejecucion del modal
							type: "success",
							showConfirmButton:false,//Eliminar boton de confirmacion
							html: true
						});
						setTimeout(function(){location.href = "/administracion/loterias";},2000);
					}
				   	else{
					   	swal("Error Inesperado !!", "Comuniquese con el administrador", "error");
					}
			 	}); 
	 		}
		});
	});

///////////////////////////////////////////////// INSERTAR CONFIGURACIONES GENERALES /////////////////////////////////////////////////
	$('#setgen').click(function(e){
		e.preventDefault();
	});
	$('#resetgen').click(function(){
		$('#quini').val('');
		$('#pale').val('');
		$('#tripleta').val('');
		$('#tiempo> option[value=""]').attr('selected', 'true');
	});
		

	$('#setgen').click(function(){
		quiniela = $('#quini').val();
		pale = $('#pale').val();
		tripleta = $('#tripleta').val();
		tiempo = $('tiempo').val();
		formulario = $('#formsetgen')
		datos = formulario.serialize();
		url	= "/administracion/loterias/setgen"
		if (quiniela=="" || pale=="" || tripleta=="" || tiempo==""){
			swal({
				title:'Campos vacios!!!!!',//Contenido del modal
				text: '<p style="font-size: 1.5em;">'+'Debe llenar todos los Campos'+'</p>',
				timer:2000,//Tiempo de retardo en ejecucion del modal
				type: "error",
				showConfirmButton:false,//Eliminar boton de confirmacion
				html: true
			});
		}
		else{
			var posting=$.post( url,datos,function(resultado){
					if (resultado==1){
						swal({
							title:'Actualización Exitosa!!!.',//Contenido del modal
							text: '<p style="font-size: 1.5em;">'+'La Configuracion fue actualizada con exito </p>',
							timer:1800,//Tiempo de retardo en ejecucion del modal
							type: "success",
							showConfirmButton:false,//Eliminar boton de confirmacion
							html:true								
						});
					}
				});
				posting.fail(function() {
					swal({
							title:'Error inesperado!!',//Contenido del modal
							text: '<p style="font-size: 1.5em;">'+'Pongase en contacto con el administrador'+'</p>',
							timer:2000,//Tiempo de retardo en ejecucion del modal
							type: "error",
							showConfirmButton:false,//Eliminar boton de confirmacion
							html: true
						});
				});


		}
	});
});