<?php

namespace App\Http\Controllers\Producto;

use App\Models\Inventario\Hardware;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\Controller as ModelController;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index(){

        $hard = Hardware::orderBy('id','DESC')->get();
        return view('product.index')->with('hard',$hard);
        


    }

    public function store(Request $request){

        
        
        $hardware = new Hardware($request->all());
        $hardware->save();

        return redirect()->route('product.index');
       
    
    }

    public function show(){
   
        
    }

    public function apiProduct(){
        $hard = Hardware::orderBy('id','DESC')->get();
        
        return Datatables::of($hard)
            ->addColumn('action',function($hard){
                return '<td width="10px">
                        <button  class="btn btn-success btn-sm" 
                            onclick="editForm('. $hard->id .')">
                            <i class="fa fa-pencil-square-o"></i> Edit</button>
                        </td>' .
              '<td width="10px">
               <button class="btn btn-danger btn-sm" href="#"
               onclick="deleteData('. $hard->id .')">
                <i class="fa fa-trash"></i> 
              Delete</button>  
              </td>'; 

            })
            ->editColumn('edit',function($hard){
               $active = '';
               if($hard->is_active == 1){
                   $active = '<span class="label label-primary">Activo</span>';
               }else{
                $active = '<span class="label label-danger">Inactivo</span>';
               }

               return $active;
            })
            ->rawColumns(['edit'=>'edit','action'=>'action'])
            ->make(true); 

        
    }


}