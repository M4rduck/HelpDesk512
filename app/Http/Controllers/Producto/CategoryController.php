<?php

namespace App\Http\Controllers\Producto;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::pluck('name','id'); 
        return view('Categories.index')->with(['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sw_main= Sw_main::findOrFail($request->sw_main);
            if($sw_main==1){
       
        $input = $request->all();
        $categories = Category::create($input);
        dd($request->get('categories'));
        $categories->categories()->sync($request->get('categories'));
        return response()->json([
            'success' => true,
            'message' => 'Category Created'
        ]);
    }else{
        
        $input = $request->all();
        $categories = Category::create($input);
        dd($request->get('categories'));
        $categories->categories()->sync($request->get('categories'));
        return response()->json([
            'success' => true,
            'message' => 'subCategory Created'
            ]);
    }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
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
        
        $categories = Category::findOrFail($id);
        return $categories;
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

        $input = $request->all();
        $categories = Category::findOrFail($id);

        $categories->update($input);

       return response()->json([
           'success' => true,
           'message' => 'Category Updated'
       ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = Category::whereId($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category Delete'
        ]); 
    }

    /* api que me traer los datos del datatable*/
    public function apiCategory()
    {
        $categories = Category::with('category');
          
        
        return Datatables::of($categories)
            ->addColumn('action', function($categories){
                return '<td width="10px">
                            <button  class="btn btn-success btn-sm" 
                                onclick="editForm('. $categories->id .')">
                                <i class="fa fa-pencil-square-o"></i> Edit</button>
                          </td>' .
                          '<td width="10px">
                           <button class="btn btn-danger btn-sm" href="#"
                           onclick="deleteData('. $categories->id .')">
                            <i class="fa fa-trash"></i> 
                          Delete</button>  
                          </td>';
            })->make(true); 
    }
}
    
   
