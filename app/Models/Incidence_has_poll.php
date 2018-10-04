<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Incidence_has_poll extends Model
{
    protected $table='incidence_has_poll';

    //protected $primaryKey='ncidence_has_poll';

    protected $fillable = [
        "incidence_id", "poll_id", "user_id","question_id","response_id"
    ];

    public function preguntas(){
    	return $this->belongsTo(Question::class,'question_id');
    }
    
    public function respuestas(){
    	return $this->belongsTo(Response::class,'response_id');
    }
}
