<?php
	class Encuesta {
	 
		private $titulo;
		private $descripcion;
		private $preguntas = array();
		private $opciones = array();
	 
		function __construct( $titulo, $descripcion, $preguntas, $opciones ) {
			
		}
	 	
		function setTitulo($titulo) {
			$this->titulo = $titulo;
		}
	 	function setDescripcion($descripcion){
	 		$this->descripcion = $descripcion;
	 	}
	 	function setPreguntas($preguntas){
	 		$this->preguntas = $preguntas;
	 	}
	 	function setOpciones($opciones){
	 		$this->opciones = $opciones;
	 	}

		function getTitulo(){
			return $this->titulo;
		}
		function getDescripcion(){
			return $this->descripcion;
		}
		function getPreguntas(){
			return $this->preguntas;
		}
		function getOpciones(){
			return $this->opciones;
		}
	 
	}



?>