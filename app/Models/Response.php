<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property Incidence[] $incidences
 * @property Poll[] $polls
 * @property Question[] $questions
 */
class Response extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'response';

    /**
     * @var array
     */
    protected $fillable = ['description', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incidences()
    {
        return $this->hasMany('App\Models\Incidence', 'incidence_has_poll');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function polls()
    {
        return $this->belongsToMany(Poll::class, 'poll_has_response');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_has_response');
    }
}
