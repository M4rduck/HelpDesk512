<?php

namespace App\Http\Controllers\General;

use App\Models\General\Method;
use App\Models\General\Module;
use Illuminate\Support\Facades\Lang;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ModuleController extends Controller
{
    public function index(){
        try{
            $methods = Method::all(['id', 'name'])
                        ->map(function($method){
                            return ['id' => $method->id, 'name' => $method->name];
                        });
            $methods->prepend(['id' => 0, 'name' => 'Elige un método']);

            $modules = Module::query()
                        ->where('main', 1)
                        ->get(['id', 'text'])
                        ->map(function($module){
                            return ['id' => $module->id, 'text' => $module->text];
                        });
            $modules->prepend(['id' => 0, 'text' => 'Elige un módulo']);            

        }catch (QueryException $queryException){
            dd($queryException->getMessage());
        }

        return view('System.Module.index')->with(['methods' => $methods, 'modules' => $modules]);
    }

    public function getDataModule(){
        try{
            //dd(Module::with(['method', 'modules'])->where('main', 1)->get());
            $datatable = DataTables::eloquent(Module::with(['method', 'modules' => function($query){
                                $query->with('method');
                            }])->where('main', 1))
                            ->addColumn('metodo', function(Module $module){
                                return is_null($module->method) ? '' : $module->method->name;
                            })
                            ->addColumn('modulo', function(Module $module){
                                return is_null($module->module) ? '' : $module->module->text;
                            })
                            ->editColumn('action', function(Module $module){                                
                                return '<a class="btn btn-xs btn-primary" data-id="'.$module->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a>'.
                                       ' <a class="btn btn-xs btn-primary" data-id="'.$module->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a>';                                    
                            })
                            ->toJson();
        }catch (QueryException $queryException){
            dd($queryException->getMessage());
        }
        return $datatable;
    }

    public function store(Request $request){
        try{
            $modulo = new Module($request->module);
            $modulo->save();
        }catch (QueryException $queryException){
            dd($queryException->getMessage());
            return response()->json(['success' => true, 'warning' => false, 'error' => true, 'title' => Lang::get('module/store.error_title'), 'body' => Lang::get('module/store.error_body', ['code' => $queryException->getCode()])]);
        }
        return response()->json(['success' => true, 'warning' => false, 'error' => false, 'title' => Lang::get('module/store.success_title'), 'body' => Lang::get('module/store.success_body')]);
    }
}
