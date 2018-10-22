<?php

namespace App\Models\Inventario;

use Illuminate\Database\Eloquent\Model;

class Hardware extends Model
{
    protected $table = 'hardware';

    protected $fillable = [
        'name',
        'description',
        'serial',
        'is_active',
        'is_deleted',
        'create_at',
        'update_at',
        'type_hardware',
        'maker',
        'state',
        'location',
        'model',
        'technical_in_charge',
        'num_contact'
    ];

    protected $guarded = [];

}
