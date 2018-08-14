<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incidence extends Model
{
    /**
     * Campos que se van a utilizar en la BD.
     *
     * @var array
     */
    protected $fillable = ['contacto',
        'tema',
        'estado',
        'prioridad',
        'agente',
        'descripcion',
        'ruta_evidencia',
        'etiquetas'
    ];
}
