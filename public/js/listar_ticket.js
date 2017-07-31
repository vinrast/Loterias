$(document).ready(function()

	{
			///////////////////////funciones////////////////////////////////

			function imprimir_ticket (id) 
			{
				var url="/imprimirTicket/"+id;
				window.open(url, "Ticket", "width=900, height=500");
				return 0;
			}



			function anular_ticket(id,nro)
			{

				
				  swal({
						title: "Anulacion de ticket!!!",
						text: "¿ Desea anular el ticket: "+nro+"?",
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
					 		
							var url='/anularTicket/'+id;
						
							var anular= $.get(url,function(resultado)
								{
									
									if (resultado!=0) 
									{
										$("#ticket"+id).remove();//elimina el registro del ticket e la vista
										swal({
										title:'El ticket: '+nro+' , fue anulado exitosamente!!',//Contenido del modal
										text: '<p style="font-size: 1.5em;">'+''+'</p>',
										timer:2000,//Tiempo de retardo en ejecucion del modal
										type: "success",
										showConfirmButton:false,//Eliminar boton de confirmacion
										html: true
									});

									}
									else
									{

										swal({
											title:'El ticket: '+nro+' , np pudo ser eliminado!!',//Contenido del modal
											text: '<p style="font-size: 1.5em;">'+''+'</p>',
											timer:2000,//Tiempo de retardo en ejecucion del modal
											type: "error",
											showConfirmButton:false,//Eliminar boton de confirmacion
											html: true
										});
									}
									
								});
						 		anular.fail(function() 
						 		{
						
									swal({
										title:'Error al anular ticket!!',//Contenido del modal
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
										title:'Anulacion cancelada!!',//Contenido del modal
										text: '<p style="font-size: 1.5em;">'+''+'</p>',
										timer:1000,//Tiempo de retardo en ejecucion del modal
										type: "success",
										showConfirmButton:false,//Eliminar boton de confirmacion
										html: true
									});
					 	}
					 }
					);	


				return 0;
			}


			function premios_ticket (id,numero,fecha) 
			{
				
				var url="/premiosTicket/"+numero;
				$('#numeroT').text('Ticket: '+numero+' | Fecha: '+fecha);
				$('#tablaPremios').attr('data-ticket',numero);
				$('#tablaPremios').attr('data-id',id);
				

				var consulta= $.get(url,function(resultado)
								{

									var jugadas=JSON.stringify(resultado[0]);
									jugadas=JSON.parse(jugadas);

									var sorteos_pendientes=JSON.stringify(resultado[1]);
									sorteos_pendientes=JSON.parse(sorteos_pendientes)

									var total=0;
									var cantidad=jugadas.length;
									var cantidad_sorteos=sorteos_pendientes.length;

									
									
									
									$("#tablaPremios").empty();//limpia la tabla 
									for (var i = 0; i < cantidad; i++) 
									{
										$("#tablaPremios").append('<tr> <td colspan="'+2+'" style="border: 1px solid #88EED5;background:#88EED5; ">'+jugadas[i].sorteo+'</td><td colspan="'+2+'" style="border: 1px solid #88EED5;background:#88EED5; "> Jugada ganadora: '+jugadas[i].ganadora+'</td>   </tr><tr style=" border-bottom: 1px solid #B3EEDF;background:#F8FBFA;"><td>Jugada</td><td>Apuesta</td><td colspan="'+2+'">Premio</td></tr><tr style=" border-bottom: 1px solid #B3EEDF;background:#F8FBFA"> <td >'+jugadas[i].jugada+'</td> <td>'+jugadas[i].apuesta+' €'+'</td> <td> '+jugadas[i].premio+'</td></tr><tr style="background:#F8FBFA;"><td colspan="'+4+'" >Pago correspondiente: '+jugadas[i].pago+' €'+'</td></tr><br><br>')
										total=total+jugadas[i].pago;
									}

									$("#tablaPremios").append('<tr style="background:#C8EEE4"><td colspan="'+4+'">Total en premios: '+total+' €'+'</td></tr>')
									if (cantidad_sorteos==0) //sorteos pendientes no existen
										{
											$("#tablaPremios").append('<tr style="background:#FFF5F5"><td colspan="'+4+'">No posee sorteos pendientes.</td></tr>')
										}
									else
									{
										var aux="";
										for (var i = 0; i < cantidad_sorteos; i++) 
										{
											
											aux=aux+sorteos_pendientes[i].sorteo+"<br>";

										}
										$("#tablaPremios").append('<tr style="background:#FFF5F5;"><td colspan="'+4+'" style="text-align:center;"> Sorteos pendietes: <br>'+aux+'</td></tr>');

									
									}
									$("#tablaPremios").attr('data-total',total);
									$('#modal_pagos').modal('open');//abrir el modal

								});
					consulta.fail(function() 
						 		{
						
									swal({
										title:'Error al consultar premios del ticket!!',//Contenido del modal
										text: '<p style="font-size: 1.5em;">'+'Pongase en contacto con el administrador'+'</p>',
										timer:2000,//Tiempo de retardo en ejecucion del modal
										type: "error",
										showConfirmButton:false,//Eliminar boton de confirmacion
										html: true
									});
								});
				
			}

			//////////////////////controladores de eventos//////////////////////////////////////////

		$("#listaTicket").on("click",".boton_t",function()//detecta cuando se teclean los botones para un ticket
			{
				var boton=$(this);
				var id=boton.attr('data-id');
				var descripcion=boton.attr('data-descripcion');
				var numero=$("#ticket"+id).attr('data-numero');
				var fecha=$("#ticket"+id).attr('data-fecha');
				if(descripcion=="Imprimir")
				{
					imprimir_ticket(id);
				}
				else if(descripcion=="Anular")
				{
					
					anular_ticket(id,numero);
					
				}
				else if(descripcion=="Pagar")
				{
					premios_ticket(id,numero,fecha);
				}

			});

		
		$("#cancelarPago").click(function()
			{
				$('#modal_pagos').modal('close');
			});//cierra el modal de jugadas premiadas


		$("#pagarTicket").click(function()
			{

				 var numero=$("#tablaPremios").attr('data-ticket');
				 var total=$("#tablaPremios").attr('data-total');
				 var id=$("#tablaPremios").attr('data-id');

				 swal({
						title: "Pago de ticket!!!",
						text: "¿ Desea pagar el ticket: "+numero+", por un monto de:"+total+" € ?",
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
					 		
							var url="/pagarTicket/"+numero;

						
							var pagar= $.get(url,function(resultado)
								{
									if (resultado!=0) 
									{
										$('#modal_pagos').modal('close');
										$("#Pagar"+id).remove();
										swal({
											title:'El monto: '+total+' €, fue cancelado para el ticket: '+numero,//Contenido del modal
											text: '<p style="font-size: 1.5em;">'+''+'</p>',
											
											type: "success",
											showConfirmButton:true,//Eliminar boton de confirmacion
											html: true
									});

									}
								
								});

								pagar.fail(function() 
						 		{
						
									swal({
										title:'Error al pagar el ticket!!',//Contenido del modal
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
										title:'Pago cancelado!!',//Contenido del modal
										text: '<p style="font-size: 1.5em;">'+''+'</p>',
										timer:1000,//Tiempo de retardo en ejecucion del modal
										type: "success",
										showConfirmButton:false,//Eliminar boton de confirmacion
										html: true
									});
					 	}
					 }
					);	



			});

		function buscar_patron (texto) 
		{
			var prefijo='LTR-';
			var patron=new RegExp('^'+texto);
			var retorno;
			if(prefijo.match(patron)!=null)//si el texto contiene letras del prefijo
			{
				retorno=true;
			}
			else
			{
				patron=new RegExp('^'+prefijo);
				if(texto.match(patron)!=null)
				{
					retorno=true
				}
				else
				{retorno=false;}
			}
			
			return retorno;
		}

		$("#buscadorT").keyup(function()
			{
				
				var valor=$("#buscadorT").val().toUpperCase();
				
				var registros=document.getElementsByName('_registro_');
				var auxiliar;
				if (buscar_patron(valor)==false) 
				{
					valor='LTR-'+valor;
				}

				var patron=new RegExp('^'+valor);
				$.each(registros,function(i)//cuenta la cantidad de cheks seleccionados
						{
							auxiliar=$(this).attr('data-numero').match(patron);
							
							if (auxiliar!=null) //si coincide
							{
								$(this).show();//mostrar
							}
							else if(auxiliar==null)
							{
								$(this).hide();//ocultar
							}
							
						})

				
			});





















	});