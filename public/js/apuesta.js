$(document).ready(function()
	{
		


		//////////////////////funciones para validar campos vacios////////////
		function buscar_datos_no_seleccionados()//verifica si loterias, dupletas o apuestas estan en blanco
		{

			var retorno=0;

			if(validar_loterias_seleccionadas()!=0)//si se seleccionaron loterias
			{
				if(validar_dupletas_insertadas()!=0)//si no existen dupletas en blanco
				{
					if($("#Apuesta").val()!='')//si se inserto la apuesta
					{
						retorno=1;
					}
					else
					{
						$("#Apuesta").focus();
						mensaje_alerta_vacio(2);
					}
				}
				else
				{
					$("#primerPremio").focus();
					mensaje_alerta_vacio(1);
					
				}
			}
			else
			{
				mensaje_alerta_vacio(0);
			}


			return retorno;


		}
		


		function mensaje_alerta_vacio(tipo_mensaje) 
		{
			var mensajes=["Debe seleccionar un sorteo!!",
						  "Debe ingresar al menos una quiniela!!",
						  "Debe ingresar una apuesta!!",
						];
				swal({
						title:''+mensajes[tipo_mensaje],//Contenido del modal
						text: '<p style="font-size: 1.5em;">'+''+'</p>',
						timer:2000,//Tiempo de retardo en ejecucion del modal
						type: "warning",
						showConfirmButton:false,//Eliminar boton de confirmacion
						html: true
					});
		
		}



		function validar_loterias_seleccionadas() //cuenta la cantidad de loterias seleccionadas
		{
			var retorno=0; //retorna 0 si no se han seleccionado loterias
			var activos=0;//cantidad de checks activos
			var sorteos=document.getElementById("sorteosDisponibles");//obtiene las loterias disponibles
			var checks=sorteos.getElementsByTagName("input");//obtiene los checks de las loterias disponibles
			var longitud=checks.length;//obtiene la cantidad de checks
			var id=null;


			for (var i = 0; i < longitud; i++) 
			{
				id=checks[i].id;//obtiene el id del check 

				if($("#"+id).prop("checked")==true)
				{activos=activos+1;}
			}

			if(activos>0)//si seleccionaron loterias 
			{retorno=1;}

			return retorno;

		}

		function  validar_dupletas_insertadas() 
		{
			var retorno=0;//retorna 0 si no se ha insertado al menos una dupleta
			var activos=0;//cantidad de inputs que poseen valores
			var jugadas=document.getElementById("tripleta");
			var dupletas=jugadas.getElementsByTagName("input");//obtiene los iputs de las dupletas insertadas
			var longitud=dupletas.length;
			
			var id=null;//id de la primera dupleta que debe insertar

			for (var i = 0; i < longitud; i++) 
			{
				if(dupletas[i].value!='')
					{activos=activos+1;}


			}
			if (activos>0)
				{retorno=1;}

			return retorno;
		}
		/////////////////////////////////////////obtener datos ingresados///////////////////////////////////////////////////////////////////////////////////////////////
		
		function completar_0_ordenar(dupletas) 
		{
				var aux;
				var jugada='';
				var longitud=dupletas.length;

				if (longitud>1)//ordena las dupletas de menor a mayor
				{
					dupletas.sort(function(a,b){return a-b;});
								
				}
				
				for (var i =0; i<longitud;i++) //convierte las dupletas en una cadena unica y le anexa cero de ser necesario
								{		
									


									if((dupletas[i]>=0 && dupletas[i]<=9)&&(dupletas[i].length==1))
										{aux='0'+String(dupletas[i]);}
									else
										{aux=String(dupletas[i]);}
									
									if(i==0)
									{
										jugada=jugada+aux;
									}
									else
									{
										jugada=jugada+'-'+aux;
									}
								}

			return jugada;
		}


		function obtener_sorteos() 
		{
			var sorteos=[];
			var sorteo=document.getElementById("sorteosDisponibles");//obtiene las loterias disponibles
			var checks=sorteo.getElementsByTagName("input");//obtiene los checks de las loterias disponibles
			var longitud=checks.length;//obtiene la cantidad de checks
			var id=null;

			

			for (var i = 0; i < longitud; i++) 
			{
				
				id=checks[i].id;
				if($("#"+id).prop("checked")==true)
				{
					sorteos.push([$("#"+id).attr("data-descripcion"),$("#"+id).attr("data-id")]);
				}

			}
		 return sorteos;
		}


		function obtener_dupletas() 
		{
			var dupletas=[];
			var jugada='';
			var aux;
			var retorno=0;//retorna 0 si no se ha insertado al menos una dupleta
			var jugadas=document.getElementById("tripleta");
			var dupleta=jugadas.getElementsByTagName("input");//obtiene los inputs de las dupletas insertadas
			var longitud=dupleta.length;
			var id=null;

			for (var i = 0; i < longitud; i++) //recorre los input
			{
				aux=dupleta[i].value;
				if(aux.length!=0)
				{
					
					if(aux.length==1 || aux.length==2)
					{
						
						 dupletas.push(aux);
					}
					else if(aux.length>=3)
					{
						
						if(id==null)
						{
							id=dupleta[i].id;
						}
					}
					
				}
			}
			
			
			if(id==null)//si no hay dupletas invalidas
			{
				jugada=completar_0_ordenar(dupletas,longitud);//ordena la tripleta copleta con 0
			}
			else//si hay dupletas invalidas
			{
				
				$("#"+id).focus();
				mensaje_alerta_dato(0);
			}
			
			return jugada; 
		}


		function mostrar_jugadas (sorteo,jugada,apuesta,fila) 
		{
			$('#tablaJugadas').append(' <tr class="resultadoi" id="filaJugada'+fila+'"  data-id="'+fila+'"">  <th class="celda"><input  data-id="'+fila+'"   data-apuesta="'+apuesta+'" type="checkbox" class="checkJugada" id="check'+fila+'" /><label for="check'+fila+'" ></label></th>  <th class="celda1">'+sorteo+'</th>  <th class="celda1">'+jugada+'</th> <th class="celda1" >'+apuesta+' €'+'</th></tr>');
			$('#chekJugadas').prop('checked',false);
		}

		function eliminar_jugada(fila) 
		{
			elemento=$('#filaJugada'+fila).remove();
			return(0);
		}


		function actualizar_proxima_fila(proxima) 
		{
			
			$("#jugadaId").val(proxima);
			return(0);	
		}

		function reestablecer_total () 
		{
			$("#valorTotal").val(0);
			$("#dineroTotal").text("0 €");	
		}

		function actualizar_total(apuesta) 
		{
			var acumulado=parseInt($("#valorTotal").val())+parseInt(apuesta);
			$("#valorTotal").val(acumulado);
			$("#dineroTotal").text(acumulado+" €");
			return(0);
		}

		function restar_acumulado(acumulado) 
		{
			$("#valorTotal").val(acumulado);
			$("#dineroTotal").text(acumulado+" €");
			return(0);
		}
		

		function obtener_apuesta(jugada,sorteos) 
		{
			var longitud=jugada.length;
			var tipo;//0 quiniela 1 pale 2 tripleta
			var url="/limitesJugada";
			var apuesta=parseInt($("#Apuesta").val());
			
			
			
			
			if(longitud==2)
				{tipo=0;}
			else if(longitud==5)
				{tipo=1;}
			else if(longitud==8)
				{tipo=2;}

			var fila=$("#jugadaId").val();

			var datos=[jugada,tipo,apuesta,sorteos,fila];
			
			var consulta= $.get(url,{informacion:datos},function(resultado)


				{
				


					var informacion=JSON.parse(resultado);
					var cantidad_sorteos=informacion[0].length;
					var sorteo;
					var diferencia;
					var codigo;
					var mensaje="";
					
					var usuario;
					var total;
					var jugadaId;
					 if(informacion[1]!=0)//si existen mensajes que mostrar
						{

					//mostrar mensajes de advertencia
							for (var i = 0; i < cantidad_sorteos; i++) 
							{
								codigo=informacion[0][i]["codigo"];
								
								sorteo=informacion[0][i]["sorteo"];

								diferencia=informacion[0][i]["diferencia"];
								
								mensaje=mensaje+codigo_mensaje(codigo,sorteo,apuesta,jugada,diferencia);
								
							}

							mensaje_error(mensaje);
						}
					///mostrar jugadas por pantalla
					total=0;
					actualizar_proxima_fila(informacion[2]);
					for (var i = 0; i < cantidad_sorteos; i++) 
					{
							
						if(informacion[0][i]["aprobada"]==1)
						{
							
							sorteo=informacion[0][i]["sorteo"];
							usuario=informacion[0][i]["usuario"];
							fila=informacion[0][i]["fila"];

							mostrar_jugadas (sorteo,jugada,apuesta,fila);
							actualizar_total(apuesta);
							

							if(informacion[1]==0)
							{
								limpiar_formulario();
							}
						}

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





		function limpiar_apuesta() 
		{
			$('#Apuesta').val("");
			$("#Apuesta").focus();

			return 0;
		}

		function limpiar_formulario() 
		{
			$("#primerPremio").val("");
			$("#segundoPremio").val("");
			$("#tercerPremio").val("");
			$('#Apuesta').val("");

			$("#primerPremio").focus();


			return 0;
		}


		function codigo_mensaje(codigo,sorteo,apuesta,jugada,diferencia) 
								{
									var mensaje="";
									if (codigo==0) 
									{

										mensaje=mensaje+'<div > <label style="font-size: 0.8em;color: #000000;"> La jugada: </label>  <label style="font-size: 0.8em;color: #072150  ;">'+jugada+'  </label>  ' +'<label style="font-size: 0.8em;color: #000000;"> para: </label>   <label style="font-size: 0.8em;color: #072150  ;">'+sorteo+'  </label>  '+' <label style="font-size: 0.8em;color: #D42304;"> | Debe poseer una apuesta mayor que 0  </label> </div>'+'<br>';
										limpiar_apuesta();
									}
									else if(codigo==1)
									{
										mensaje=mensaje+'<div> <label style="font-size: 0.8em;color: #000000;"> La jugada: </label>  <label style="font-size: 0.8em;color: #072150  ;">'+jugada+'  </label>  ' +'<label style="font-size: 0.8em;color: #000000;"> para: </label>   <label style="font-size: 0.8em;color: #072150  ;">'+sorteo+'  </label>  '+'<label style="font-size: 0.8em;color: #000000;">  </label> <label style="font-size: 0.8em;color: #072150  ;"> </label>   <label style="font-size: 0.8em;color: #D42304;"> | Ya logro su meta de ventas.</label> </div>'+'<br>';
										limpiar_formulario();

									}
									else if(codigo==2)
									{
										mensaje=mensaje+'<div > <label style="font-size: 0.8em;color: #000000;"> La jugada: </label>  <label style="font-size: 0.8em;color: #072150  ;">'+jugada+'  </label>  ' +'<label style="font-size: 0.8em;color: #000000;"> para: </label>   <label style="font-size: 0.8em;color: #072150  ;">'+sorteo+'  </label>  '+'<label style="font-size: 0.8em;color: #000000;"> Por: </label> <label style="font-size: 0.8em;color: #072150  ;">'+apuesta+' € '+'  </label>  '+' <label style="font-size: 0.8em;color: #0A6E32;"> | Alcanzo su meta de ventas .</label> </div>'+'<br>';
										limpiar_formulario();
									}
									else if(codigo==3)
									{

										mensaje=mensaje+'<div  > <label style="font-size: 0.8em;color: #000000;"> La jugada: </label>  <label style="font-size: 0.8em;color: #072150  ;">'+jugada+'  </label>  ' +'<label style="font-size: 0.8em;color: #000000;"> para: </label>   <label style="font-size: 0.8em;color: #072150  ;">'+sorteo+'  </label>  '+'<label style="font-size: 0.8em;color: #000000;"> Por: </label> <label style="font-size: 0.8em;color: #072150  ;">'+apuesta+' € '+'  </label>  '+' <label style="font-size: 0.8em;color: #EA8613;"> |  Usted cuenta solo con: '+diferencia+' €  para ella.' + '</label> </div>'+'<br>';
										limpiar_apuesta();
									}
									else if(codigo==5)
									{
										mensaje=mensaje+'<div " > <label style="font-size: 0.8em;color: #000000;"> La jugada: </label>  <label style="font-size: 0.8em;color: #072150  ;">'+jugada+'  </label>  ' +'<label style="font-size: 0.8em;color: #000000;"> para: </label>   <label style="font-size: 0.8em;color: #072150  ;">'+sorteo+'  </label>  '+' <label style="font-size: 0.8em;color: #D42304;"> | Se encuentra en el ticket  </label> </div>';
										limpiar_formulario();
									}

									return(mensaje);
								}

		function mensaje_error (mensaje) 
		{
			
			swal({
					title:'Notificacion!!!  ',//Contenido del modal
					text: '<p style="font-size: 0.7em;">'+mensaje+'</p>',
					type: "warning",
					showConfirmButton:true,
					html: true
				});
				

		}

		function mensaje_alerta_apuesta (tipo_mensaje,apuesta,limite) 
		{
			var mensajes=["La apuesta de: "+apuesta+" €, no  esta permitida para quiniela!!",
						  "La apuesta de: "+apuesta+" €, no  esta permitida para pale!!",
						  "La apuesta de: "+apuesta+" €, no  esta permitida para tripleta!!"
						  ];

				swal({
						title:''+mensajes[tipo_mensaje],//Contenido del modal
						text: '<p style="font-size: 1.5em;">'+'El limite para este jugada es de : '+limite+'€'+'</p>',
						timer:3000,//Tiempo de retardo en ejecucion del modal
						type: "error",
						showConfirmButton:false,//Eliminar boton de confirmacion
						html: true
					});
		}


		function mensaje_alerta_dato(tipo_mensaje) 
		{
			var mensajes=["Inserto dupletas que son incorrectas!!",
						  "Debe insertar una apuesta minima de 1 €!!"
						];

				swal({
						title:''+mensajes[tipo_mensaje],//Contenido del modal
						text: '<p style="font-size: 1.5em;">'+''+'</p>',
						timer:3000,//Tiempo de retardo en ejecucion del modal
						type: "warning",
						showConfirmButton:false,//Eliminar boton de confirmacion
						html: true
					});
		}
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		////////////////////////////////anular jugadas//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		function contar_jugadas_seleccionadas(checks) 
		{
			var c=0;
			$.each(checks,function(i)//cuenta la cantidad de cheks seleccionados
						{

							if ($(this).prop('checked')==true) 
							{

								c=c+1;
							}
						})
			return(c);

		}

		function obtener_id_jugadas_apuesta(checks) 
		{
			var filas=[];
			$.each(checks,function(i)//cuenta la cantidad de cheks seleccionados
						{
							if($(this).prop('checked')==true)
							{
								filas.push([$(this).attr("data-id"),$(this).attr("data-apuesta")]);
							}
						})
			return(filas);
		}



		
		///////////////////////////cotroladores focus////////////////////////////////////////
		//$("#sorteosDisponibles").on("focus",".loteriai",function(){});
		//////////////////////////////////////controladores imprimir ticket///////////////////

		////////////////////////////////controladores anular jugada/////////////////////////////////////////////
		$("#tablaJugadas").on("change",".checkJugada",function()//seleccionar jugadas impresas
			{
				var tabla=document.getElementById('tablaJugadas');
				var checks=tabla.getElementsByTagName("input");
				var cantidad_checks=checks.length;
				var cantidad_seleccionados=0;
				var estado=$(this).prop('checked');

				if(cantidad_checks==1)//si existe solo uno
				{
					$("#chekJugadas").prop('checked',estado);

				}
				else if(cantidad_checks>1)//si existen varios
				{
					
					cantidad_seleccionados=contar_jugadas_seleccionadas(checks);
					if(cantidad_seleccionados==cantidad_checks)//si fueron seleccionados todos marca el check principal
					{
						$("#chekJugadas").prop('checked',true);
					}
					else
					{
						$("#chekJugadas").prop('checked',false);
					}
				}
				
			

			});



		$("#chekJugadas").change(function()//seleccionar check principal de jugadas
			{
				var tabla=document.getElementById('tablaJugadas');
				var checks=tabla.getElementsByTagName("input");
				var estado=$(this).prop('checked');
				
				var cantidad_checks=checks.length;
				

				if (cantidad_checks>0) 
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


		////////////////////////////anular jugada/////////////////////////////////////////////////
		$("#anularJugada").click(function()
			{
				var tabla=document.getElementById('tablaJugadas');
				var checks=tabla.getElementsByTagName("input");
				var checks_seleccionados=contar_jugadas_seleccionadas(checks);
				var total_apuesta=$("#valorTotal").val();
				var url="/anularJugada";
				var filas;
				var datos;
				var cantidad_jugadas;

				if(checks_seleccionados>0)//si existen jugadas seleccionadas
				{
					filas=obtener_id_jugadas_apuesta(checks);
					datos=[filas,total_apuesta];
					var consulta= $.get(url,{informacion:datos},function(total_apuesta)
						{
							restar_acumulado(total_apuesta);
							cantidad_jugadas=filas.length;
							for (var i = 0; i < cantidad_jugadas; i++) 
							{
								eliminar_jugada(filas[i][0]);
							}
							
							$("#chekJugadas").prop('checked',false);
							
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
				

			});





		/////////////////////////////////////controladores//////////////////////////////
			$("#ADD1").click(function()//al presionar el boton add
			{
				var sorteos;
				var jugada;
				var apuesta;

				if(buscar_datos_no_seleccionados()!=0)//si no existen datos vacios 
				{
					sorteos=obtener_sorteos();
					jugada=obtener_dupletas();
					
					if(jugada.length!=0)//si inserto una jugada correcta
					{
						apuesta=obtener_apuesta(jugada,sorteos);
						
					}

					

				}
				



			});


			$( "#Apuesta" ).keypress( function (e) //al presionar enter luego de insertar la apuesta
			{
		 		 var tecla = (document.all) ? e.keyCode : e.which;
		 		 if(tecla==13)
		 		 {
		 		 	
		 		 	 $('#ADD1').trigger('click');

		 		 }
	 		
	 			
	 		});


			$("#imprimirTicket").click(function()
				{
					var tabla=document.getElementById('tablaJugadas');
					var checks=tabla.getElementsByTagName("input");
					var cantidad_jugadas=checks.length;
					var url="/generarTicket";
					var filas=[];
					var apuestas=[];
					var datos;
					var aux;

					if (cantidad_jugadas>0)
					{
								

						  swal({
								title: "Generacion de ticket",
								text: "¿ Desea generar el ticket ?",
								type: "warning",
								showCancelButton: true,
								confirmButtonColor:"#319A0E",
								cancelButtonColor:"#207D07",
								confirmButtonText: "Generar",
								cancelButtonText: "Cancelar",
								closeOnConfirm: false,
								closeOnCancel: false
							 },

							 function(isConfirm)
							 {
							 	if(isConfirm)//pasar peticion
							 	{
							 		
										$.each(checks,function(i)//obtiene los id de las jugadas insertadas
										{

											aux=$(this).attr('data-id');
											aux_=$(this).attr('data-apuesta');

											filas.push(aux);
											apuestas.push(aux_);
										})

										datos=[filas,apuestas];


										var consulta=$.get(url,{informacion:datos},function(resultado)
											{
												if(resultado!=0)
												{
													
													actualizar_proxima_fila(0) ;
													reestablecer_total();
													for (var i = 0; i < cantidad_jugadas; i++) 
													{
														eliminar_jugada(filas[i]);
													}
													var url="/imprimirTicket/"+resultado;
													window.open(url, "Ticket", "width=900, height=500");
												}
												swal({
												title:'El ticket fue generado',//Contenido del modal
												text: '<p style="font-size: 1.5em;">'+''+'</p>',
												timer:1000,//Tiempo de retardo en ejecucion del modal
												type: "success",
												showConfirmButton:false,//Eliminar boton de confirmacion
												html: true
											});
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

							else{
								swal({
								title:'Se cancelo la impresion del ticket!!',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+''+'</p>',
								timer:1000,//Tiempo de retardo en ejecucion del modal
								type: "success",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html: true
							});
							}

						});
						
					}
				

				});


			
			
	
	});