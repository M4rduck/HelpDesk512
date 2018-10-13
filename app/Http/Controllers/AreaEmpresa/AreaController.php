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

    function show($id){
        return view('areaEmpresa.area.index')->with('id', $id); 
    }

    function getAreas($id){
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

}
