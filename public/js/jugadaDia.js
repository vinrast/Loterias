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
						alert(datos);

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
});




