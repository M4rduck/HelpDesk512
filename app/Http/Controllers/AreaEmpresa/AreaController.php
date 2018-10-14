<?php

namespace App\Http\Controllers\AreaEmpresa;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Enterprise;
use Yajra\DataTables\Facades\DataTables;

class AreaController extends Controller
{
    function index(){        
    	return view('areaEmpresa.area.index'); 
    }

    function store(Request $request){
        parse_str($request->datos, $datos);
        try{
            $empresa = Enterprise::with('areas')->find($request->id);
            foreach($empresa->areas as $area){
                $sync[] = $area->id;
            }
            $area = Area::create($datos['area']);
            $sync[] = $area->id;
            $empresa->areas()->sync($sync);
        }catch (QueryException $queryException){
            return response()->json(['success' => true, 'error' => true, 'msg' => 'Ha sucedido un error al momento de guardar el area, código: '.$queryException->getCode()]);
        }

        return response()->json(['success' => true, 'error' => false, 'msg' => 'Se ha creado el area satisfcatoriamente']);
    }

    function show($id){    
        return view('areaEmpresa.area.index')->with('id', $id); 
    }

    public function create($id){
        try{
            $area = Area::find($id);
        }catch (QueryException $queryException){
            return response()->json(['success' => true, 'error' => true, 'msg' => 'Ha sucedido un error al momento de buscar el area, código: '.$queryException->getCode()]);
        }

        return response()->json(['success' => true, 'error' => false, 'area' => $area]);
    }

    public function put(Request $request, $id){
        parse_str($request->datos, $datos);
        try{
            $area = Area::where($id)->update($datos['area']);
        }catch (QueryException $queryException){
            return response()->json(['success' => true, 'error' => true, 'msg' => 'Ha sucedido un error al momento de actualizar el area, código: '.$queryException->getCode()]);
        }

        return response()->json(['success' => true, 'error' => false, 'msg' => 'Se ha actualizado el area satisfcatoriamente']);
    }

    function getAreas($id){
        try{
            $datatable = DataTables::eloquent(Area::whereHas('eterprises', 
                                                function($join) use ($id){
                                                    $join->where('id', $id);
                                                })
                        )
                        ->addColumn('action', function(Area $area){
                            return '<a class="btn btn-xs btn-primary edit-area" data-id="'.route('area.create', ['id' => $area->id]).'"><i class="glyphicon glyphicon-edit"></i> Edit</a>'.
                                   ' <a class="btn btn-xs btn-danger delete-area" data-id="'.route('area.put', ['id' => $area->id]).'"><i class="glyphicon glyphicon-edit"></i> Delete</a>';
                        })->toJson();
        }catch (QueryException $queryException){
            dd($queryException->getMessage());
        }

        return $datatable;
    }

}
