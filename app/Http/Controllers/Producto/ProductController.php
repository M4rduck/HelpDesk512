<?php

namespace App\Http\Controllers\Producto;

use App\Models\Inventario\Hardware;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\General\Controller as ModelController;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Software;
use App\Http\Requests\StoreProductosRequest;
use App\Models\Category;

class ProductController extends Controller
{
   

    public function indexSoft(Request $request)
    {
        $soft = Software::orderBy('id','DESC')->get();
        $cate = Category::pluck('name', 'id');
        return view('product.index2')->with(['soft'=>$soft,'cate'=>$cate]);

        


    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSoft(Request $request)
    {
     
        $input = $request->all();
        $soft = Software::create($input);
        
        
        return response()->json([
            'success' => true,
            'message' => 'Hardware Created'
        ]); 
    }

    /**
     * Display the specified resource.vv
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
    public function edit($id)
    {
        $softs= Software::find($id);
        return  array ("soft"=>$softs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function act(Request $request,  $id)
    {
        
     $input = $request->all();
     $soft= Software::findOrFail($id);

     $soft->update($input);
    return response()->json([
        'success' => true,
        'message' => 'User Updated'
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

        $soft = Software::FindOrFail($id);
        dd($soft);
        
        exit;
        $active = '';
        $deleted= '';
        if($soft->is_active == 1 && $soft->is_deleted == 0){
            $active = '0';
            $deleted= '1';
        }else{
         $active = '1';
         $deleted= '0';
        }

        return $active; $deleted;
        
      
    }

    public function store(Request $request){

        
        
        $hardware = new Hardware($request->all());
        $hardware->save();

        return redirect()->route('product.index');
       
    
    }

   

    public function apiSoft(){
        $soft = Software::orderBy('id','DESC')->get();
        
        return Datatables::of($soft)
            ->addColumn('action',function($soft){
                return '<td width="10px">
                <button  class="btn btn-success btn-sm" 
                    onclick="editForm('. $soft->id .')">
                    <i class="fa fa-pencil-square-o"></i> Edit</button>
              </td>' .
              '<td width="10px">
               <button class="btn btn-danger btn-sm" href="#"
               onclick="deleteData('. $soft->id .')">
                <i class="fa fa-trash"></i> 
              Delete</button>  
              </td>';


            })
            ->editColumn('edit',function($soft){
               $active = '';
               if($soft->is_active == 1){
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
