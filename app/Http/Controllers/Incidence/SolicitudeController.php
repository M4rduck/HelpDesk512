<?php

namespace App\Http\Controllers\Incidence;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Incidence\Solicitude;
use App\Models\Incidence\IncidenceState;
use App\User;
use DB;

class SolicitudeController extends Controller
{
    public function index(){

        $solicitudes = Solicitude::all();

        //solicitudes unidas con el area
        $data = [];

        foreach ($solicitudes as $solicitude) {
            
            $data[] = [
                
                'id' => $solicitude->id,
                'area' => DB::table('area')->where('id', $solicitude->area_id)->value('name'),
                'title' => $solicitude->title,
                'description' => $solicitude->description,
                'details' => '<a class="btn btn-default btn-block" href="'.url('/incidence/solicitudes/'.$solicitude->id).'"><i class="fa fa-bars" aria-hidden="true"></i></a>'

                //'area' => DB::table('area')->where('id', '=', $solicitude->area_id)->get()
            ];
        }

        return view('incidence.solicitudes', 
            [
                'solicitudes' => $data,
            ]);
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
            //'evidence' => 'file|mimetypes:image/jpeg,image/png,application/zip',
        ];

        $mensajes = [
            'required' => 'El campo :attribute es obligatorio',
            //'mimetypes' => 'Solo se permiten archivos con extension jpeg, jpg, png, zip, rar'
        ];

        $req->validate($reglas, $mensajes);

        $solicitude = new Solicitude;

        $solicitude->area_id = filter_var($req->area, FILTER_SANITIZE_STRING);
        $solicitude->title = filter_var($req->title, FILTER_SANITIZE_STRING);
        $solicitude->description = filter_var($req->description, FILTER_SANITIZE_STRING);
        
        if($solicitude->save()){
            
            if($req->hasFile('evidence')){
                //TODO guardar con id de incidencia
                $solicitude->evidence_route = $req->file('evidence')->storeAs('public', $solicitude->id);
                //$solicitude->evidence_route .= '.'.$req->file('evidence')->extension();
                $solicitude->save();
            }

            $msg = [
                'estado' => true,
                'mensaje' => 'La solicitud ha sido registrada'
            ];

        }else{

            $msg = [
                'estado' => false,
                'mensaje' => 'No se ha podido registrar la solicitud'
            ];

        }

        return response()->json($msg, 200);

    }

    public function list(){

        $solicitudes = Solicitude::all();

        $data = [];


        foreach ($solicitudes as $solicitude) {
            
            $data[] = [
                
                'id' => $solicitude->id,
                'area' => DB::table('area')->where('id', $solicitude->area_id)->value('name'),
                'title' => $solicitude->title,
                'description' => $solicitude->description,
                'details' => '<a class="btn btn-default btn-block" href="'.url('/incidence/solicitudes/'.$solicitude->id).'"><i class="fa fa-bars" aria-hidden="true"></i></a>'

                //'area' => DB::table('area')->where('id', '=', $solicitude->area_id)->get()
            ];
        }

        return response()->json($data, 200);
    }
    
    public function incidences($id){

        //$incidences = Incidence::where('id_solicitude', );
        $solicitude = Solicitude::with(['incidence.agent:id,name', 'incidence.contact:id,name', 'incidence.incidenceState:id,name'])->findOrFail($id);

        $incidences = $solicitude->incidence;

        return response()->json($incidences, 200);
    }

    public function show($id) {

        //$solicitude = Solicitude::findOrFail($id);
        $solicitude = Solicitude::with(['incidence.agent:id,name', 'incidence.contact:id,name', 'incidence.incidenceState:id,name'])->findOrFail($id);
        $areas = DB::table('area')->get();
        $contactos = User::all();
        $estados_incidencia = IncidenceState::all();
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

        return view('incidence.solicitude', [
            'solicitude' => $solicitude,
            'areas' => $areas,
            'contactos' => $contactos,
            'estados_incidencia' => $estados_incidencia,
            'prioridades' => $prioridades
        ]);

    }

    public function destroy($id){

        $solicitude = Solicitude::findOrFail($id);
        
        foreach ($solicitude->incidence as $incidence) {
            $incidence->delete();
        }
        
        return response()->json(Solicitude::destroy($id), 200);
        

    }

    public function update(Request $req, $id){

        $solicitude = Solicitude::findOrFail($id);

        switch ($req->column) {

            case 'area':
                $solicitude->area_id = $req->value;
                $solicitude->save();
                break;
            
        }
        return response()->json($solicitude);

    }

}
