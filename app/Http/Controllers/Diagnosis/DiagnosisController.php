<?php

namespace App\Http\Controllers\Diagnosis;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Incidence\Incidence;
use App\Models\TypeInput;
use App\Models\Solicitude;

class DiagnosisController extends Controller
{
    public function index(){
        $solicitudes = Solicitude::where('is_deleted', 0)->get()->pluck('title', 'id');
        return view('diagnosis.parameterization.index')->with('solicitudes', $solicitudes);
    }

    public function create(){
        try{
            $inputs = TypeInput::all()->pluck('name','id');
        }catch(QueryException $queryException){
            abort(404, 'Ha sucedido un problema al cargar los tipos de campos');
        }
                
        return view('diagnosis.parameterization.create')->with(['inputs' => $inputs]);
    } 
    
    public function store(Request $request){

    }

    public function storeDiagnosisTechnic(Request $request){ 
        parse_str($request->data, $datos);        
        $fecha = new \DateTime();
        try{
            DB::beginTransaction();
            foreach($datos as $llave  => $valor){
            
                $llaves = explode('_', $llave);
    
                if(count($llaves) === 3 || count($llaves)  === 4){
                    DB::table('diagnosis')->insert([
                        'incidence_id' => $datos['incidence_id'],
                        'user_id' => Auth::id(),
                        'form_id' => $llaves[0],
                        'section_id' => $llaves[1],
                        'sub_section_id' => $llaves[2],
                        'field_id' => array_key_exists(3, $llaves) ? $llaves[3] : $valor,
                        'value' => $valor,
                        'created_at' => $fecha->format('Y-m-d H:i:s'),
                        'updated_at' => $fecha->format('Y-m-d H:i:s')
                    ]);
                }
            }
        }catch(QueryException $queryException){
            DB::rollBack();
            if($queryException->getCode() == 23000){
                return response()->json(['success' => true, 'error' => true, 'msg' => 'Ya guardaste este diagnostico']);        
            }
            return response()->json(['success' => true, 'error' => true, 'msg' => 'Ha ocurrido un error al guardar el diagnostico, error:'.$queryException->getCode()]);        
        }
        DB::commit();
        return response()->json(['success' => true, 'error' => false, 'msg' => 'Se ha guardado satisfactoriamente el diagnostico']);        

    }

    public function show($id){
        try{
            $incidencia = Incidence::with(['solicitude.forms' => function($join){
                                $join->with('sections.subSections.fields.typeInput')->where('is_active', 1);
                          }])->find($id);
            
            if(is_null($incidencia)){
                abort(404, 'No es posible encontrar la incidencia');                                                
            }
        }catch(QueryException $queryException){
            abort(404, 'Ha ocurrido un error al cargar la incidencia');
        }
        
        return view('diagnosis.consulta.index')->with(['formulario' => $incidencia->solicitude->forms->first(), 'title_solicitude' => $incidencia->solicitude->title, 'incidence_id' => $incidencia->id]);
    }
}