<?php

namespace App\Models\Incidence;

use Illuminate\Database\Eloquent\Model;

class Solicitude extends Model
{
    /**
     * Campos que se van a utilizar en la BD.
     *
     * @var array
     */
    protected $fillable = [
        'id_area',
        'title',
        'description',
    ];
}
