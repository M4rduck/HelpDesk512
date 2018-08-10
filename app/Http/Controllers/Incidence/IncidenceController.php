<?php

namespace App\Http\Controllers\Incidence;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IncidenceController extends Controller
{
    public function index(){
        return 'hola';
    }

    public function create(){
        return 'crear formulario pepe';
    }
}
