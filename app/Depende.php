<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Depende extends Model
{
   protected $table ="depende";
   protected $fillable = [
        'pregunta_id', 'opcion_id'
    ];
}
