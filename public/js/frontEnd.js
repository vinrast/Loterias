
function guardarJugada() 
{
	$(".guardarJugada").click(function()
		{


			alert('hola');
		});
}



function presionarEnter()
{
	$( "#Apuesta" ).keypress( function (e) 
	{
 		 var tecla = (document.all) ? e.keyCode : e.which;
 		 if(tecla==13)
 		 {
 		 	
 		 	 $('#ADD').trigger('click');

 		 }
 		
 			
 	});
 		
}

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

function borrarInput(dupletas)
{
	
	$.each(dupletas, function(i)
		{
								
			$(this).val(" ");
								
								
								
		});

}

function borrarJugadas () //borra la lista de jugadas
{
	
	var premios=['primerPremio','segundoPremio','tercerPremio','Apuesta'];
	
	for (var i = 0; i < premios.length; i++) 
	{
		$('#'+premios[i]).val('');
	}


	for ( var i=0;i<$('#jugadaId').val(); i++) 
	{
		$('#filaJugada'+i).remove();
		
	}
	$('#jugadaId').val(0);
	$('#valorTotal').val(0);
	$('#dineroTotal').text(	'0 €');
	$("#chekJugadas").prop('checked',false);


}

function limpiarVentasImprimir() 
{
	var url='/generarTicket';

	var generar= $.get(url,function(resultado)
		{
			alert(resultado);
			url='/imprimirTicket/'+resultado;
			window.open(url, "Ticket", "width=300, height=500");
			


		});
	generar.fail(function() {
				
				swal({
						title:'Error al generar el ticket!!',//Contenido del modal
						text: '<p style="font-size: 1.5em;">'+'Pongase en contacto con el administrador'+'</p>',
						timer:2000,//Tiempo de retardo en ejecucion del modal
						type: "error",
						showConfirmButton:false,//Eliminar boton de confirmacion
						html: true
					});
			});


}



function generarTicket() 
{
	$('#imprimirTicket').click(function()
		{
			
			var tabla=document.getElementById('tablaJugadas');
			var checks=tabla.getElementsByTagName("input");

			
			if(checks.length>0)
			{
				 

				 borrarJugadas();
				 limpiarVentasImprimir();
			}

			

			
		});
}



