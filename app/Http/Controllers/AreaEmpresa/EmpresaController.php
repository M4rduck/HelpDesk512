<?php

namespace App\Http\Controllers\AreaEmpresa;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Enterprise;
use DB;

class EmpresaController extends Controller
{

    function index(){    
        try{
            $citys = City::where('visible', 1)->get()->pluck('name', 'id');
        }catch(QueryException $queryException){
            abort(404, 'Error al traer las ciudades, error: '.$queryException->getCode());
        } 
        
    	return view('areaEmpresa.empresa.index')->with('citys', $citys);    
    }

    function edit($id){
        try{
            $enterprise = Enterprise::find($id);
        }catch(QueryException $queryException){
            return response()->json(['success' => true, 'error' => true, 'title' => 'Error', 'msg' => 'Ha sucedido un error al traer los datos de la empresa, error: '.$queryException->getCode()]);
        }
        return response()->json(['success' => true, 'error' => false, 'enterprise' => $enterprise ]);
    }

    function store(Request $request){
        parse_str($request->data, $data);
        try{
            Enterprise::create($data['enterprise']);
        }catch(QueryException $queryException){
            return response()->json(['success' => true, 'error' => true, 'title' => 'Error', 'msg' => 'Ha sucedido un error al guardar la empresa, error: '.$queryException->getCode()]);
        }
        return response()->json(['success' => true, 'error' => false, 'title' => 'Felicitaciones!', 'msg' => 'Se ha creado satisfactoriamente la empresa']);
    }

    function update($id, Request $request){
        try{
            $enterprise = Enterprise::find($id);
            $enterprise->business_name = $request->enterprise['business_name'];
            $enterprise->address = $request->enterprise['address'];
            $enterprise->legal_representative = $request->enterprise['legal_representative'];            
            
            $enterprise->city()->attach([$request->enterprise['city_id']]);

            $enterprise->save();
        }catch(QueryException $queryException){
            return response()->json(['success' => true, 'error' => true, 'title' => 'Error', 'msg' => 'Ha sucedido un error al modificar la empresa, error: '.$queryException->getCode()]);
        }
        return response()->json(['success' => true, 'error' => false, 'title' => 'Felicitaciones!', 'msg' => 'Se ha modificado satisfactoriamente la empresa']);
    }

    public function getEnterprises(){
        try{
                $datatable = DataTables::eloquent(Enterprise::with(['phones', 'city'])->withCount('areas')->where('sw_active', 1))
                        ->editColumn('action', function(Enterprise $enterprise){
                            ($enterprise->areas_count > 0) ? $classArea = 'btn-primary' : $classArea = 'btn-warning';
                            return ' <a class="btn btn-xs '.$classArea.'" href="'.route('area.show', ['id' => $enterprise->id]).'"><i class="fa fa-fw fa-university"></i> Areas</a>'.
                                   ' <a class="btn btn-xs btn-success edit-enterprise" data-id="'.$enterprise->id.'" href="'.route('empresa.edit', ['id' => $enterprise->id]).'"><i class="glyphicon glyphicon-edit"></i> Edit</a>'.
                                   ' <a class="btn btn-xs btn-danger delete-enterprise" data-id="'.route('empresa.destroy', ['id' => $enterprise->id]).'"><i class="fa fa-trash"></i> DELETE</a>';
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

    public function destroy($id){
        try{
            $enterprise = Enterprise::find($id);
            $enterprise->sw_active = 0;
            $enterprise->save();
        }catch(QueryException $queryException){
            return response()->json(['success' => true, 'error' => true, 'title' => 'Error', 'msg' => 'Ha sucedido un error al eliminar la empresa, error: '.$queryException->getCode()]);
        }
        return response()->json(['success' => true, 'error' => false, 'title' => 'Felicitaciones!', 'msg' => 'Se ha eliminado satisfactoriamente la empresa']);
    }
}
