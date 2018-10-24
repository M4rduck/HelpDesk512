<?php

namespace App\Http\Controllers\Diagnosis;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
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
        //dd($request->all()); 
        foreach($request->all() as $llave  => $valor){
            $llaves = explode('_', $llave);
            if(count($llaves) === 3 || count($llaves)  === 4){
                $llaves[0];
                $llaves[1];
                $llaves[2];
                $llaves[3];
            }
        }

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
        
        return view('diagnosis.consulta.index')->with(['formulario' => $incidencia->solicitude->forms->first(), 'title_solicitude' => $incidencia->solicitude->title]);
    }
}