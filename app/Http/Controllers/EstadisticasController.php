<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Formulario,Encuesta,Pregunta,Respuesta};
use DateTimeZone;
use Datetime;

class EstadisticasController extends Controller
{
    public function show()
    {
    	$labels = Encuesta::pluck('titulo')->all();
    	$data = array();
    	$encuestas = Encuesta::all();
    	foreach ($encuestas as $enc) {
    		$data[] = $enc->formularios->count();
    	}
    	// foreach ($labels as $label) {
    	// 	$data[] = rand(10,40);
    	// }
    	
    	return view('estadisticas.show')->with(['pieData' => [$labels,$data]]);
    }

    public function showPorEncuesta(){
    	$encuestas = Encuesta::all();
    	// if(!is_null($encuesta)){
    	// 	$encuesta = Encuesta::find($encuesta)->get();
    	// }
    	return view('estadisticas.showPorEncuesta')->with(['encuestas' => $encuestas]);
    }
}
