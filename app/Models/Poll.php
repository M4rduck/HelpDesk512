<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property Incidence[] $incidences
 * @property Question[] $questions
 * @property Response[] $responses
 * @property Solicitude[] $solicitudes
 */
class Poll extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'poll';

    /**
     * @var array
     */
    protected $fillable = ['title', 'description', 'created_at', 'updated_at'];

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
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'poll_has_question');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function responses()
    {
        return $this->belongsToMany(Response::class, 'poll_has_response');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function solicitudes()
    {
        return $this->belongsToMany(Solicitude::class, 'solicitude_has_poll');
    }
}
