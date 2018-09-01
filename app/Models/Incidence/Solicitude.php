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
        'id_contact',
        'title',
        'description',
        'evidence_route',
    ];

    public function contact()
    {
        return $this->belongsTo('App\User', 'id_contact', 'id');
    }

    public function incidence()
    {
        return $this->hasMany('App\Models\Incidence\Incidence', 'id_solicitude', 'id');
    }
}
