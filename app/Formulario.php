<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
   protected $table ="formulario";
   protected $fillable = [
        'fecha', 'completada','latitud','longitud','encuestado','user_id','encuesta_id',
    ];
}
