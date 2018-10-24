<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Incidence extends Model
{
    protected $table='incidence';

    protected $primaryKey='id';

    protected $fillable = [
        "description" , "id_agent", "created_at" , "id_incidence_state" , "theme"
    ];

    public function usuario(){
    	return $this->belongsTo(User::class,'id_agent');
    }

    public function estado () {
    	return $this->belongsTo(IncidenceState::class, 'id_incidence_state');
    }
}
