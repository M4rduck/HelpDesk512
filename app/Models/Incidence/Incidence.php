<?php

namespace App\Models\Incidence;

use Illuminate\Database\Eloquent\Model;

class Incidence extends Model
{
    protected $table = 'incidence';

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

    public function incidenceState()
    {
        return $this->belongsTo('App\Models\Incidence\IncidenceState', 'id_incidence_state', 'id');
    }

    public function agent()
    {
        return $this->belongsTo('App\User', 'id_agent', 'id');
    }

    public function contact()
    {
        return $this->belongsTo('App\User', 'id_contact', 'id');
    }

    public function solicitude()
    {
        return $this->belongsTo('App\Models\Incidence\Solicitude', 'id_solicitude', 'id');
    }

    public function tracings()
    {
        return $this->hasMany('App\Models\Incidence\Tracing', 'id_incidence', 'id');
    }

}
