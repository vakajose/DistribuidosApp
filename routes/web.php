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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('crearencuesta', 'EncuestaController@crearencuestaview');
Route::get('dashboard', 'EncuestaController@dashboard')->name('dashboard');
Route::post('crearencuesta', 'EncuestaController@crearencuesta');
Route::get('getencuesta','WebServiceController@getEncuesta');
Route::get('getlista','WebServiceController@getLista');
Route::post('setRespuestaEncuesta','WebServiceController@setRespuestaEncuesta');
//
Route::name('estadisticas')->get('estadisticas','EstadisticasController@show');

Route::name('estadisticasPorEncuesta.index')->get('estadisticasDetail','EstadisticasController@showPorEncuesta');
Route::name('estadisticasPorEncuesta.change')->post('estadisticasDetail','EstadisticasController@changeEncuesta');

Route::name('ubicacion.index')->get('ubicaciones','UbicacionController@index');

Route::get('gethistorial','WebServiceController@gethistorialreclamo');
Route::get('getusers','UbicacionController@getUsers');
Route::get('getubicaciones/{estado}','UbicacionController@getLastUbicacionbyEstado');