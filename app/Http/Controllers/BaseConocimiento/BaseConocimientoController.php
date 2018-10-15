<?php

namespace App\Http\Controllers\BaseConocimiento;

use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

use App\Models\KnowledgeBase;
use App\Models\Category;
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
            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:300'
        ]);
        $tags = explode(',', $request->tags);
        $base = KnowledgeBase::create($request->all());
        $base->tag($tags);
        return $base;
    }

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $base = KnowledgeBase::with('users','category')->find($id);
        return view('baseConocimiento.show',compact('base'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $base = KnowledgeBase::with('users','category','tagged')->find($id);
        return ['base'=>$base];
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
        $this->validate($request,[
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:300'
        ]);
        $tags = explode(',', $request->tags);
        $base = KnowledgeBase::update($request->all());
        $base->retag($tags);
        return $base;
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
     * Api the charge body from view
     * @param int $request 
     */
    public function loadBody(){
        try{
            $request = KnowledgeBase::with('users','category')->orderBy('id','desc')->paginate(4);
            $body = View('BaseConocimiento.body')->with(['bases'=>$request])->render();
        }catch(QueryExcetion $queryException){
            return response()->json(['error' => true, 'title' => 'Error', 'text' => 'Ha ocurrido un error al cargar los datos de la base de conocimiento']);
        }catch(RelationNotFoundException $relationNotFoundException){
            return response()->json(['error' => true, 'title' => 'Error', 'text' => 'Ha ocurrido un error al cargar los datos de la base de conocimiento']);
        }
        return response()->json(['error' => false, 'body' => $body]);        
    }
    
    /**
     * search body for category
     * @param int $request 
     */
    public function category($name){
        
            $category  = Category::where('name', $name)->pluck('id')->first();
            $bases = KnowledgeBase::with('users','category')->where('category_id', $category)->orderBy('id','desc')->paginate(4);
            return  view('baseConocimiento.shows',compact('bases'));         
    }

    /**
     * search body for tags
     * @param int $request 
     */
    public function tag($slug){
        try{
            $bases = KnowledgeBase::withAllTags($slug)->with('users','category')->paginate(4);

        }catch(QueryExcetion $queryException){
            return response()->json(['error' => true, 'title' => 'Error', 'text' => 'Ha ocurrido un error al cargar los datos de la base de conocimiento']);
        }catch(RelationNotFoundException $relationNotFoundException){
            return response()->json(['error' => true, 'title' => 'Error', 'text' => 'Ha ocurrido un error al cargar los datos de la base de conocimiento']);
        }
        return  view('baseConocimiento.shows',compact('bases'));              
    }


    public function like(Request $request){
        $base = KnowledgeBase::find($request->id);
        $response = auth()->user()->toggleLike($base);
        return response()->json(['success'=>$response]);
    }
}
