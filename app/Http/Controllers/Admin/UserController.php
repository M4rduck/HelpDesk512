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
        return view('admin.users.index')->with(['roles'=>$roles]);     
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
        $roles = Role::pluck('name', 'id');
        $users = User::findOrFail($id);
        
        return  array ("user"=>$users,"roles"=>$roles);
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
        $speciality = Speciality::pluck('name','<id></id>');
        $users=User::all();
        
        return Datatables::of($users,$speciality)
            ->with(['speciality'=>$speciality])
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
            })->make(true); 
    }
}
