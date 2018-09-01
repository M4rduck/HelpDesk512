<?php

namespace App\Models\Incidence;

use Illuminate\Database\Eloquent\Model;

class Tracing extends Model
{
    /**
     * Campos que se van a utilizar en la BD.
     *
     * @var array
     */
    protected $fillable = [
        'id_incidence',
        'id_agent',
        'id_user',
        'comment'
    ];

    public function incidence()
    {
        return $this->belongsTo('App\Models\Incidence\Incidence', 'id_incidence', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id');
    }

    public function agent()
    {
        return $this->belongsTo('App\User', 'id_agent', 'id');
    }

}
