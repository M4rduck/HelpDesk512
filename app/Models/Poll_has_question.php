<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll_has_question extends Model
{
    protected $table='poll_has_question';

    //protected $primaryKey='idpoll_has_question';

    protected $fillable = [
        "question_id", "poll_id"
    ];

    public function preguntas(){
    	return $this->belongsTo(Question::class,'question_id');
    }
}
