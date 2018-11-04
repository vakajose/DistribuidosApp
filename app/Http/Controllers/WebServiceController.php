<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Encuesta;
use App\Classes\TEncuesta;
use App\Respuesta;
use App\Formulario;

class WebServiceController extends Controller
{
    
    public function getLista(){
        $encuestas = DB::table('encuesta')->select('titulo','descripcion', 'id')->get();
        return json_encode($encuestas);
    }

    public function getEncuesta(){
    	$encuesta = DB::table('encuesta')->where('id',$_GET['id'])->select('*')->get()[0];
        
    	$encues                = new Encuesta();
    	$encues->titulo        = $encuesta->titulo;
    	$encues->descripcion   = $encuesta->descripcion;
        $encues->id            = $encuesta->id;
    	$encues->preguntas     = $this->getPreguntas($encuesta->id);
    	return json_encode($encues);
    }
    private function getPreguntas($encuestaid){
    	$preguntas = DB::table('pregunta')->where('encuesta_id',$encuestaid)->select('*')->get();
    	$id = 1;
    	$preguntaArray = array();
    	foreach ($preguntas as $pregunta) {
    		$titulo = $pregunta->texto;
    		$opciones = $this->getOpciones($pregunta->id);
    		$preguntaArray[] = [
    			'titulo'     => $titulo,
    			'opciones'   => $opciones
    		];
    		$id++;
    	}
    	return $preguntaArray;
    }
    private function getOpciones($preguntaid){
    	$opciones = DB::table('opcion')->where('pregunta_id', $preguntaid)->select('*')->get();
    	$opcionesArray = array();
    	foreach ($opciones as $opcion) {
    		if ($opcion->cerrada == 'si'){
    			$opcionCerrada = DB::table('opcioncerrada')->where('id', $opcion->opcioncerrada_id)->select('*')->get()[0];
    			$opcionesArray[] = [
    				'multiple'      => $opcionCerrada->multiple,
    				'dominio'       => $opcionCerrada->dominio,
                    'tipodato'      => 'no',
                    'id'            => $opcion->id
    			];
    		}else{
    			$opcionAbierta = DB::table('opcionabierta')->where('id', $opcion->opcionabierta_id)->select('*')->get()[0];
    			$opcionesArray[] = [
    				'dominio'   => $opcionAbierta->dominio,
    				'tipodato'  => $opcionAbierta->tipodato,
                    'multiple'  => 'no',
                    'id'        => $opcion->id
    			];
    		}
    	}
    	return $opcionesArray;
    }
    

    public function setRespuestaEncuesta(Request $request){
       $data = $request->json()->all();
       return $this->setrespuesta($data);
    }
    private function setrespuesta($postRequest){
        $s      = explode("#", $postRequest['respuesta']);
        $texts  = explode("/", $postRequest['respuesta_edits']);       
        $respuestaArray     = array();
        $tiposArray         = array();
        $idsArray           = array();
        $antID              = "";
        $respuestaArray[]   = "";
        $idsArray[]         = "";
        $tiposArray[]       = "";
        $idTextuales        = 0;
        $count              = 0;
        for ($i=0; $i <count($s) ; $i++) {
            $a = explode("/", $s[$i]); 
            if($a[0] == $antID){
                if($a[2] != '-'){
                    $r = $respuestaArray[$count].','.$a[2];
                    $respuestaArray[$count] = $r;
                }  
            }else{
                $antID = $a[0];
                if($a[2] == "T"){
                    $respuestaArray[] = $texts[$idTextuales];
                    $idTextuales++;
                }
                else
                    $respuestaArray[] = $a[2];
                $idsArray[] = $a[0];
                $tiposArray[] = $a[1];
                $count++;
            }
        }
        $Formulario = $this->crearFormulario($postRequest['fecha'], 'si', $postRequest['latitud'], $postRequest['longitud'], $postRequest['encuestado'], $postRequest['user_id'], $postRequest['encuesta_id']);
    
        for ($i=1; $i < count($idsArray); $i++) { 
            $this->crearRespuesta($tiposArray[$i], $respuestaArray[$i], $Formulario->id, $postRequest['encuesta_id'], $idsArray[$i]);
        }
        return json_encode(['status' => '200']);
    }
    private function crearFormulario($fecha, $completada, $latitud, $longitud, $encuestado, $user_id, $encuesta_id){
        $Formulario = Formulario::create([
            'fecha'         => $fecha,
            'completada'    => $completada,
            'latitud'       => $latitud,
            'longitud'      => $longitud,
            'encuestado'    => $encuestado,
            'user_id'       => $user_id,
            'encuesta_id'   => $encuesta_id
        ]);
        return $Formulario;
    }
    private function crearRespuesta($marcada, $texto, $formulario_id, $encuesta_id, $opcion_id){
        Respuesta::create([
                'marcada'           => $marcada,
                'texto'             => $texto,
                'formulario_id'     => $formulario_id,
                'encuesta_id'       => $encuesta_id,
                'opcion_id'         => $opcion_id
            ]);
    }
}
