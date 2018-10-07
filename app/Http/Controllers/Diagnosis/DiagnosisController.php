<?php

namespace App\Http\Controllers\Diagnosis;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TypeInput;

class DiagnosisController extends Controller
{
    public function index(){
        return view('diagnosis.parameterization.index');
    }

    public function create(){
        try{
            $inputs = TypeInput::all()->pluck('name','id');
        }catch(QueryException $queryException){
            abort(404, 'Ha sucedido un problema al cargar los tipos de campos');
        }
                
        return view('diagnosis.parameterization.create')->with(['inputs' => $inputs]);
    }    
}