<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
   protected $table ="respuesta";
   protected $fillable = [
        'marcada', 'texto', 'formulario_id','opcion_id','encuesta_id'
    ];
}
