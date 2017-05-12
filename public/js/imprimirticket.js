function imprimirTicket () 
{
	 if (window.print) 
	 {
        window.print();
     } 
     else 
     {
        swal("Error de compatibilidad", "Su navegador no soporta la funcion de impresion de tickets ", "error");
     }
}


$(document).ready(function()
	{
			

			imprimirTicket();
			
	
	});