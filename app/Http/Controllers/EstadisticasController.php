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

    public function showPorEncuesta(){
    	$encuestas = Encuesta::all();
    	return view('estadisticas.showPorEncuesta')->with(['encuestas' => $encuestas]);
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
                    if ($cerrada->multiple =='si') {
                        $respuestas = Respuesta::where('opcion_id',$opcion->id)->pluck('texto')->toArray();
                        
                        foreach ($label as $key => $lab) {
                            $i = 0;
                            foreach ($respuestas as $res) {
                                $sp = explode(',',$res);
                                if(in_array($lab, $sp)){
                                    $i++;
                                }
                            }
                            $data[] = $i;
                        }
                    }else{                    
                        foreach ($label as $key => $lab) {
                            $respuestas = Respuesta::where('opcion_id',$opcion->id)->where('texto',$lab )->get();
                            $count = $respuestas->count();
                            $data[] = $count;
                        }
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
       
        // return redirect()->route('estadisticasPorEncuesta.index', ['encuestas'=>Encuesta::all(),'encuesta' => $encuesta, 'datas'=>$datas,'labels'=>$labels]);
        return view('estadisticas.showPorEncuesta')->with(['encuestas' => Encuesta::all(),'encuesta'=> $encuesta,'datas'=>$datas,'labels'=>$labels]);
    }
}
