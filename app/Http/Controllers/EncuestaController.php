<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use App\Encuesta;
use App\Pregunta;
use App\Opcion;
use App\Depende;
use App\OpcionCerrada;
use App\OpcionAbierta;
class EncuestaController extends Controller
{
	 protected $auth;
   
     public function __construct(Guard $auth)
    {
        $this->middleware('auth');
         $this->auth = $auth;
    }
    public function dashboard(){
    	$id = $this->auth->user()->id;
    	$encuestas = DB::table('encuesta')->select('*')->get();
    	return view('encuesta/listaencuesta', ['id' => $id,'encuestas' => $encuestas]);
    }
    public function crearencuestaview(){
        //$hola = (Object)['Titulo' => 'MIERDA!'];
        //dd($hola->Titulo);
    	return view('encuesta/crearencuesta');
    }

    public function crearencuesta(){
        //dd($_POST);
    	$titulo = $_POST['titulo'];
    	$descripcion = $_POST['descripcion'];
    	$encuesta = Encuesta::create([
    		'titulo' => $titulo,
    		'descripcion' => $descripcion
    	]);
    	$this->crearPreguntas($_POST, $encuesta->id);
    	return view('encuesta/crearencuesta');
    }
    function crearPreguntas($preguntas, $id){	
    	$cant = $preguntas['countpregunta'];
    	$preguntaArray = array();
    	if($cant > 0){
    		for ($i=0; $i < $cant ; $i++) { 
    		$preguntaArray[] =Pregunta::create([
    				'texto' => $_POST['pregunta'.($i+1)],
    				'encuesta_id' => $id
    			])->id;
    		}
    	$this->crearOpciones($preguntas, $preguntaArray);	
    	}
    	
    }
    function crearOpciones($opciones, $preguntaArray){
    	$cant = $opciones['countopcion'];
    	$opcionArray = array();
    	if($cant > 0){
    		for ($i=0; $i < $cant ; $i++) { 
    			$opcionProp = explode('/',$opciones['opcion'.($i+1)]);
    			$idpregunta = $preguntaArray[$opcionProp[0]-1];
    			$tipo = $this->getTipoOpcion($opcionProp[1]);
    			$multiple = $this->isMultiple($opcionProp[2]);
    			$dominio = $opcionProp[3];
    			$tipoD = $this->getTipoDato($opcionProp[4]);
                $idlastOpcion = $this->crearOpcion($tipo,$dominio, $multiple, $tipoD,$idpregunta);
                if($idlastOpcion > 0)
                    $opcionArray[] = $idlastOpcion;
    		}
    		$this->crearDependencias($opciones, $preguntaArray, $opcionArray);	
    	}
    }
    function crearDependencias($dependencias, $preguntaArray, $opcionArray){
    	$cant = $dependencias['countdependencia'];
    	if ($cant >0){
    		for ($i=0; $i < $cant ; $i++) { 
    			$dependenciaProp = explode('/',$dependencias['dependencia'.($i+1)]);
    			Depende::create([
    				'pregunta_id' => $preguntaArray[$dependenciaProp[0]-1],
    				'opcion_id' => $opcionArray[$dependenciaProp[1]-1]
    			]);
    		}
    	}
    }


    function getTipoDato($nro){
    	switch ($nro) {
    					case '1':
    						return 'numerico';
    					case '2':
    						return 'fecha';
    					case '3':
    						return 'email';
    					case '4':
    						return 'telefono';
    					case '5':
    						return 'string';
    				}	
    }
    function getTipoOpcion($tipo){
    	if ($tipo == 1){
    		return 'no'; //Abierta
    	}
    	return 'si'; //CERRADA
    }
    function isMultiple($m){
        if($m == 1)
            return 'si';
        return 'no';
    }
    function crearOpcion($tipo, $dominio, $multiple, $tipodato, $preguntaid){
        $idOpcionCerrada = 0;
        $idOpcionAbierta;
        if($tipo == 'si') {//CERRADA
            $idOpcionCerrada = OpcionCerrada::create([
                'dominio' => $dominio,
                'multiple' => $multiple
            ])->id;
            $idOpcionAbierta = 0;
        }else{
            $idOpcionAbierta = OpcionAbierta::create([
                'dominio' => $dominio,
                'tipodato' => $tipodato
            ])->id;
            $idOpcionCerrada = 0;
        }
            Opcion::create([
                'cerrada' => $tipo,
                'opcioncerrada_id' => $idOpcionCerrada,
                'opcionabierta_id' => $idOpcionAbierta,
                'pregunta_id' => $preguntaid,
            ])->id;
        return $idOpcionCerrada;    
    }
}
