<?php

namespace App\Http\Controllers\Producto;

use App\Models\Inventario\Hardware;
use Illuminate\Http\Request;
use Mockery\Exception;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;


class HardwareController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $hard = Hardware::orderBy('id','DESC')->get();
        return view('product.hardware.index')->with('hard',$hard);
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        
        $hardware = Hardware::create($request->all());
        
        return response()->json([
            'success' => true,
            'message' => 'Hardware Created'
        ]);  
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id){

        $hards= Hardware::find($id);
        return  array ("hard"=>$hards);
    }
    public function update(Request $request, $id){

        $input = $request->all();
        $hards= Hardware::findOrFail($id);
        $hards->update($input);
        return response()->json([
            'success' => true,
            'message' => 'Hardware Updated'
        ]);
        
    }
   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hard = Hardware::FindOrFail($id);
        $valor = '';
        $valor2= '';
        if($hard->is_active == 1){
            $valor = '0';
        }else if($hard->is_active==0){
            $valor= '1';
            
        }
        return $valor;

        

        if($hard->is_deleted == 1){
            $valor2 = '0';
        }else if($hard->is_deleted==0){
            $valor2= '1';
            
        }
        return $valor2;


        $hard->is_active = $valor;
       dd( $hard->is_deleted= $valor2);
        $hard->save();
        


        
    }

    public function apiHardware(){
        $hard = Hardware::orderBy('id','DESC')->get();
        
        return Datatables::of($hard)
            ->addColumn('action',function($hard){
                if($hard->is_active == 1){
                    $boton['text'] = 'Desactivar';
                    $boton['class'] = 'btn-danger';
                }else{
                    $boton['text'] = 'Activar';
                    $boton['class'] = 'btn-primary';
                }

                return '<td width="10px">
                <button  class="btn btn-success btn-sm" 
                    onclick="editForm('. $hard->id .')">
                    <i class="fa fa-pencil-square-o"></i> Editar</button>
              </td>' .
              '<td width="10px">
               <button class="btn '.$boton['class'].' btn-sm" href="#"
               onclick="deleteData('. $hard->id .')">
                <i class="fa fa-trash"></i> 
              '.$boton['text'].'</button>  
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
