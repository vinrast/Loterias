





function CerrarSession() 
{
	$('#CerrarSession').click(function()
		{
		  
		  

		  swal({
				title: "Cierre de sesion",
				text: "¿ Desea cerrar sesion ?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor:"#319A0E",
				confirmButtonText: "Si",
				cancelButtonText: "Cancelar",
				closeOnConfirm: false,
				closeOnCancel: false
			 },

			 function(isConfirm)
			 {
			 	if(isConfirm)//pasar peticion
			 	{
			 		
					var url='/cerrarSession';
				
					var cerrar= $.get(url,function(resultado)
						{
							if (resultado==1) 
							{
								location.href = "/login";
							}
							
						});
				 		cerrar.fail(function() 
				 		{
				
							swal({
								title:'Error al cerrar sesion!!',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+'Pongase en contacto con el administrador'+'</p>',
								timer:2000,//Tiempo de retardo en ejecucion del modal
								type: "error",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html: true
							});
						});
			    	

			 		 
			 	}
			 	else
			 	{
			 			swal({
								title:'Cierre de sesion cancelado!!',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+'La sesion se mantendra abierta'+'</p>',
								timer:2000,//Tiempo de retardo en ejecucion del modal
								type: "success",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html: true
							});
			 	}
			 }
			 );
			 	

		});	 

				
}


function buscarResp (arreglo,elemento) 
{
	var respuesta=false;
	for (var i = 0; i < arreglo.length; i++) 
	{
		if(arreglo[i]==elemento)
		{
			respuesta=true;
		}
	}

	return respuesta;
}



			function VerificarCredencialesLogin()
			{
				$('#Ingresar__').click(function()
				{
					
					////////////Obtener datos del formulario/////////
					var url='/loginVerificar';
					var form=$('#formLogin');
					var data=form.serialize();
					var posting=$.post( url,data,function(resultado)
						{
							//alert(resultado);
							if (resultado[0]!=0) //si existe el usuario
								{

									swal({
												title:'Bienvenido',//Contenido del modal
												text: '<p style="font-size: 2em;">'+'Usuario: '+' '+resultado[0]+'</p>',
												timer:2000,//Tiempo de retardo en ejecucion del modal
												type: "success",
												showConfirmButton:false,//Eliminar boton de confirmacion
												html: true
											});

									setTimeout(function(){location.href = "/home";},1000);

								}
							else if (resultado[0]==0)//no existe el usuario
								{
									swal({
											title:'Credenciales invalidos.',//Contenido del modal
											timer:1500,//Tiempo de retardo en ejecucion del modal
											type: "error",
											showConfirmButton:false,//Eliminar boton de confirmacion
											customClass: 'animated wobble'
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

		

	});
}



function InsertarUsuario () 
{
	$('#insUsuarioAgr').click(function(e){
		e.preventDefault();
	});
	$('#insUsuarioAgr').click(function()
		{
			var usuario=$('#userAgr').val();
			var clave=$('#passwordAgr').val();
			var perfil=$('#perfilAgr').val();
			var formulario=$('#usuarioAgregar');
			var data=formulario.serialize();
			var url="/insertarUsuarios";
		
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
						text: '<p style="font-size: 1.5em;">'+'El usuario: '+resultado[1]+ ' se encuetra creado en el sistema </p>',
						timer:2000,//Tiempo de retardo en ejecucion del modal
						type: "error",
						showConfirmButton:false,//Eliminar boton de confirmacion
						html: true
					});

					}
					else
					{
						$('#registro').before(' <div class=" col s12 m12 l12 usuarios" id="registro">  <div class="col s12 m6 l6 usuarionombre" id="usuario'+resultado[2]+'">'+resultado[1]+'</div>       <div class="col s12 m2 l2 push-l5 acciones">     <a href="#modaledit" class="editarUsuario" data-registro="'+resultado[2]+'" id="edit'+resultado[2]+'"><i class="small editar material-icons">mode_edit</i></a>    <a href="" id="elim'+resultado[2]+'"><i class="borrar small material-icons">delete</i></a>   </div></div>');

						swal({

								title:'Insercion exitosa!!!.',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+'El  usuario: '+resultado[1]+' se inserto correctamente en el sistema </p>',
								timer:2500,//Tiempo de retardo en ejecucion del modal
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





}



			VerificarCredencialesLogin()
			InsertarUsuario()
			
			
			CerrarSession() 
		


// $(document).ready(function()
// 	{
			

// 			$('#dineroTotal').text(0);
			
	
// 	});
