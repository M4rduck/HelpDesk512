<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidenceState extends Model
{
    protected $table='incidence_state';

    protected $primaryKey='id';

    protected $fillable = [
        "name" , "description"
    ];
}
