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
    	foreach ($labels as $label) {
    		$data[] = rand(10,40);
    	}
    	
    	return view('estadisticas.show')->with(['pieData' => [$labels,$data]]);
    }
}
