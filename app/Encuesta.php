<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
   protected $table ="encuesta";
   protected $fillable = [
        'titulo', 'descripcion'
    ];
    public function preguntas(){
    	 return $this->hasMany('App\Pregunta');

    }
}
