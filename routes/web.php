<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'general','middleware' => ['auth']], function (){
    \App\Clases\Configuration::routes('general', 1);
});

Route::group(['prefix' => 'incidence','middleware' => ['auth']], function (){
    \App\Clases\Configuration::routes('incidence', 1);
});