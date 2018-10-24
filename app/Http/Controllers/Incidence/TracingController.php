<?php

namespace App\Http\Controllers\Incidence;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Incidence\Tracing;
use App\User;
use DB;

class TracingController extends Controller{

    public function index(){
               
    }

    public function store (Request $request){        
        parse_str($request->datos, $datos);
        $datos['tracing']['id_agent'] = Auth::id();
        try{
            Tracing::create($datos['tracing']);
        }catch(QueryException $queryException){
            return response()->json(['success' => true, 'error' => true, 'msg' => 'Ha sucedido un problema al guardar, error: '.$queryException->getCode()]);
        }
        return response()->json(['success' => true, 'error' => false, 'msg' => 'Se ha agregado el comentario satisfactoriamente']);
    }

    public function show($id){
        try{
            $comentarios = Tracing::with(['user.roles', 'agent.roles'])->where('id_incidence', $id)->get();
            $tracings = View('incidence.tracings')->with(['comentarios' => $comentarios])->render();
        }catch(QueryException $queryException){
            return response()->json(['success' => true, 'error' => true, 'msg' => 'Ha sucedido un problema al guardar, error: '.$queryException->getCode()]);
        }
        return response()->json(['success' => true, 'error' => false, 'body' => $tracings]); 
    }


}