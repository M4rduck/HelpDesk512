<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $area_id
 * @property string $title
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property Area $area
 * @property Incidence[] $incidences
 * @property Poll[] $polls
 * @property Problem[] $problems
 */
class Solicitude extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'solicitude';

    /**
     * @var array
     */
    protected $fillable = ['area_id', 'title', 'description', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incidences()
    {
        return $this->hasMany('App\Models\Incidence');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function polls()
    {
        return $this->belongsToMany(Poll::class, 'solicitude_has_poll');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function problems()
    {
        return $this->belongsToMany(Problems::class, 'solicitude_has_problems', 'solicitude_id', 'problems_id');
    }
}
