<?php

namespace App\Http\Controllers\General;

use App\Models\General\Method;
use App\Models\General\Module;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModuleController extends Controller
{
    public function index(){
        try{
            $metodos = Method::all(['id', 'name'])
                        ->pluck('name', 'id');
            $modulos = Module::query()
                        ->where('main', 1)
                        ->get(['id', 'text'])
                        ->pluck('text', 'id');
        }catch (QueryException $queryException){
            dd($queryException->getMessage());
        }

        return view('System.Module.index')->with(['metodos' => $metodos, 'modulos' => $modulos]);
    }

    public function store(Request $request){
        try{
            $modulo = new Module($request->module);
            $modulo->save();
        }catch (QueryException $queryException){
            dd($queryException->getMessage());
        }
        return redirect()->route('module.index');
    }
}
