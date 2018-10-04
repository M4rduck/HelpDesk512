<?php

namespace App\Http\Controllers\Diagnosis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DiagnosisController extends Controller
{
    public function index(){
        return view('diagnosis.parameterization.index');
    }

    public function create(){
        //dd(route('input.index'));
        return view('diagnosis.parameterization.create');
    }    
}