<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstadisticasController extends Controller
{
    public function show()
    {
    	return view('estadisticas.show');
    }
}
