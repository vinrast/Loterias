
///Validar las credeciales usadas en el login ///////

var jugadaId=1;

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
				alert(resultado);
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
				
				alert('Error de conexion,Comuniquese con el administrador');
			});

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
	});
}



function anularJugada()
{
	$("#anularJugada").click(function()
		{

			var tabla=document.getElementById('tablaJugadas');
			var checks=tabla.getElementsByTagName("input");
			var longitud=checks.length;
			var ids=[];
			//alert(longitud); la longitud es correcta
			var c=0;

			$.each(checks,function()
				{
					if($(this).prop('checked')==true)
					{
						c=c+1;
						ids.push($(this).attr('data-idj'));

					}
				
				});
			if (c==0 && longitud>0) 
			{
				// swal({
				// 		title:'Debe seleccionar las jugadas que desea anular!!',//Contenido del modal
				// 		text: '<p style="font-size: 1.5em;">'+''+'</p>',
				// 		timer:2000,//Tiempo de retardo en ejecucion del modal
				// 		type: "warning",
				// 		showConfirmButton:false,//Eliminar boton de confirmacion
				// 		html: true
				// 	});
			}
			else
			{

					for (var i = 0; i < ids.length; i++)
					 {
						$('#filaJugada'+ids[i]).remove();
						
					}

					$("#chekJugadas").prop('checked',false);
					

			}


		});


}


function seleccionarJugada()//cambia el status de los cheks de las jugadas
{

	$("#chekJugadas").change(function()
		{
			var tabla=document.getElementById('tablaJugadas');
			var checks=tabla.getElementsByTagName("input");
			var estado=$(this).prop('checked');
			//alert(checks.length);

			if (checks.length>0) 
			{

				$.each(checks,function(i)
				{

					if ($(this).prop('checked')!=estado) 
					{

						$(this).prop('checked',estado);
					}
				});

			}
			else
			{
				$("#chekJugadas").prop('checked',false);
			}

			
		});
}



function AgregarJugada()
{

	$("#ADD").click(function()
		{
			var sorteos=document.getElementById('sorteosDisponibles');
			var checks=sorteos.getElementsByTagName("input");
			var jugada=new Object();
			var sorteos_=[];
			var jugadas=[];
			var apuestas=[];


			var c=0;
			var sorteo=null;
			$.each(checks, function(i)
			{
				
				if ($(this).prop("checked")==true )
				{
					c=c+1;
					alert($(this).attr('data-descripcion'));
					sorteos_.push($(this).attr('data-descripcion'));
				}
				
			});
			
			if (c==0)//si no se seleccionan sorteos
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
			else if(c>=1)//si se seleccionan sorteos
			{
				
				var sorteos=document.getElementById('tripleta');
				var dupletas=sorteos.getElementsByTagName("input");
				var tripleta=" ";
				c=0;

				$.each(dupletas, function(i)
				{
					
					if ($(this).val()!='')
					{
						c=c+1;
						if (c==1) 
						{
							tripleta=tripleta+$(this).val();
						}
						else
						{
							tripleta=tripleta+'-'+$(this).val();
						}
						
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
						// var tripleta_='';
						// for (var i = 0; i < tripleta.length; i++) 
						// {
						// 	if(i>0)
						// 	{
						// 		tripleta_=tripleta_+'-'+tripleta[i];
						// 	}
						// 	else
						// 	{
						// 		tripleta_=tripleta_+tripleta[i];
						// 	}

						// }
						//jugada.tripleta=tripleta_;
						
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
							
							//alert(jugada.sorteo+'  '+jugada.tripleta+' Por: '+$('#Apuesta').val());
							for (var i = 0; i < sorteos_.length; i++) 
							{
								
							
								$('#tablaJugadas').append(' <tr class="resultadoi" id="filaJugada'+jugadaId+'">  <th><input type="checkbox" class="checkJugada" id="check'+jugadaId+'" data-idj="'+jugadaId+'"/><label for="check'+jugadaId+'" ></label></th>  <th>'+sorteos_[i]+'</th>  <th>'+tripleta+'</th> <th>'+$('#Apuesta').val()+'</th></tr>');
								jugadaId=jugadaId+1;
							}


							$('#Apuesta').val(" ");
							$.each(checks, function(i)
								{
				
									if ($(this).prop("checked")==true )
									{
										$(this).prop("checked",false);
									}
				
								});


							$.each(dupletas, function(i)
							{
								
								$(this).val(" ");
								
								
								
							});
						}
					}


			}
			

		});
}



VerificarCredencialesLogin()
AgregarJugada()
anularJugada()
seleccionarJugada()