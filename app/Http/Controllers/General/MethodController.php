<?php

namespace App\Http\Controllers\General;

use App\Models\General\Method;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\Controller as ModelController;

class MethodController extends Controller
{
    public function index(){
        try{
            $controladores = ModelController::query()
                                ->where('status', 1)
                                ->get()
                                ->pluck('name', 'id');

            $verbos = ['post' =>'POST','get' => 'GET','put' => 'PUT','patch' => 'PATCH','delete' => 'DELETE','resource' => 'RESOURCE'];
        }catch (QueryException $queryException){
            return abort(500, $queryException->getMessage());
        }

        return view('System.Method.index')->with(['controladores' => $controladores, 'verbos' => $verbos]);
    }

    public function store(Request $request){
        try{
            $metodo = new Method($request->methods);
            $metodo->save();
        }catch (QueryException $queryException){
            dd( $queryException->getMessage());
        }

        return redirect()->route('method.index');
    }
}
