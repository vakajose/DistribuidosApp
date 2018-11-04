<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opcion extends Model
{
   protected $table ="opcion";
   protected $fillable = [
        'cerrada', 'opcioncerrada_id', 'opcionabierta_id','pregunta_id'
    ];
}
