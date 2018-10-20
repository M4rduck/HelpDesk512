<?php

namespace App\Http\Controllers\Reportes;

use Illuminate\Http\Request;
use App\Models\Incidence;
use App\Models\Incidence_has_poll;
use App\Models\Poll_has_question;
use App\Models\Poll_has_response;
use App\Http\Controllers\Controller;


class ReportController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
    }
    
    public function index () {

        $preguntas = Poll_has_question::with('preguntas')->where('poll_id',1)->get();

        return view('Reportes/report', ['preguntas' => $preguntas]);
    }

    public function reportGeneral (Request $request) {
        $pendientes = Incidence::where('id_incidence_state', 1)->count();
        $cerrados = Incidence::where('id_incidence_state', 2)->count();
        $vencidos = Incidence::where('id_incidence_state', 3)->count();

        $newData = [
            "labels" => [
                "Pendientes",
                "Completados",
                "Vencidos",
            ],
            "backgroundColor" => [
                "#F7464A",
                "#46BFBD",
                "#949FB1",
            ],
            "data" => [$pendientes, $cerrados, $vencidos]
        ];
        
        return $newData;
    }

    public function reportFechas(Request $request) {
        $incidentes = Incidence::with('usuario')->with('estado')
        ->whereBetween('created_at', [$request->fechainicial, $request->fechafinal])
        ->paginate(7);
        /* foreach ($incidentes as $incidente) {
            dd($incidente->usuario);
        } */
        $pendientes = Incidence::whereBetween('created_at', [$request->fechainicial, $request->fechafinal])
        ->where('id_incidence_state', 1)->count();
        $cerrados = Incidence::whereBetween('created_at', [$request->fechainicial, $request->fechafinal])
        ->where('id_incidence_state', 2)->count();
        $vencidos = Incidence::whereBetween('created_at', [$request->fechainicial, $request->fechafinal])
        ->where('id_incidence_state', 3)->count();

        $newData = [
            "vista" => view('Reportes/tablaReport', ['incidentes' => $incidentes])->render(),
            "data" => [$pendientes, $cerrados, $vencidos]
        ];

        return $newData;
    }

    public function reportEncuesta (Request $request) {
                
        $preguntas = Poll_has_question::with('preguntas')->where('poll_id',1)->get();
        $respuestas = Poll_has_response::with('respuestas')->where('poll_id',1)->get();   

        $labels = [];
        $cantResp = [];
        $arrayResp = [];        

        foreach($respuestas as $r => $resp){
            $labels[$r] = $resp->respuestas->description;
            $cantResp[$r] = Incidence_has_poll::with('respuestas')->where('poll_id',1)
            ->where('question_id', $request->data)->where('response_id', $resp->response_id )->count();
        } 

        foreach($preguntas as $key => $preg){
            foreach($respuestas as $r => $resp){
                $arrayResp [$key][$r] = Incidence_has_poll::with('respuestas')->where('poll_id',1)
                ->where('question_id', $preg->question_id)->where('response_id', $resp->response_id )->count();
            }           
        }

        $newData = [
            "text" => "Grafico general de la encuesta (Cantidad de personas / Satisfaccion con el servicio)",
            "lbl" => "Cantidad de personas",
            "labels" => $labels,
            "backgroundColor" => [
                'rgba(255, 99, 132, 0.2)',                
                'rgba(54, 162, 235, 0.2)',                
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 30, 112, 0.2)',
                
            ],
            "data" => $cantResp
        ];
        
        return $newData;
    }

}
