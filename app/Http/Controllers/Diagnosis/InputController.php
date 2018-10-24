<?php

namespace App\Http\Controllers\Diagnosis;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\TypeInput;

class InputController extends Controller
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

    public function index(){
        try{
            $inputs = TypeInput::with('fields')->whereHas('fields', function($query){
                        $query->where('is_deleted', 0);
                      })->get();
            $html = View('diagnosis.parameterization.partials.input')->with('inputs', $inputs)->render();
        }catch(QueryException $queryException){
            return response()->json(['success' => true, 'error' => true, 'title' => '', 'msg' => 'Ha sucedido un error a la hora de cargar los campos'.$queryException->getMessage()]);
        }        
        return response()->json(['success' => true, 'error' => false, 'html' => $html]);
    }

    public function store(Request $request){
        parse_str($request->datos, $dataField);
        try{
            Field::create($dataField);
        }catch(QueryException $queryException){
            return response()->json(['success' => true, 'error' => true, 'title' => '', 'msg' => Lang::get('method/store.error_body', ['code' => $queryException->getCode()])]);
        }
        return response()->json(['success' => true, 'error' => false, 'title' => '', 'msg' => 'Relax?']);        
    }
}
