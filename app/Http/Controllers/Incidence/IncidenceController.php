<?php

namespace App\Http\Controllers\Incidence;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IncidenceController extends Controller
{
    public function index(){
        return view('incidence.index');
    }

    public function create(){
        return view('incidence.register');
    }

    public function store(Request $request){
        dd($request);
    }
}
