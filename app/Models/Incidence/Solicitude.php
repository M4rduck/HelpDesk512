<?php

namespace App\Models\Incidence;

use Illuminate\Database\Eloquent\Model;
use App\Models\Form;
use App\Models\Poll;

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

    public function forms()
    {
        return $this->belongsToMany(Form::class, 'solicitude_has_forms')->withPivot('is_active');
    }

    public function incidence()
    {
        return $this->hasMany(Incidence::class, 'id_solicitude', 'id');
    }

    public function polls()
    {
        return $this->belongsToMany(Poll::class, 'solicitude_has_poll')
            ->withPivot('is_active');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'solicitude_has_categories');
    }

}
