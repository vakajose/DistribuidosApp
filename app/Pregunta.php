<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
   protected $table ="pregunta";
   protected $fillable = [
        'texto', 'index', 'encuesta_id'
    ];

    public function opciones(){
    	 return $this->hasMany('App\Opcion');

    }
}
