<?php

namespace App\Http\Controllers\BaseConocimiento;

use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

use App\Models\KnowledgeBase;
use Yajra\DataTables\DataTables;

class BaseConocimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('BaseConocimiento.index');
    }
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $request = new KnowledgeBase;
            return view ('BaseConocimiento.form',compact('request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->nombre);
    }

    public function loadBody(){
        try{
            $request = KnowledgeBase::with('users')->orderBy('id','desc')->get();
            $body = View('BaseConocimiento.body')->with(['bases'=>$request])->render();
        }catch(QueryExcetion $queryException){
            return response()->json(['error' => true, 'title' => 'Error', 'text' => 'Ha ocurrido un error al cargar los datos de la base de conocimiento']);
        }catch(RelationNotFoundException $relationNotFoundException){
            return response()->json(['error' => true, 'title' => 'Error', 'text' => 'Ha ocurrido un error al cargar los datos de la base de conocimiento']);
        }
        return response()->json(['error' => false, 'body' => $body]);        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Api the charge datatable from view
     * @param int $request 
     */
    
}
