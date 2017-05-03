var jugadaId=1;
var valor=0;

function verificarApuesta (sorteos_,jugadaId,checks,dupletas,tripleta) 
{
	
	
							for (var i = 0; i < sorteos_.length; i++) 
							{
								
							
								$('#tablaJugadas').append(' <tr class="resultadoi" id="filaJugada'+jugadaId+'">  <th class="celda"><input type="checkbox" class="checkJugada" id="check'+jugadaId+'" data-idj="'+jugadaId+'"/><label for="check'+jugadaId+'" ></label></th>  <th class="celda1">'+sorteos_[i]+'</th>  <th class="celda1">'+tripleta+'</th> <th id="apuesta'+jugadaId+'" >'+$('#Apuesta').val()+'</th></tr>');
								valor=valor+parseInt($('#Apuesta').val());
								jugadaId=jugadaId+1;
							}


							$('#dineroTotal').text(valor);
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
						
					 	valor=valor-parseInt($("#apuesta"+ids[i]).text());
						$('#filaJugada'+ids[i]).remove();
						
					}

					$("#chekJugadas").prop('checked',false);

					$('#dineroTotal').text(valor);
					

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
				var aux=[];
				c=0;

				$.each(dupletas, function(i)
				{
					
					if ($(this).val()!='')
					{
						c=c+1;

						aux.push($(this).val());//valores en un arreglo
					}
					
					
				});

				//////////////////ordenar elementos de la tripleta ////////////////

					if (c==2) 
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
						
					}
				else
					{
						
						
						
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
							
							 var tipos=['quiniela','pale','tripleta'];
							 var url='/verificarApuesta';
							 var datos=[$('#Apuesta').val(),tripleta,c,sorteos_];
							 var consulta= $.get(url,{datos:datos},function(resultado)
							 
							 {
							 	if (resultado[0]==0)
							 	{

							 		swal({
											title:'Apuesta no permitida!!',//Contenido del modal
											text: '<p style="font-size: 1.5em;">'+'El limite de ventas para '+tipos[c-1]+' fue logrado'+'</p>',
											timer:4000,//Tiempo de retardo en ejecucion del modal
											type: "error",
											showConfirmButton:false,//Eliminar boton de confirmacion
											html: true
										});


							 	}
							 	else if(resultado[0]==3)
							 	{

							 		swal({
											title:'Apuesta no permitida!!',//Contenido del modal
											text: '<p style="font-size: 1.5em;">'+'Usted cuenta con  '+resultado[1]+' euros para realizar esta apuesta de '+tipos[c-1]+'</p>',
											timer:4000,//Tiempo de retardo en ejecucion del modal
											type: "error",
											showConfirmButton:false,//Eliminar boton de confirmacion
											html: true
										});


							 	}
							 	else if(resultado[0]==1 || resultado[0]==2)
							 	{
							 		verificarApuesta(sorteos_,jugadaId,checks,dupletas,tripleta);
							 	}
							 	


							 });
							consulta.fail(function()
								{
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
			anularJugada()
			seleccionarJugada()
			InsertarUsuario()


// $(document).ready(function()
// 	{
			

// 			$('#dineroTotal').text(0);
			
	
// 	});
