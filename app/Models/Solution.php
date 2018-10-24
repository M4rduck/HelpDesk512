<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $table = 'solution';

    protected $fillable = ['incidence_id','description','sw_knowledgebase'];


    

}
