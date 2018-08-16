<?php

namespace App\Http\Controllers\General;

use App\Models\General\Method;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\Controller as ModelController;
use Yajra\DataTables\Facades\DataTables;

class MethodController extends Controller
{
    public function index(){
        try{
            $controladores = ModelController::query()
                                ->select('id', 'name')
                                ->where('status', 1)
                                ->get()
                                ->map(function($controlador){
                                    return ['id' => $controlador->id, 'name' => $controlador->name];
                                });
            $controladores->prepend(['id' => 0, 'name' => 'Elige un controlador']);                    

        }catch (QueryException $queryException){
            return abort(500, $queryException->getMessage());
        }

        return view('System.Method.index')->with(['controladores' => $controladores]);
    }

    public function getDataMethod(){
        try{
            $datatable = DataTables::eloquent(Method::with('controller')
                                                ->whereHas('controller', function ($query){
                                                    $query->where('status', 1);
                                                })
                        )->addColumn('Controlador', function(Method $method){
                            return $method->controller->name;
                        })
                        ->editColumn('action', function(Method $method){
                            return '<a class="btn btn-xs btn-primary" data-id="'.$method->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a>'.' <a class="btn btn-xs btn-primary" data-id="'.$method->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                        })->toJson();
        }catch (QueryException $queryException){
            dd($queryException->getMessage());
        }

        return $datatable;
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
