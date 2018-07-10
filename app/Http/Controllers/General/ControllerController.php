<?php

namespace App\Http\Controllers\General;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\Controller as ModelController;

class ControllerController extends Controller
{
    public function store(Request $request){
        try{
            $controlador = new ModelController($request->controller);
            $controlador->save();
        }catch (QueryException $queryException){
            dd( $queryException->getMessage());
        }

        return redirect()->route('method.index');
    }
}
