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
    protected $fillable = [
        'id_agent',
        'id_solicitude',
        'contact',
        'theme',
        'id_incidenceState',
        'priority',
        'description',
        'evidence_route',
        'label'
    ];

    //one to one relathionship with incidence states
    public function incidenceState(){
        return $this->hasOne('App\IncidenceState', 'incidenceState_id');
    }

}
