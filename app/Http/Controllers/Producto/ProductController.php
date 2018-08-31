<?php

namespace App\Http\Controllers\Producto;

use App\Models\General\Method;
use App\Models\General\Module;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index(){

        return view('product.index');
    }



}