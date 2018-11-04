<?php
	namespace App\Classes;
	class Pregunta {
	 
		private $titulo;
		private $opciones = array();
	 
		function __construct(  ) {
			
		}
	 	
		function setTitulo($titulo) {
			$this->titulo = $titulo;
		}
	 	function setOpciones($opciones){
	 		$this->opciones = $opciones;
	 	}

		function getTitulo(){
			return $this->titulo;
		}
		function getOpciones(){
			return $this->opciones;
		}
	 
	}



?>