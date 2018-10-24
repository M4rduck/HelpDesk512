<?php

namespace App\Http\Controllers\Incidence;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Incidence\Solicitude;
use App\Models\Poll;
use App\Models\Incidence\IncidenceState;
use App\Models\Category;
use App\Models\Area;
use App\User;
use DB;

class SolicitudeController extends Controller
{
    public function index(){

        $solicitudes = Solicitude::all();

        $polls = Poll::all();

        $categories = Category::all();

        $areas_available = Auth::user()->areas()->first()->eterprises()->first()->areas()->get();

        //solicitudes unidas con el area
        $data = [];

        foreach ($solicitudes as $solicitude) {
            
            $data[] = [
                
                'id' => $solicitude->id,
                'area' => $solicitude->area()->pluck('name'),
                'title' => $solicitude->title,
                'description' => $solicitude->description,
                'details' => '<a class="btn btn-default btn-block" href="'.url('/incidence/solicitudes/'.$solicitude->id).'"><i class="fa fa-bars" aria-hidden="true"></i></a>'

                //'area' => DB::table('area')->where('id', '=', $solicitude->area_id)->get()
            ];
        }

        return view('incidence.solicitudes', 
            [
                'solicitudes' => $data,
                'polls' => $polls,
                'categories' => $categories,
                'areas_available' => $areas_available
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
            'polls' => 'required',
            'default_poll' => 'required',
        ];

        $mensajes = [
            'required' => 'El campo :attribute es obligatorio',
        ];

        $req->validate($reglas, $mensajes);

        $solicitude = new Solicitude;

        $solicitude->area_id = filter_var($req->area, FILTER_SANITIZE_STRING);
        $solicitude->title = filter_var($req->title, FILTER_SANITIZE_STRING);
        $solicitude->description = filter_var($req->description, FILTER_SANITIZE_STRING);
        
        if($solicitude->save()){

            $solicitude->categories()->attach(explode(',', $req->categories));

            $polls_array = explode(',', $req->polls);

            foreach ($polls_array as $poll) {
                
                if($poll == $req->default_poll){
                    $solicitude->polls()->attach($poll, ['is_active' => 1]);
                }else{
                    $solicitude->polls()->attach($poll, ['is_active' => 0]);
                }
  
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

        $solicitude = Solicitude::with(['incidence.agent:id,name', 'incidence.contact:id,name', 'incidence.incidenceState:id,name'])->findOrFail($id);
        $polls = $solicitude->polls()->orderBy('pivot_is_active', 'desc')->get();
        $registered_categories = $solicitude->categories()->pluck('id');
        $available_categories = Category::all();
        $areas = Auth::user()->areas()->first()->eterprises()->first()->areas()->get();
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
            'polls' => $polls,
            'registered_categories' => $registered_categories,
            'available_categories' => $available_categories,
            'estados_incidencia' => $estados_incidencia,
            'prioridades' => $prioridades
        ]);

    }

    public function destroy($id){

        $solicitude = Solicitude::findOrFail($id);
        
        foreach ($solicitude->incidence as $incidence) {
            
            $incidence->tracings()->delete();

            $incidence->delete();
        }

        $solicitude->polls()->detach();
        $solicitude->categories()->detach();
        
        return response()->json(Solicitude::destroy($id), 200);
        

    }

    public function update(Request $req, $id){

        $solicitude = Solicitude::findOrFail($id);

        $solicitude->area_id = $req->area;

        $old_poll = $solicitude->polls()->wherePivot('is_active', '=', '1')->first();
        $old_poll->pivot->is_active = 0;
        $old_poll->pivot->save();
        $new_poll = $solicitude->polls()->where('solicitude_id', '=', $id)->where('poll_id', '=', $req->encuesta)->first();
        $new_poll->pivot->is_active = 1;
        $new_poll->pivot->save();

        $solicitude->categories()->sync($req->categorias);

        $solicitude->description = $req->descripcion;

        $solicitude->save();

        
        return response()->json($solicitude);

    }

}
