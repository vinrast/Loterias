$(document).ready(function()
	{
	
		
		function elementos_vacios(id_elemento) 
		{
			  var id=id_elemento;
			  var registros=["primerPremio"+id,"segundoPremio"+id,"tercerPremio"+id];
			  var c=0;
			  var id=0;

				for (var i = 0; i < 3; i++) 
				{
					if ($("#"+registros[i]).val().length!=0) 
						{c=c+1;}
					else
					{
						if(id==0)
							{id=registros[i];}
					}
				}
			 return([c,id]);

		}

		function mensaje_error(i) 
		{
			var mensajes=['Debe ingresar una tripleta!!!','Debe ingresar dupletas validas!!']
			swal({
						title:''+mensajes[i],//Contenido del modal
						text: '<p style="font-size: 1.5em;">'+''+'</p>',
						timer:2000,//Tiempo de retardo en ejecucion del modal
						type: "warning",
						showConfirmButton:false,//Eliminar boton de confirmacion
						html: true
					});
		}

		function tripletas_invalidas(id) 
		{
			  var id=id;
			  var registros=["primerPremio"+id,"segundoPremio"+id,"tercerPremio"+id];
			  var c=0;
			  for (var i = 0; i < 3; i++) 
			  {
			  	 if ($("#"+registros[i]).val().length>2) 
			  	 {
			  	 	if(c==0)
			  	 	{
			  	 		c=registros[i];
			  	 	}
			  	 }
			  }
			  

				return c;
		}

		function completar_0 (id) 
		{
			var registros=["primerPremio"+id,"segundoPremio"+id,"tercerPremio"+id];
			var valor;
			for (var i = 0; i < 3; i++) 
			{
				valor=$("#"+registros[i]).val()
				if(valor.length==1)
				{
					$("#"+registros[i]).val('0'+valor);
				}
			}
			return(1);
		}
		function obtener_tripleta(id)
		{
			var registros=["primerPremio"+id,"segundoPremio"+id,"tercerPremio"+id];
			var tripleta="";
			var valor;

			for (var i = 0; i < 3; i++) 
			{
				valor=$("#"+registros[i]).val();
				if(valor!='')
				{
					if(i==1 || i==2)
					{
						tripleta=tripleta+"-"+valor;
					}
					else
					{
						tripleta=tripleta+valor;
					}
				}
			}
			return tripleta;

		}

		function deshabilitar_input(id_elemento) 
		{
			var registros=["primerPremio"+id_elemento,"segundoPremio"+id_elemento,"tercerPremio"+id_elemento];
			for (var i = 0; i < 3; i++) 
			{
				$("#"+registros[i]).attr('disabled','disabled');
			}
			return 0;
		}

		//////////////////////////////////controlador de eventos////////////////////////////

		$(".guardar_jugada").click(function()
		{
				var id_elemento=$(this).attr('data-id');
				var aux;
				var tripleta;
				var sorteo;
				aux=elementos_vacios(id_elemento);

				if(aux[0]!=3)//si los iputs estan vacios
				{
					$("#"+aux[1]).focus();
					mensaje_error(0);
				}
			else if(aux!=0)//si se ingresan jugadas
				{
					
					aux=tripletas_invalidas(id_elemento);
					if(aux!=0)//si existen dupletas invalidas
					{
						$("#"+aux).focus();
						mensaje_error(1);
					}
					else//si no existen dupletas invalidas
					{
						completar_0(id_elemento);
						tripleta=obtener_tripleta(id_elemento);
						sorteo=$("#"+"guardar"+id_elemento).attr('data-descripcion');
						
						var datos=[tripleta,sorteo];
						var url="/jugadaGanadora";
						

						var consulta= $.get(url,{datos:datos},function(resultado)
						{
							var mensajes=["No existen tickets premiados para este sorteo ","Nro de tickets premiados: "+resultado[1][1]+"  <br> Total pagos: "+resultado[1][2]+" €"]
							if(resultado[0]!=0)
							{
								swal({
												title:'La jugada fue asociada al sorteo: '+sorteo,//Contenido del modal
												text: '<p style="font-size: 1.5em;">'+mensajes[1]+'</p>',
												
												type: "success",
												showConfirmButton:true,//Eliminar boton de confirmacion
												html: true
								});
								$("#"+"guardar"+id_elemento).remove();
								deshabilitar_input(id_elemento);
							}
							else if(resultado==0)
							{
								swal({
												title:'El sorteo posee una jugada asociada!!! ',//Contenido del modal
												text: '<p style="font-size: 1.5em;">'+''+'</p>',
												timer:2000,//Tiempo de retardo en ejecucion del modal
												type: "warning",
												showConfirmButton:false,//Eliminar boton de confirmacion
												html: true
								});
							}	
						});	
						consulta.fail(function()
						{
							swal({
								title:'Error inesperado!!',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+'Comuniquese con el administrador'+'</p>',
								timer:2000,//Tiempo de retardo en ejecucion del modal
								type: "warning",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html: true
							});

						});

						
						}
					}
				});



	$("#cierreDiario").click(function() 
	{
						
			swal({
					title: "Cierre de turno",
					text: "¿ Desea cerrar el turno?",
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
								var url='/cierreDiario';
								var cierre= $.get(url,function(resultado)
												{
													if (resultado[0]==0) 
													{
														var url="/resumenDiario/"+resultado[1];
														window.open(url, "Resumen Diario", "width=900, height=500");
														swal({
																title:'Cierre de turno exitoso!!',//Contenido del modal
																text: '<p style="font-size: 1.5em;">'+''+'</p>',
																timer:2000,//Tiempo de retardo en ejecucion del modal
																type: "success",
																showConfirmButton:false,//Eliminar boton de confirmacion
																html: true
															});
														
														location.href="/administracion/jugada_dia";

													}
													else if (resultado[0]==1)
													{
														swal({
																title:'El turno se encuentra cerrado!!',//Contenido del modal
																text: '<p style="font-size: 1.2em;">'+''+'</p>',
																
																type: "warning",
																showConfirmButton:true,//Eliminar boton de confirmacion
																html: true
															});


													}
													else if(resultado[0]==2)
													{

														swal({
																title:'No se realizo el cierre!!',//Contenido del modal
																text: '<p style="font-size: 1.2em;">'+'Existen sorteos que no poseen jugadas asociadas'+'</p>',
																
																type: "warning",
																showConfirmButton:true,//Eliminar boton de confirmacion
																html: true
															});
													}

												});
									cierre.fail(function()
												{
													swal({
														title:'Error inesperado!!',//Contenido del modal
														text: '<p style="font-size: 1.5em;">'+'Comuniquese con el administrador'+'</p>',
														timer:2000,//Tiempo de retardo en ejecucion del modal
														type: "warning",
														showConfirmButton:false,//Eliminar boton de confirmacion
														html: true
													});

												});
						}
						else
						{


							swal({
									title:'Cierre de turno cancelado!!',//Contenido del modal
									text: '<p style="font-size: 1.5em;">'+'El turno se mantendra abierto'+'</p>',
									timer:2000,//Tiempo de retardo en ejecucion del modal
									type: "warning",
									showConfirmButton:false,//Eliminar boton de confirmacion
									html: true
								});

						}
					});








	})


$("#abrirDiario").click(function()
	{
								

		  swal({
				title: "Apertura de turno",
				text: "¿ Desea abrir un turno ?",
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


								var url="/abrirSistema";
								var abrir=$.get(url,function(resultado)
									{
										if(resultado==0)//si no se pudo abrir el turno
										{

											swal({
													title:'Existe un turno abierto!!',//Contenido del modal
													text: '<p style="font-size: 1.2em;">'+''+'</p>',	
													type: "warning",
													showConfirmButton:true,//Eliminar boton de confirmacion
													html: true
												})
										}
										else if(resultado==1)//si se pudo realizar el cierre
										{
											swal({
													title:'Apertura de turno exitosa!!',//Contenido del modal
													text: '<p style="font-size: 1.2em;">'+'Se habilito un nuevo turno'+'</p>',	
													timer:3000,//Tiempo de retardo en ejecucion del modal
													type: "success",
													showConfirmButton:false,//Eliminar boton de confirmacion
													html: true
												})
											location.href="/administracion/jugada_dia";
										}

									});
								abrir.fail(function()
												{
													swal({
														title:'Error inesperado!!',//Contenido del modal
														text: '<p style="font-size: 1.5em;">'+'Comuniquese con el administrador'+'</p>',
														timer:2000,//Tiempo de retardo en ejecucion del modal
														type: "warning",
														showConfirmButton:false,//Eliminar boton de confirmacion
														html: true
													});

												});
					}
					else
					{

						swal({
								title:'La apertura del turno fue cancelada!!',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+''+'</p>',
								timer:2000,//Tiempo de retardo en ejecucion del modal
								type: "warning",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html: true
							});
					}
				});



	})


});





