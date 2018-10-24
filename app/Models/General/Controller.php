<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Controller extends Model
{
    protected $table = 'controller';

    protected $fillable = [
        'name',
        'containerName',
        'prefix',
        'status'
    ];

    protected $guarded = [];

    public function methods(){
        return $this->hasMany(Method::class, 'controller_id');
    }

    public function variables(){
        return $this->hasMany(Variable::class, 'controller_id');
    }
}
