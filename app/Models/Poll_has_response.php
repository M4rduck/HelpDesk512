<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll_has_response extends Model
{
    protected $table='poll_has_response';

    //protected $primaryKey='idpoll_has_response';

    protected $fillable = [
        "response_id", "poll_id"
    ];

    public function respuestas(){
    	return $this->belongsTo(Response::class,'response_id');
    }
    
}
