<?php

namespace App\Http\Controllers\Incidence;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Incidence\Solicitude;
use DB;

class SolicitudeController extends Controller
{
    public function index(){
        return view('incidence.solicitudes');
    }

    public function temp_areas(){
        
        $areas = DB::table('area')->get();

        if($areas){

            foreach ($areas as $area) {
                $data[] = [
                    'label' => $area->name,
                    'value' => $area->id
                ];
            }

        }

        return response()->json($data, 200);
    }

    public function store(Request $req){

        $reglas = [
            'area' => 'required',
            'title' => 'required',
            'description' => 'required',
            'evidence' => 'file|mimetypes:image/jpeg',
        ];

        $mensajes = [
            'required' => 'El campo :attribute es obligatorio',
            'mimetypes' => 'Solo se permiten archivos con extension jpeg, jpg, png, zip, rar'
        ];

        $req->validate($reglas, $mensajes);

        $solicitude = new Solicitude;

        $solicitude->area_id = filter_var($req->area, FILTER_SANITIZE_STRING);
        $solicitude->title = filter_var($req->title, FILTER_SANITIZE_STRING);
        $solicitude->description = filter_var($req->description, FILTER_SANITIZE_STRING);
        
        if($solicitude->save()){
            
            /*if($req->evidence){
                //TODO guardar con id de incidencia
                $solicitude->evidence_route = $req->file('evidencia')->store('/', 'incidences');
                $incidencia->save();
            }*/

            $msg = [
                'estado' => true,
                'mensaje' => 'La solicitud ha sido registrada'
            ];

        }else{

            $msg = [
                'estado' => false,
                'mensaje' => 'No se ha podido registrar la incidencia'
            ];

        }  

        return response()->json($msg, 200);

    }

}
