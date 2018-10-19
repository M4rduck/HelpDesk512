<?php

namespace App\Models\Incidence;

use Illuminate\Database\Eloquent\Model;

class Solicitude extends Model
{
    protected $table = 'solicitude';
    
    /**
     * Campos que se van a utilizar en la BD.
     *
     * @var array
     */
    protected $fillable = [
        'area_id',
        'title',
        'description',
        'evidence_route',
    ];

    public function area()
    {
        return $this->belongsTo('App\Models\Area', 'area_id', 'id');
    }

    public function incidence()
    {
        return $this->hasMany('App\Models\Incidence\Incidence', 'id_solicitude', 'id');
    }

    public function polls()
    {
        return $this->belongsToMany('App\Models\Poll', 'solicitude_has_poll')
            ->withPivot('is_active');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'solicitude_has_categories');
    }

}
