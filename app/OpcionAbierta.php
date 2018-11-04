<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpcionAbierta extends Model
{
    protected $table ="opcionabierta";
   protected $fillable = [
        'dominio', 'tipodato'
    ];
}
