<?php

namespace App\Http\Controllers\Incidence;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Incidence\Tracing;
use App\User;
use DB;

class TracingController extends Controller{

    public function store (Request $request){
        dd($request->all());

        $tracing= new Tracing;
       
        /*$tracing->id_incidence= $request->,
        'id_agent',
        'id_user',
        'comment'*/
    }

}