function insertarApuesta (sorteos_,jugadaId,tripleta) 
{
	
			var valor=0;

							for (var i = 0; i < sorteos_.length; i++) 
							{
								
							
								$('#tablaJugadas').append(' <tr class="resultadoi" id="filaJugada'+$('#'+jugadaId).val()+'" data-apuesta="'+$('#Apuesta').val()+'">  <th class="celda"><input type="checkbox" class="checkJugada" id="check'+$('#'+jugadaId).val()+'" data-idj="'+$('#'+jugadaId).val()+'"/><label for="check'+$('#'+jugadaId).val()+'" ></label></th>  <th class="celda1">'+sorteos_[i]+'</th>  <th class="celda1">'+tripleta+'</th> <th id="apuesta'+$('#'+jugadaId).val()+'" >'+$('#Apuesta').val()+' €'+'</th></tr>');
								valor=parseInt($('#valorTotal').val())+parseInt($('#Apuesta').val());
								$('#valorTotal').val(valor);
								
								$('#'+jugadaId).val(parseInt($('#'+jugadaId).val())+1);
							}


							$('#dineroTotal').text(	valor+' €');
							
							


							





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


function anularJugada()
{
	$("#anularJugada").click(function()
		{

			var tabla=document.getElementById('tablaJugadas');
			var checks=tabla.getElementsByTagName("input");
			var longitud=checks.length;
			var ids=[];
			var valor=0;
			
			var c=0;//seleccionados

			$.each(checks,function()
				{
					if($(this).prop('checked')==true)
					{
						c=c+1;
						ids.push($(this).attr('data-id'));

					}
				
				});
			
			if(c>0 && longitud>0)
			{

							
				 var url='/anularJugada';
				 var elemento=null;
				 var valor=$('#valorTotal').val();


				 var eliminar= $.get(url,{datos:ids},function(resultado)
					{

							 	
							if(resultado>0)
							{


									for (var i = 0; i < ids.length; i++)
									 {
										
									 	
									 	elemento=$('#filaJugada'+ids[i]);
									 	valor=valor-parseInt(elemento.attr('data-apuesta'));

									 	
										$('#filaJugada'+ids[i]).remove();
										
									}
									 $('#valorTotal').val(valor);
									
									$("#chekJugadas").prop('checked',false);

									$('#dineroTotal').text(	valor +' €');
						}
					});
				 eliminar.fail(function()
								{
									swal({
											title:'Error inesperado!!',//Contenido del modal
											text: '<p style="font-size: 1.5em;">'+'Pongase en contacto con el administrador'+'</p>',
											timer:3000,//Tiempo de retardo en ejecucion del modal
											type: "error",
											showConfirmButton:false,//Eliminar boton de confirmacion
											html: true
										});


								});
					

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
		alert(checks.length);

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
		
			var jugadaId=$('#jugadaId').val(); 
			var sorteos_=[];
			var ids=[];
			var jugadas=[];
			var apuestas=[];


			var c=0;
			var sorteo=null;
			$.each(checks, function(i)
			{
				
				if ($(this).prop("checked")==true )
				{
					c=c+1;
					
					sorteos_.push($(this).attr('data-descripcion'));
					ids.push($(this).attr('data-id'));
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
				$('#primerPremio').focus();
			}
			else if(c>=1)//si se seleccionan sorteos
			{
				
				var sorteos=document.getElementById('tripleta');
				var dupletas=sorteos.getElementsByTagName("input");
				var tripleta=" ";
				var aux=[];
				var inc=0;
				var errorDup="";
				var idErr=null;

				c=0;

				$.each(dupletas, function(i)
				{
					
					if ($(this).val()!='')
					{
												
						if($(this).val().length==1)
						{
							
							aux.push('0'+$(this).val());
						}
						else if($(this).val().length==2)
						{
							

							aux.push($(this).val());//valores en un arreglo

						}
						else if($(this).val().length>2)
						{
							
							errorDup=errorDup+' '+$(this).val()+' '+'<br>';
							if(idErr==null)
							{
							  idErr=$(this);
							}
						}
						c=c+1;




					}
					
					
				});


				

				if (c==0) 
					{
						swal({
								title:'Debe ingresar al menos una Quiniela!!',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+''+'</p>',
								timer:2000,//Tiempo de retardo en ejecucion del modal
								type: "warning",
								showConfirmButton:false,//Eliminar boton de confirmacion
								html: true
						});
						$('#primerPremio').focus();
					}
				else if (c>0 && errorDup!="")
				{
					swal({
								title:'Las siguientes combinaciones no son dupletas : ',//Contenido del modal
								text: '<p style="font-size: 1.5em;">'+errorDup+'</p>',
								timer:3000,
								type: "error",
								showConfirmButton: false,//Eliminar boton de confirmacion
								html: true
						});
					idErr.focus();
				}
				else
					{
						
						
						//////////////////ordenar elementos de la tripleta ////////////////

								if (c==2 || c==3) 
								{
									aux.sort(function(a,b){return a-b;});
								}
								for (var i =0; i<aux.length ;i++) 
								{
									if(i==0)
									{
										tripleta=tripleta+String(aux[i]);
									}
									else
									{
										tripleta=tripleta+'-'+String(aux[i]);
									}
								}
						/////////////////////////////////////////////////////////////////////
						



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
							$('#Apuesta').focus();
							
						}
						else
						{
							
							 var tipos=['quiniela','pale','tripleta'];
							 var url='/verificarApuesta';
							 var datos=[$('#Apuesta').val(),tripleta,c,ids,sorteos_,jugadaId];
							 var sorteos__=[];
							 var consulta= $.get(url,{datos:datos},function(resultado)
							 {
							 	
							 	

							 	var mensaje="";
							 	var longitud=resultado.length;
							 	var respuestas=[];
							 	for (var i = 0; i < longitud; i++) 
							 	{

							 		
							 		respuestas.push(resultado[i][3]);
							 		if(resultado[i][3]==0)
							 		{
							 		
							 			mensaje=mensaje+'<div> <label style="font-size: 0.8em;color: #000000;"> La jugada: </label>  <label style="font-size: 0.8em;color: #072150  ;">'+tripleta+'  </label>  ' +'<label style="font-size: 0.8em;color: #000000;"> para: </label>   <label style="font-size: 0.8em;color: #072150  ;">'+resultado[i][1]+'  </label>  '+'<label style="font-size: 0.8em;color: #000000;"> Por: </label> <label style="font-size: 0.8em;color: #072150  ;">'+$('#Apuesta').val()+' € '+'  </label>  '+' <label style="font-size: 0.8em;color: #D42304;"> | No esta permitida, se ha logrado el maximo de ventas.</label> </div>';
							 			
							 		

							 		}
							 		else if(resultado[i][3]==3)
							 		{
							 			mensaje=mensaje+'<div  > <label style="font-size: 0.8em;color: #000000;"> La jugada: </label>  <label style="font-size: 0.8em;color: #072150  ;">'+tripleta+'  </label>  ' +'<label style="font-size: 0.8em;color: #000000;"> para: </label>   <label style="font-size: 0.8em;color: #072150  ;">'+resultado[i][1]+'  </label>  '+'<label style="font-size: 0.8em;color: #000000;"> Por: </label> <label style="font-size: 0.8em;color: #072150  ;">'+$('#Apuesta').val()+' € '+'  </label>  '+' <label style="font-size: 0.8em;color: #EA8613;"> |  Usted cuenta solo con: '+resultado[i][4]+' €  para ella.' + '</label> </div>';
							 			
							 			
							 		}
							 		else if(resultado[i][3]==2)
							 		{

							 			mensaje=mensaje+'<div > <label style="font-size: 0.8em;color: #000000;"> La jugada: </label>  <label style="font-size: 0.8em;color: #072150  ;">'+tripleta+'  </label>  ' +'<label style="font-size: 0.8em;color: #000000;"> para: </label>   <label style="font-size: 0.8em;color: #072150  ;">'+resultado[i][1]+'  </label>  '+'<label style="font-size: 0.8em;color: #000000;"> Por: </label> <label style="font-size: 0.8em;color: #072150  ;">'+$('#Apuesta').val()+' € '+'  </label>  '+' <label style="font-size: 0.8em;color: #0A6E32;"> | Alcanzo la meta de ventas para  '+tipos[resultado[i][2]-1]+'.</label> </div>';
							 			sorteos__.push(resultado[i][1]);

							 		}
							 		else if(resultado[i][3]==4)
							 		{

							 			mensaje=mensaje+'<div " > <label style="font-size: 0.8em;color: #000000;"> La jugada: </label>  <label style="font-size: 0.8em;color: #072150  ;">'+tripleta+'  </label>  ' +'<label style="font-size: 0.8em;color: #000000;"> para: </label>   <label style="font-size: 0.8em;color: #072150  ;">'+resultado[i][1]+'  </label>  '+' <label style="font-size: 0.8em;color: #D42304;"> | Se encuentra en el ticket  </label> </div>';
							 			
							 		}
							 		else if(resultado[i][3]==5)
							 		{

							 			mensaje=mensaje+'<div " > <label style="font-size: 0.8em;color: #000000;"> La jugada: </label>  <label style="font-size: 0.8em;color: #072150  ;">'+tripleta+'  </label>  ' +'<label style="font-size: 0.8em;color: #000000;"> para: </label>   <label style="font-size: 0.8em;color: #072150  ;">'+resultado[i][1]+'  </label>  '+' <label style="font-size: 0.8em;color: #D42304;"> | Debe poseer una apuesta mayor que 0  </label> </div>';
							 			
							 		}
							 		else
							 		{

							 			sorteos__.push(resultado[i][1]);
							 		}
							 	}
									 	
							 	if(mensaje!="")
							 	{
									 					 		
									 			swal({
														title:'Tengo un comentario para ti !!!  ',//Contenido del modal
														text: '<p style="font-size: 0.8em;">'+mensaje+'</p>',
														timer:3000,//Tiempo de retardo en ejecucion del modal
														type: "warning",
														showConfirmButton:false,//Eliminar boton de confirmacion
														html: true
												});
								}
							   if(sorteos__.length>0 )
								{
									
								
									insertarApuesta(sorteos__,'jugadaId',tripleta);
									alert('respuestas: '+respuestas);
									alert('sorteos: '+sorteos__)
										if(buscarResp(respuestas,3)==true)
											{
												$('#Apuesta').val(" ");
												$('#Apuesta').focus();
											}
											else
											{
												   $('#Apuesta').val(" ");
												   borrarInput(dupletas);
												   $('#primerPremio').focus();

											}
									

								}
								else if(sorteos__.length==0)
								{
									
									alert('respuestas: '+respuestas);
									alert('sorteos: '+sorteos__)
									if((buscarResp(respuestas,3)==true)||((buscarResp(respuestas,5)==true)))
									{
										
										$('#Apuesta').val(" ");
										$('#Apuesta').focus();
										
									}
									else
									{
										borrarInput(dupletas);
										$('#Apuesta').val(" ");
										$('#primerPremio').focus();
									}

									
									
									

								}


							 	

							 	


							 	


							 });
							consulta.fail(function()
								{
									swal({
											title:'Error inesperado!!',//Contenido del modal
											text: '<p style="font-size: 1.5em;">'+'Pongase en contacto con el administrador'+'</p>',
											timer:3000,//Tiempo de retardo en ejecucion del modal
											type: "error",
											showConfirmButton:false,//Eliminar boton de confirmacion
											html: true
										});


								});

							
						}
					}


			}
			

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
						$('#listaUsuarios').append('   <div class="col s12 m6 l6 usuarionombre" id="usuario'+resultado[2]+'">'+resultado[1]+'</div>       <div class="col s12 m2 l2 push-l5 acciones">     <a href="#modaledit"  id="edit'+resultado[2]+'"><i class="small editar material-icons">mode_edit</i></a>    <a href="" id="elim'+resultado[2]+'"><i class="borrar small material-icons">delete</i></a>   </div>');

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
			AgregarJugada()
			//anularJugada()
			//seleccionarJugada()
			InsertarUsuario()
			//generarTicket()
			presionarEnter()
			CerrarSession() 
			guardarJugada() 


// $(document).ready(function()
// 	{
			

// 			$('#dineroTotal').text(0);
			
	
// 	});
