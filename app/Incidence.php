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
    protected $fillable = ['contact',
        'subject',
        'state',
        'priority',
        'type',
        'agent',
        'description',
        'file',
    ];

    //one to one relathionship with incidence states
    public function incidenceState(){
        return $this->hasOne('App\IncidenceState', 'incidenceState_id');
    }

}
