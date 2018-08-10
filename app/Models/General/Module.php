<?php

namespace App\Models\General;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $table = 'module';

    protected $fillable = [
        'method_id',
        'module_id',
        'order',
        'text',
        'icon',
        'icon_color',
        'label',
        'label_color',
        'main'
    ];

    protected $guarded = [];

    public function method(){
        return $this->belongsTo(Method::class, 'method_id');
    }

    public function module(){
        return $this->belongsTo(Module::class, 'module_id');
    }

    public function modules(){
        return $this->hasMany(Module::class, 'module_id');
    }
}
