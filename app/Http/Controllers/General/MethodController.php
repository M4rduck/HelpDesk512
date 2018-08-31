<?php

namespace App\Http\Controllers\General;

use App\Models\General\Method;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\Controller as ModelController;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Lang;

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
            foreach($request->methods as $column => $value){
                if(!is_null($value)){
                    $search[] = [$column, $value];
                }                
            }
            $metodo = Method::query()->where($search)->exists();
            if(!$metodo){
                $metodo = new Method($request->methods);
                $metodo->save();
            }else{
                return response()->json(['success' => true, 'error' => false, 'warning' => true, 'msg' => Lang::get('method/store.warning_body'), 'title' => Lang::get('method/store.warning_title')]);
            }            
        }catch (QueryException $queryException){
            return response()->json(['success' => true, 'error' => true, 'warning' => false, 'msg' => Lang::get('method/store.error_body', ['code' => $queryException->getCode()]), 'title' => Lang::get('method/store.error_title')]);
        }

        return response()->json(['success' => true, 'error' => false, 'warning' => false, 'msg' => Lang::get('method/store.success_body'), 'title' => Lang::get('method/store.success_title')]);
    }
}
