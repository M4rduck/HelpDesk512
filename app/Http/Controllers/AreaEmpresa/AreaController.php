<?php

namespace App\Http\Controllers\AreaEmpresa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AreaController extends Controller
{
    function index(){
    	return view('areaEmpresa.area.index'); 
    }

    function store(Request $request){
        dd($request->all());
    }
}
