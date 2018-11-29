<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $fillable = ['latitud', 'longitud'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
