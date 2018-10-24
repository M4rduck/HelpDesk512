<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Incidence\Incidence;

class Solution extends Model
{
    protected $table = 'solution';

    protected $fillable = ['incidence_id','description','sw_knowledgebase'];

    public function incidence()
    {
        return $this->belongsTo(Incidence::class,'incidence_id');
    }
    

}
