<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/register',function(){
    return redirect('login');
 })->name('register')->middleware('guest');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'general','middleware' => ['auth']], function (){
    \App\Clases\Configuration::routes('general', 1);
});

Route::group(['prefix' => 'reporte','middleware' => ['auth']], function (){
    \App\Clases\Configuration::routes('reporte', 1);
});

Route::group(['prefix' => 'incidence','middleware' => ['auth']], function (){
    \App\Clases\Configuration::routes('incidence', 1);
});

Route::group(['prefix' => 'admin','middleware' => ['auth']], function (){
    \App\Clases\Configuration::routes('admin', 1);
});

Route::group(['prefix' => 'baseConocimiento','middleware' => ['auth']], function (){
    \App\Clases\Configuration::routes('baseConocimiento', 1);
});

Route::group(['prefix' => 'area-empresa','middleware' => ['auth']], function (){
    \App\Clases\Configuration::routes('area-empresa', 1);
});

Route::group(['prefix' => 'producto','middleware' => ['auth']], function (){
    \App\Clases\Configuration::routes('producto', 1);
});

Route::group(['prefix' => 'diagnosis','middleware' => ['auth']], function (){
    \App\Clases\Configuration::routes('diagnosis', 1);
});

Route::group(['prefix' => 'input','middleware' => ['auth']], function (){
    \App\Clases\Configuration::routes('input', 1);
});

Route::group(['prefix' => 'admin','middleware' => ['auth']], function (){
    \App\Clases\Configuration::routes('admin', 1);
});

Route::group(['prefix' => 'speciality','middleware' => ['auth']], function (){
    \App\Clases\Configuration::routes('speciality', 1);
});

Route::group(['prefix' => 'encuesta','middleware' => ['auth']], function (){
    \App\Clases\Configuration::routes('encuesta', 1);
});

Route::group(['prefix' => 'baseConocimiento','middleware' => ['auth']], function (){
    \App\Clases\Configuration::routes('baseConocimiento', 1);
});
