<?php

namespace App\Http\Controllers\Incidence;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IncidenceController extends Controller
{
    public function index(){
        return view('incidence.index');
    }

    public function create(){
        return view('incidence.register');
    }

    public function store(Request $request){
        
        $reglas = [
            'contacto' => 'required',
            'tema' => 'required',
            'estado' => 'required',
            'prioridad' => 'required',
            'agente' => 'required',
            'descripcion' => 'required',
            'evidencia' => 'file|mimetypes:image/jpeg'
        ];

        $mensajes = [
            'required' => 'El campo :attribute es obligatorio',
            'mimetypes' => 'Solo se permiten archivos con extension jpeg, jpg, png, zip, rar'
        ];

        $request->validate($reglas, $mensajes);

        dd($request->file('evidencia'));

        $incidencia = new Incidence;
        $incidencia->contacto = sanitize($request->contacto);
        $incidencia->tema = sanitize($request->tema);
        $incidencia->estado = sanitize($request->estado);
        $incidencia->prioridad = sanitize($request->prioridad);
        $incidencia->agente = sanitize($request->agente);
        $incidencia->descripcion = sanitize($request->descripcion);
        $incidencia->ruta_evidencia = '';
        $incidencia->etiquetas = '';

        if($request->etiquetas){
            $incidencia->etiquetas = implode(',', $request->etiquetas);
        }

        if($incidencia->save()){
            
            if($request->hasFile('evidencia')){
                //TODO guardar con id de incidencia
                $incidencia->ruta_evidencia = $request->file('evidencia')->store('/', 'incidences');
                $incidencia->save();
            }

            $msg = [
                'estado' => 's',
                'mensaje' => 'La incidencia ha sido registrada'
            ];

        }else{

            $msg = [
                'estado' => 'w',
                'mensaje' => 'No se ha podido registrar la incidencia'
            ];

        }

        return redirect()->route('incidences-create')->with('msg', $msg);
    }

    private function sanitize($field){

        return filter_var($field, FILTER_SANITIZE_STRING);
    
    }

}
