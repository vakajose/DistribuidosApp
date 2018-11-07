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
Route::name('estadisticasPorEncuesta')->get('estadisticasDetail', 'EstadisticasController@showPorEncuesta');
//Route::name('estadisticasPorEncuesta')->post('estadisticasDetail\{encuesta?}', function($encuesta = null){ return $encuesta;},'EstadisticasController@showPorEncuesta');