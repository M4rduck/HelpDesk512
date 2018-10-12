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
        return view('baseConocimiento.show',['base'=>$base]);
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
        try{
        $category  = Category::where('name', $name)->pluck('id')->first();
        $request = KnowledgeBase::with('users','category')->where('category_id', $category)->orderBy('id','desc')->paginate(4);
        $body = View('BaseConocimiento.body')->with(['bases'=>$request])->render();
        session()->flash()->put(['category' => json_encode($body)]);
        }catch(QueryExcetion $queryException){
            return response()->json(['error' => true, 'title' => 'Error', 'text' => 'Ha ocurrido un error al cargar los datos de la base de conocimiento']);
        }catch(RelationNotFoundException $relationNotFoundException){
            return response()->json(['error' => true, 'title' => 'Error', 'text' => 'Ha ocurrido un error al cargar los datos de la base de conocimiento']);
        }
        return response()->json(['error' => false, 'body' => $body]);           
    }

    /**
     * search body for tags
     * @param int $request 
     */
    public function tag($slug){
        try{
            $request = KnowledgeBase::withAllTags($slug)->with('users','category')->paginate(4);
            $body = View('BaseConocimiento.body')->with(['bases'=>$request])->render();
            session()->put(['tag' => json_encode($body)]);
            //dd(json_encode($body));
        }catch(QueryExcetion $queryException){
            return response()->json(['error' => true, 'title' => 'Error', 'text' => 'Ha ocurrido un error al cargar los datos de la base de conocimiento']);
        }catch(RelationNotFoundException $relationNotFoundException){
            return response()->json(['error' => true, 'title' => 'Error', 'text' => 'Ha ocurrido un error al cargar los datos de la base de conocimiento']);
        }
        return response()->json(['error' => false, 'body' => $body]);              
    }

}
