<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Speciality;
use App\User;

class SpecialityController extends Controller
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
    public function index()
    {
        
        return view('admin.speciality.index');   
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,  [
            'name' => 'required'
        ]);
        $input = $request->all();
        $specility = Speciality::create($input);
        
        return response()->json([
        'success' => true,
        'message' => 'Speciality Created'
        ]); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $specility = Speciality::findOrFail($id);
        return  array ("specility"=>$specility);
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
        $this->validate($request,  [
            'name' => 'required'
        ]);

     $input = $request->all();
     $specility= Speciality::findOrFail($id);
     $specility->update($input);

    return response()->json([
        'success' => true,
        'message' => 'Speciality Updated'
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
        $specility = Speciality::whereId($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Speciality Delete'
        ]); 
    }

    public function apiSpeciality()
    {
        $specility=Speciality::all();
        
        return Datatables::of($specility)
            ->addColumn('action', function($specility){
                return '<td width="10px">
                            <button  class="btn btn-success btn-sm" 
                                onclick="editForm('. $specility->id .')">
                                <i class="fa fa-pencil-square-o"></i> Edit</button>
                          </td>' .
                          '<td width="10px">
                           <button class="btn btn-danger btn-sm" href="#"
                           onclick="deleteData('. $specility->id .')">
                            <i class="fa fa-trash"></i> 
                          Delete</button>  
                          </td>';
            })->make(true); 
    }
}
