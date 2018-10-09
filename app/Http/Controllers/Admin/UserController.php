<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Mockery\Exception;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Caffeinated\Shinobi\Models\Role;
use App\Models\Speciality;
use App\User;

class UserController extends Controller
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
        $roles = Role::pluck('name', 'id');
        $speciality = Speciality::pluck('name','id');
        return view('admin.users.index')
                ->with(['roles'=>$roles,'speciality'=>$speciality]);     
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
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
         ]);
        $input = $request->all();
        $users = User::create($input);
        $users->roles()->sync($request->get('roles'));
        $users->speciality()->sync($request->get('speciality'));
        return response()->json([
            'success' => true,
            'message' => 'User Created'
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
        $users = User::with('roles','speciality')->find($id);
        return  array ("user"=>$users);
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
                'name' => 'required',
                'email' => 'required',
                'password' => ''
        ]);

         $input = $request->all();
         $users= User::findOrFail($id);

         $users->update($input);

        $users->roles()->sync($request->get('roles'));
        $users->speciality()->sync($request->get('speciality'));
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
        $users = User::whereId($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'User Delete'
        ]); 
        
    }

    public function apiUsers()
    {
        $users=User::with('speciality')->get();
        
        
        
        return Datatables::of($users)
            ->addColumn('action', function($users){
                return '<td width="10px">
                            <button  class="btn btn-success btn-sm" 
                                onclick="editForm('. $users->id .')">
                                <i class="fa fa-pencil-square-o"></i> Edit</button>
                          </td>' .
                          '<td width="10px">
                           <button class="btn btn-danger btn-sm" href="#"
                           onclick="deleteData('. $users->id .')">
                            <i class="fa fa-trash"></i> 
                          Delete</button>  
                          </td>';
            })
            ->editColumn('edit', function($users){
                $specialitys = '';
                if($users->speciality->isNotEmpty()){
                    foreach($users->speciality as $speciality){
                        $specialitys.='<span class="label label-primary">'
                                    . $speciality->name .'</span>&nbsp;';
                                             
                    }
                }else{
                    $specialitys = '<span>User '.$users->name.' has not specialitys</span>';
                }
                return $specialitys;
                
            })
            ->rawColumns(['edit' => 'edit', 'action' => 'action'])
            ->make(true); 
    }
}
