<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model
{
    protected $table = 'variable';

    protected $fillable = [
        'controller_id',
        'name',
        'value',
        'description'
    ];

    protected $guarded = [];

    public function controller(){
        return $this->belongsTo(Controller::class, 'controller_id');
    }
}
