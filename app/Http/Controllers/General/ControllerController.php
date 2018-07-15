<?php

namespace App\Http\Controllers\General;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\Controller as ModelController;
use Yajra\DataTables\Facades\DataTables;

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

    public function getDataController(){
        try{
            $datatable = DataTables::eloquent(ModelController::query())
            ->editColumn('action', function() {
                return '<a class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })->toJson();
        }catch (QueryException $queryException){
            dd($queryException->getMessage());
        }catch (\Exception $exception){
            dd($exception->getMessage());
        }
        return $datatable;
    }
}
