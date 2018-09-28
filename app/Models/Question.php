<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $description
 * @property int $order
 * @property string $created_at
 * @property string $updated_at
 * @property Incidence[] $incidences
 * @property Poll[] $polls
 * @property Response[] $responses
 */
class Question extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'question';

    /**
     * @var array
     */
    protected $fillable = ['description', 'order', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function incidences()
    {
        return $this->belongsToMany('App\Models\Incidence', 'incidence_has_poll');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function polls()
    {
        return $this->belongsToMany(Poll::class, 'poll_has_question');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function responses()
    {
        return $this->belongsToMany(Response::class, 'question_has_response');
    }
}
