<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Caffeinated\Shinobi\Models\Permission;

class PermissionController extends Controller
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
        return view('admin.permissions.index');
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
        Permission::create($input);
        return response()->json([
            'success' => true,
            'message' => 'Permission Created'
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
        $permissions = Permission::findOrFail($id);
        return $permissions;
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
         $permissions = Permission::findOrFail($id);

         $permissions->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Permission Updated'
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
        $permissions = Permission::whereId($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Permission Delete'
        ]); 
    }

    public function apiPermissions()
    {
        $permissions=Permission::all();
        
        return Datatables::of($permissions)
            ->addColumn('action', function($permissions){
                return '<td width="10px">
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye"></i> View</button>
                          </td>' .
                          '<td width="10px">
                            <button  class="btn btn-success btn-sm" 
                                onclick="editForm('. $permissions->id .')">
                                <i class="far fa-edit"></i> Edit</button>
                          </td>' .
                          '<td width="10px">
                           <button class="btn btn-danger btn-sm" href="#"
                           onclick="deleteData('. $permissions->id .')">
                            <i class="fas fa-trash"></i> 
                          Delete</button>  
                          </td>';
            })->make(true); 
    }
}
