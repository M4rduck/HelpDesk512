<?php

namespace App\Http\Controllers\Incidence;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Incidence\Incidence;

class IncidenceController extends Controller
{

    public function store(Request $request){
        
        $reglas = [
            'contact' => 'required',
            'theme' => 'required',
            'incidence_state' => 'required',
            'priority' => 'required',
            'agent' => 'required',
            'description' => 'required',
            'incidence_evidence' => 'file|mimetypes:image/jpeg,image/png,application/zip'
        ];

        $mensajes = [
            'required' => 'El campo :attribute es obligatorio',
            'mimetypes' => 'Solo se permiten archivos con extension jpeg, jpg, png, zip, rar'
        ];

        $request->validate($reglas, $mensajes);

        //dd($request->file('evidencia'));

        $incidencia = new Incidence;

        $incidencia->id_contact = $request->contact;
        $incidencia->theme = $request->theme;
        $incidencia->id_incidence_state = $request->incidence_state;
        $incidencia->priority = $request->priority;
        $incidencia->id_agent = $request->agent;
        $incidencia->description = $request->description;
        $incidencia->evidence_route = '';
        $incidencia->label = $request->labels;
        $incidencia->id_solicitude = $request->id_solicitude;

        /*
        if($request->labels){
            $incidencia->labels = implode(',', $request->etiquetas);
        }
        */

        if($incidencia->save()){
            
            if($request->hasFile('incidence_evidence')){
                //TODO guardar con id de incidencia
                $incidencia->evidence_route = $request->file('incidence_evidence')->storeAs('public', $incidencia->id);
                $incidencia->save();
            }

            $msg = [
                'estado' => true,
                'mensaje' => 'La incidencia ha sido registrada'
            ];

        }else{

            $msg = [
                'estado' => false,
                'mensaje' => 'No se ha podido registrar la incidencia'
            ];

        }

        return response()->json($msg, 200);
    }

    public function show($id){

        $incidence= Incidence::with(['agent:id,name', 'contact:id,name', 'incidenceState:id,name', 'solicitude:id,title'])->findOrFail($id);

        return view('incidence.incidence',[
            'incidence'=>$incidence
        ]);
    }
}
