<?php

namespace App\Models\Incidence;

use Illuminate\Database\Eloquent\Model;

class IncidenceState extends Model
{
    protected $table = 'incidence_state';

    /**
     * Campos que se van a utilizar en la BD.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];

    public function incidence()
    {
        return $this->hasOne('App\Models\Incidence\Incidence', 'id_incidence_state', 'id');
    }
}
