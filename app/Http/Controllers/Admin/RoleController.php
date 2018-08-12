<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mockery\Exception;
use Yajra\DataTables\DataTables;
use App\Role;


class RoleController extends Controller
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
        
        return view('admin.roles.index');
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Role::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Role Created'
        ]);
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
        $roles = Role::findOrFail($id);
        return $roles;
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
         $roles = Role::findOrFail($id);

         $roles->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Contact Updated'
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
        $role = Role::whereId($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Rol Delete'
        ]); 
    }

    public function apiRoles()
    {
        $roles=Role::all();
        
        return Datatables::of($roles)
            ->addColumn('action', function($roles){
                return '<td width="10px">
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye"></i> View</button>
                          </td>' .
                          '<td width="10px">
                            <button  class="btn btn-success btn-sm" 
                                onclick="editForm('. $roles->id .')">
                                <i class="far fa-edit"></i> Edit</button>
                          </td>' .
                          '<td width="10px">
                           <button class="btn btn-danger btn-sm" href="#"
                           onclick="deleteData('. $roles->id .')">
                            <i class="fas fa-trash"></i> 
                          Delete</button>  
                          </td>';
            })->make(true); 
    }
}
