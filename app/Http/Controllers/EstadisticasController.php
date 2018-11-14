<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Formulario,Encuesta,Pregunta,Respuesta,OpcionCerrada};
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
    	return view('estadisticas.show')->with(['pieData' => [$labels,$data]]);
    }

    public function showPorEncuesta($encuesta){
    	$encuestas = Encuesta::all();
        if($encuesta==0){
            $encuesta = Encuesta::first();
        }else{
            $encuesta = Encuesta::find($encuesta);
        }
    	return view('estadisticas.showPorEncuesta')->with(['encuestas' => $encuestas,'encuesta'=> $encuesta,'datas'=>array(),'labels'=>array(),'back'=>array(),'border'=>array()]);
    }
    public function changeEncuesta(Request $request){
        $encuesta = Encuesta::find($request->encuesta);
        $preguntas = $encuesta->preguntas;
        $labels = array();//listo
        $datas = array();//listo
        $back = array();
        $border = array();
        foreach ($preguntas as $key => $pregunta) {
            $label = array();
            $data = array();
            $opciones = $pregunta->opciones;
            foreach ($opciones as $k => $opcion) {
                if ($opcion->cerrada =='si') {
                    $cerrada = OpcionCerrada::find($opcion->opcioncerrada_id);
                    $dom = $cerrada->dominio;
                    $temp = explode(',', $dom);
                    $label = array_merge($label,$temp);
                    //conteo de respuestas
                    foreach ($label as $key => $lab) {
                        $respuestas = Respuesta::where('opcion_id',$opcion->id)->where('texto',$lab )->get();
                        $count = $respuestas->count();
                        $data[] = $count;
                    }
                    
                }else{
                    $respuesta = Respuesta::where('opcion_id',$opcion->id)->get();
                    $group = $respuesta->groupBy('texto'); 
                    $temp = $group->keys()->toArray();
                    $label = array_merge($label,$temp);
                    foreach ($group as $key => $gr) {
                        $data[] = $gr->count();
                    }
                }
            }
            $labels[] = $label;
            $datas[] = $data;

        }
        dd($datas);
        return redirect()->route('estadisticasPorEncuesta.index', ['encuestas'=>Encuesta::all(),'encuesta' => $encuesta, 'datas'=>$datas,'labels'=>$labels,'back'=>$back,'border'=>$border]);
    }
}
