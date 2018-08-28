<?php

namespace App\Models\Incidence;

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
        'id_contact',
        'theme',
        'id_incidence_state',
        'priority',
        'description',
        'evidence_route',
        'label'
    ];

    //one to one relathionship with incidence states
    public function incidenceState()
    {
        return $this->belongsTo('App\Models\Incidence\IncidenceState', 'id_incidence_state', 'id');
    }

    //one to one relathionship with agent
    public function agent()
    {
        return $this->belongsTo('App\User', 'id_agent', 'id');
    }

    //one to one relathionship with contact
    public function contact()
    {
        return $this->belongsTo('App\User', 'id_contact', 'id');
    }

}
