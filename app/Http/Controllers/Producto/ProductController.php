<?php

namespace App\Http\Controllers\Producto;

use App\Models\General\Method;
use App\Models\General\Module;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Software;
use App\Http\Requests\StoreProductosRequest;

class ProductController extends Controller
{
    public function index(Request $request){

        
    }

    public function indexSoft(Request $request)
    {
       $prodSoft = Software::all();

       
        return view('product.index2', compact('prodSoft'));
    }

    public function create()
    {
        return view('product.index2');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSoft(Request $request)
    {

        $infoProductosSoft = new Software();
       
        $infoProductosSoft->name    = $request->input('name');
        $infoProductosSoft->descritpion  = $request->input('descritpion');
        $infoProductosSoft->serial  = $request->input('serial');
        $infoProductosSoft->has_module  = $request->input('has_module');
        $infoProductosSoft->has_license  = $request->input('has_license');
        $infoProductosSoft->is_active  = $request->input('is_active');
        $infoProductosSoft->is_deleted  = $request->input('is_deleted');
           
        $infoProductosSoft->save();
         
        return redirect()->route('product.indexSoft');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Software $infoProductoSoft)
    {
        return view('product.editarProducto', compact('infoProductoSoft'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function act(Request $request, Software $infoProductoSoft)
    {
        
        $infoProductoSoft->name = $request->get('name');
        $infoProductoSoft->descritpion  = $request->get('descritpion');
        $infoProductoSoft->serial  = $request->get('serial');
        $infoProductoSoft->has_license  = $request->get('has_license');
        $infoProductoSoft->has_module  = $request->get('has_module');
        $infoProductoSoft->is_active  = $request->get('is_active');
        $infoProductoSoft->is_deleted  = $request->get('is_deleted');

        $infoProductoSoft->save();

        return redirect()->route('product.indexSoft');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    public function delete(Request $request, Software $infoProductoSoft)
    {
        $infoProductoSoft->delete();
        
        return redirect()->route('product.indexSoft');
    }


}