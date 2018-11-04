<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpcionCerrada extends Model
{
    protected $table ="opcioncerrada";
   protected $fillable = [
        'dominio', 'multiple'
    ];
}
