<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncidenceState extends Model
{
    /**
     * Campos que se van a utilizar en la BD.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];
}
