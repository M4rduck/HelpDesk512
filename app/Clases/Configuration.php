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

    /*
     * Convert the field from a string to an array
     *
     * @params FormularioCampo $campo
     * @return Array
     */
    static function createOptions($campo)
    {
        $opciones = [];
        // Las opciones vienen en la siguiente forma: campo, valor, campo, valor, campo, valor...
        $opcionesQuery = explode(',', $campo->pivot->opciones);
        if (count($opcionesQuery) > 1) {
            for ($i = 0; $i < count($opcionesQuery); $i++) {
                if ($i % 2 === 0) {
                    $opciones[$opcionesQuery[$i]] = $opcionesQuery[($i + 1)];
                }
            }
        }

        return $opciones;
    }

    /**
     * Convert the field from a string to an array, execute a consult in database and return an array or extract the value from the model if isn't a query
     *
     * @param $campo
     * @return array
     */
    static function createValue($campo, $datos = null)
    {
        switch ($campo->pivot->sw_query) {
            //Extract the value from the model
            case 0:
                $valor = $campo->pivot->valor;
                break;

            //Execute a consult in database and return an array
            case 1:
                $resultados = DB::select(DB::raw($campo->pivot->valor));
                foreach ($resultados as $resultado) {
                    $arrayResultado[$resultado->id] = $resultado->opcion;
                }
                $valor = $arrayResultado;
                break;

            //Convert the field from a string to an array
            case 2:
                $valor = explode(',', $campo->pivot->valor);
                break;

            //Variable from view
            case 3:
                $variables = DB::table('campo_sub_seccion_variables as CSV')
                    ->join('variables as V', 'CSV.id_variable', '=', 'V.id')
                    ->where([['id_campo', $campo->pivot->id_campo],
                        ['id_sub_seccion', $campo->pivot->id_sub_seccion]
                    ])
                    ->orderBy('orden_concatenar')
                    ->get(['id_variable', 'atributo', 'sw_method', 'nombre', 'concatenar', 'sw_model', 'parametros']);

                //Identifica la cantidad de variables
                if ($variables->count() === 1) {
                    $valor = self::identifyVariableType($variables->first(), $datos);
                } else {
                    $valor = '';
                    foreach ($variables as $variable) {
                        if ($variable->concatenar === 1) {
                            if (empty($valor)) {
                                $valor = self::identifyAttributeType(${$variable->nombre} = isset($datos) ? $datos[$variable->nombre] : null, $variable);
                            } else {
                                $valor = self::identifyAttributeType($valor, $variable);
                            }
                        } else {
                            $valor .= ' ' . self::identifyVariableType($variable, $datos);
                        }
                    }
                }

                break;
        }

        return $valor;
    }

    /**
     * Identify the type of the variable 0 = unique value, 1 = model or object, 2 = array
     *
     * @param $variable
     * @return String
     */
    public static function identifyVariableType($variable, $datos = null)
    {
        switch ($variable->sw_model) {
            case 0:
                //Obtiene el valor único de la variable
                $valor = isset($datos) ? $datos[$variable->nombre] : null;
                break;

            case 1:
                //Obtiene el valor del objeto
                $valor = self::identifyAttributeType(${$variable->nombre} = isset($datos) ? $datos[$variable->nombre] : null, $variable);
                break;

            case 2:
                $valor = ${$variable->nombre}[0];
                break;
        }
    }
}