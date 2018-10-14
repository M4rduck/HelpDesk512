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
        $create = $request->traicing;
        $create['id_agent'] = Auth::id();
        try{
            Tracing::create($create);
        }catch(QueryException $queryException){
            return response()->json(['success' => true, 'error' => true, 'msg' => 'Ha sucedido un problema al guardar, error: '.$queryException->getCode()]);
        }
        return response()->json(['success' => true, 'error' => false, 'msg' => 'Se ha agregado el comentario satisfactoriamente']);
        /*$tracing->id_incidence= $request->,
        'id_agent',
        'id_user',
        'comment'*/
    }

    public function show($id){
        try{
            $comentarios = Tracing::where('id_incidence', $id)->get();
            $tracings = View('incidence.tracings')->with(['comentarios' => $comentarios])->render();
        }catch(QueryException $queryException){
            return response()->json(['success' => true, 'error' => true, 'msg' => 'Ha sucedido un problema al guardar, error: '.$queryException->getCode()]);
        }
        return response()->json(['success' => true, 'error' => false, 'body' => $tracings]); 
    }

}