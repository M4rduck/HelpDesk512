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
    public function index()
    {
        return view('Categories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /* api que me traer los datos del datatable*/
    public function apiCategory()
    {
            $categories = Category::all();
          
        
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
    
   
