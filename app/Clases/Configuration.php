<?php
/**
 * Created by PhpStorm.
 * User: marduck
 * Date: 8/07/18
 * Time: 02:12 AM
 */

namespace App\Clases;


use App\Models\General\Controller;
use Illuminate\Support\Facades\Route;

class Configuration
{
    static function routes($groupRoute, $status){
        $controladores = Controller::with('methods')
            ->where([['status', $status], ["prefix", $groupRoute]])->get();

        foreach ($controladores as $controlador) {
            $contenedor = (($controlador->containerName != "") ? $controlador->containerName . "\\" : "") . $controlador->name;
            foreach ($controlador->methods as $metodo) {
                $contenedor2 = $contenedor .(($metodo->name_function != "") ? "@" . $metodo->name_function : "");

                if($metodo->verbName == 'match'){
                    Route::match(['GET', 'POST'], $contenedor2);
                }else{
                    if($metodo->name == ""){
                        Route::{$metodo->verbName}($metodo->url, $contenedor2);
                    }else{
                        Route::{$metodo->verbName}($metodo->url, $contenedor2)->name($metodo->name);
                    }
                }
            }
        }
    }
}