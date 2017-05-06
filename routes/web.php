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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cargar','Cargar@index');
Route::get('/login','Cargar@login');
Route::get('/home','Cargar@apuesta');

////////Verificar Credenciales del login ///////////////////////////
Route::post('/loginVerificar','Cargar@loginVerificar');
Route::get('/verificarApuesta','Cargar@verificarApuesta');
Route::post('/insertarUsuarios','Administracion@insertarUsuarios');
//////////////////////////////////////////////////////////////////////
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

Route::get('/reportes','Reportes@index');