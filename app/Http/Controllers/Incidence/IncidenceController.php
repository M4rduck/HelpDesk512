<?php

namespace App\Http\Controllers\Incidence;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Incidence\Incidence;
use App\Models\Incidence\IncidenceState;
use App\Models\Roles;
use App\User;
use DB;

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
        $contactos = User::all();
        $agentes = Roles::where('slug', '=', 'tecnico')->first()->users()->get();
        $solucion = DB::table('solution')->where('incidence_id', '=', $incidence->id)->get();
        $prioridades = [
            [
                'id' => 'low',
                'name' => 'Baja'
            ],
            [
                'id' => 'medium',
                'name' => 'Media'
            ],
            [
                'id' => 'high',
                'name' => 'Alta'
            ],
            [
                'id' => 'urgent',
                'name' => 'Urgente'
            ]
        ];
        //$agentes = User::withRole('Admin')->get();
        $estados = IncidenceState::all();

        return view('incidence.incidence',[
            'incidence'=>$incidence,
            'contactos' => $contactos,
            'prioridades' => $prioridades,
            'agentes' => $agentes,
            'estados' => $estados,
            'solucion' => $solucion
        ]);
    }

    public function update(Request $req, $id){

        $incidence = Incidence::findOrFail($id);
        
        if($req->estado == "5" and $req->insertar_solucion == "true"){
            DB::table('solution')->insert(
                [
                    'incidence_id' => $incidence->id,
                    'description' => $req->solucion,
                    'sw_knowledgebase' => $req->baseconocimiento
                ]
            );
        }

        $incidence->id_contact = $req->contacto;
        $incidence->id_agent = $req->agente;
        $incidence->priority = $req->prioridad;
        $incidence->id_incidence_state = $req->estado;

        if($incidence->save()){

            return response()->json("La incidencia ha sido actualizada", 200);

        }

        return response()->json(Incidence::findOrFail($id), 500);

    }

}
