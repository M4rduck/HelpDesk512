<?php

namespace App\Http\Controllers\AreaEmpresa;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Enterprise;
use DB;

class EmpresaController extends Controller
{

    function index(){
    	return view('areaEmpresa.empresa.index');    
    }

    function store(Request $request){

    }

    public function getEnterprises(){
        try{
                $datatable = DataTables::eloquent(Enterprise::with(['phones', 'city']))
                        ->editColumn('action', function(Enterprise $enterprise){
                            return '<a class="btn btn-xs btn-primary" data-id="'.$enterprise->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a>'.
                                   ' <a class="btn btn-xs btn-primary" data-id="'.$enterprise->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a>'.
                                   ' <a class="btn btn-xs btn-primary" href="'.route('area.show', ['id' => $enterprise->id]).'"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
                        })->addColumn('Phones', function(Enterprise $enterprise){
                            $phones = '';
                            if($enterprise->phones->isNotEmpty()){
                                foreach($enterprise->phones as $phone){
                                    $phones.=$phones->number.', ';
                                }
                            }
                            return $phones;
                        })->toJson();
        }catch (QueryException $queryException){
            dd($queryException->getMessage());
        }

        return $datatable;        
    }
}
