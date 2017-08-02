<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

////////////////////////////cargar///////////////////////////////////////////////////////
Route::get('/cargar','Cargar@index');
Route::get('/login','Cargar@login');
Route::post('/loginVerificar','Cargar@loginVerificar');
Route::get('/verificarApuesta','Cargar@verificarApuesta');
Route::get('/cerrarSession','Cargar@cerrarSession');


///////////////////////////inicio///////////////////////////////////////////////////////
Route::get('/home','Inicio@vista_apuesta');
Route::get('/limitesJugada','Inicio@verificar_apuesta');
Route::get('/imprimirTicket/{ticket_id}','Inicio@imprimir_ticket');
Route::get('/anularJugada','Inicio@anular_jugadas');
Route::get('/generarTicket/','Inicio@generar_ticket');
Route::get('/abrirSistema','Inicio@abrir_sistema');
Route::get('/anularTicket/{ticket_id}','Inicio@anular_ticket');
Route::get('/premiosTicket/{numero}','Inicio@premios_ticket');
Route::get('/pagarTicket/{numero}','Inicio@pagar_ticket');
Route::get('/consultarApertura','Inicio@consultar_apertura');


///////////////////////////administracion ///////////////////////////

Route::post('/insertarUsuarios','Administracion@insertarUsuarios');
Route::get('/administracion/usuarios','Administracion@listar_usuarios');
Route::get('/administracion/loterias','Administracion@listar_loterias');
Route::get('/administracion/set_premios','Administracion@config_premio');
Route::get('/administracion/usuarios/traer_registro', 'Administracion@usuario_actual');
Route::post('/administracion/usuarios/modificarUsuario', 'Administracion@modificar_usuario_actual');
Route::get('/administracion/usuarios/borrar', 'Administracion@borrar_usuario');
Route::get('/administracion/addlotery', 'Administracion@insertar_loteria');
Route::get('/administracion/loterias/traer_loteria', 'Administracion@loteria_actual');
Route::any('/administracion/loterias/modificarLoteria', 'Administracion@modificar_loteria_actual');
Route::get('/administracion/loterias/borrar', 'Administracion@borrar_loteria');
Route::any('/administracion/loterias/setgen', 'Administracion@actualizar_configuracion_general');
Route::any('/administracion/premios/actualizar', 'Administracion@actualizar_premios');
Route::get('/administracion/jugada_dia','Administracion@insertar_jugada_dia');
Route::get('/jugadaGanadora','Administracion@insertar_jugada_ganadora');

////////////////////////////////////Reportes////////////////////////////////////////////////
Route::get('/reportes','Reportes@index');
Route::get('/prueba','Reportes@hora');
Route::get('/cierreDiario','Reportes@cierre_diario');
Route::get('/resumenDiario/{fecha}','Reportes@resumen_diario_ventas');

///////////////////////////////////Buscar ticket///////////////////////////////////////////
Route::get('/buscar-ticket','Buscar_Ticket@index');


////////////////////////////////////////Mantenimiento///////////////////////////////////////////
Route::get('/reiniciarAcumulados','Mantenimiento@reiniciar_acumulados');




//////////////////////////////////Pruebas//////////////////////////////////////////////////

Route::get('/test','Reportes@reporte_jugadas_sorteadas');