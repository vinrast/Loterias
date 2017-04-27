
///Validar las credeciales usadas en el login ///////

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
								showConfirmButton:false//Eliminar boton de confirmacion
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
			})
		

	});
}

function AgregarJugada()
{

	$("#ADD").click(function()
		{
			var sorteos=document.getElementById('sorteosDisponibles');
			var checks=sorteos.getElementsByTagName("input");
			
			var c=0;
			var sorteo=null;
			$.each(checks, function(i)
			{
				
				if ($(this).prop("checked")==true )
				{
					c=c+1;
					if (c==1) 
					{
						sorteo=$(this).attr('data-descripcion');
					}
				}
				
			});
			//alert(c);
			if (c==0)
			{
				swal({
						title:'Debe seleccionar un sorteo!!',//Contenido del modal
						text: '<p style="font-size: 1.5em;">'+''+'</p>',
						timer:2000,//Tiempo de retardo en ejecucion del modal
						type: "warning",
						showConfirmButton:false,//Eliminar boton de confirmacion
						html: true
					});
				
			}
			else if(c>1)
			{
				
				swal({
						title:'Debe seleccionar solo un sorteo!!',//Contenido del modal
						text: '<p style="font-size: 1.5em;">'+''+'</p>',
						timer:2000,//Tiempo de retardo en ejecucion del modal
						type: "warning",
						showConfirmButton:false,//Eliminar boton de confirmacion
						html: true
					});
				
			}
			else if(c==1)//si se selecciono un sorteo
			{
				//alert('El sorteo seleccionado es:  '+ sorteo);
				var sorteos=document.getElementById('tripleta');
				var dupletas=sorteos.getElementsByTagName("input");
				var tripleta=[];
				c=0;
				
				$.each(dupletas, function(i)
				{
					
					if ($(this).val()!='')
					{
						c=c+1;
						tripleta.push($(this).val());
					}
					
					
				});

				if (c==0) 
					{
						swal({
								title:'Debe ingresar al menos una dupleta!!',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+''+'</p>',
								timer:2000,//Tiempo de retardo en ejecucion del modal
								type: "warning",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html: true
						});
						
					}
				else
					{
						var tripleta_='';
						for (var i = 0; i < tripleta.length; i++) 
						{
							if(i>0)
							{
								tripleta_=tripleta_+'-'+tripleta[i];
							}
							else
							{
								tripleta_=tripleta_+tripleta[i];
							}

						}
						
						if ($('#Apuesta').val()=='') 
						{
								swal({
										title:'Debe indicar la apuesta para la jugada!!',//Contenido del modal
										text: '<p style="font-size: 1.5em;">'+''+'</p>',
										timer:2000,//Tiempo de retardo en ejecucion del modal
										type: "warning",
										showConfirmButton:false,//Eliminar boton de confirmacion
										html: true
									});
						
							
						}
						else
						{
							alert(sorteo+'  '+tripleta_+' Por: '+$('#Apuesta').val());
						}
					}
			}

		});
}



VerificarCredencialesLogin()
AgregarJugada()