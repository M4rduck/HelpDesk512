<?php

namespace App\Http\Controllers\Encuestas;

use App\Models\Poll_has_question;
use App\Models\Poll_has_response;
use App\Models\Incidence_has_poll;
use App\Models\Poll;
use App\Models\Question;
use App\Models\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class EncuestaController extends Controller
{

    public function __construct()
	{
		$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preguntas = Poll_has_question::with('preguntas')->where('poll_id',1)->get();

        $respuestas = Poll_has_response::with('respuestas')->where('poll_id',1)->get();
        
        return view('Encuestas/encuesta', ['preguntas' => $preguntas, 'respuestas' => $respuestas]);
    }

    public function pollAdmin () {        
        return view('Encuestas/addEncuesta');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //Se crea una pregunta nueva
        if(isset($request->pregunta)){
            $question = new Question;
            $question->description = $request->pregunta;            
            $question->save();
            return back()->with('msj', 'Se creo la pregunta correctamente.');
        }

        //Se crea una respuesta nueva
        if(isset($request->respuesta)){
            $response = new Response;
            $response->description = $request->respuesta;            
            $response->save();

            return back()->with('msj', 'Se creo la respuesta correctamente.');
        }

        //Se crea y se relaciona una encuesta nueva con sus preguntas y respuestas
        if(isset($request->titlePoll)){
            $poll = new Poll;
            $poll->title = $request->titlePoll;
            $poll->description = $request->titlePoll;

            if($poll->save()) {
                for($i = 0; $i < $request->cantPreg; $i++){
                    $Poll_has_question = new Poll_has_question;
                    $Poll_has_question->question_id = $request->pregunta.$i+1;
                    $Poll_has_question->poll_id = $poll->id;        
                    $Poll_has_question->save();
                }

                for($j = 0; $j < $request->cantResp; $j++){
                    $Poll_has_response = new Poll_has_response;
                    $Poll_has_response->response_id = $request->respuesta.$j+1;
                    $Poll_has_response->poll_id = $poll->id;        
                    $Poll_has_response->save();
                }
            }

            return redirect('home')->with('msj','Se guardo la encuesta correctamente.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request){

            try{                
                
                for($i=1; $i <= $request->cantPreguntas; $i++){
                    $userResponse = new Incidence_has_poll;
                    $userResponse->poll_id = 1;
                    $userResponse->user_id = Auth::user()->id;
                    $userResponse->question_id = $request['Pregunta'.$i];
                    $userResponse->response_id = $request['Respuesta'.$i];
                    
                    $userResponse->save();
                }

                //Redireccionamos a la vista de home.
                return redirect('home')->with('msj','Se agrego la encuesta correctamente.');

            }catch(\Exception $e){
                echo $e;
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function show($tipo)
    {
        switch ($tipo) {
            case 'preguntas':
                $preguntas = Question::all();
                echo json_encode($preguntas);
                break;

            case 'respuestas':
                $respuestas = Response::all();
                echo json_encode($respuestas);
                break;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function edit(Encuesta $encuesta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Encuesta $encuesta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Encuesta  $encuesta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Encuesta $encuesta)
    {
        //
    }
}
