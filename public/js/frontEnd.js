
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

						alert('Bienvenido al Sistema, esta logueado con el perfil: '+resultado[0]);
						setTimeout(function(){location.href = "/home";},1000);

					}
				else if (resultado[0]==0)//no existe el usuario
					{
						alert('Credenciales invalidas');

					}
				

			});
		
			posting.fail(function() {
				
				alert('Error de conexion,Comuniquese con el administrador');
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
			alert(c);
			if (c==0)
			{
				alert('debe seleccionar un sorteo');
			}
			else if(c>1)
			{
				alert('debe seleccionar solo un sorteo');
			}
			else if(c==1)//si se selecciono un sorteo
			{
				alert('El sorteo seleccionado es:  '+ sorteo);
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
						alert('debe ingresar al menos una dupleta');
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
						alert(tripleta_);
						if ($('#Apuesta').val()=='') 
						{
							alert('Debe indicar la apuesta para la jugada');
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