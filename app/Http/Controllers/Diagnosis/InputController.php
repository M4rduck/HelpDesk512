<?php

namespace App\Http\Controllers\Diagnosis;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\TypeInput;

class InputController extends Controller
{
    public function index(){
        try{
            $inputs = TypeInput::all();
            $html = View('diagnosis.parameterization.partials.input')->with('inputs', $inputs)->render();
        }catch(QueryException $queryException){
            return response()->json(['success' => true, 'error' => true, 'title' => '', 'msg' => ''.$queryException->getCode()]);
        }        
        return response()->json(['success' => true, 'error' => false, 'html' => $html]);
    }
}
