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
Route::post('/verificarApusta','Cargar@verificarApusta');
Route::post('/insertarUsuarios','Administracion@insertarUsuarios');
//////////////////////////////////////////////////////////////////////
Route::get('/administracion/usuarios','Administracion@listar_usuarios');
Route::get('/administracion/loterias','Administracion@listar_loterias');
Route::get('/administracion/set_premios','Administracion@config_premio');

Route::get('/reportes','Reportes@index');