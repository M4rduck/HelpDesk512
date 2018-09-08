<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $descritpion
 * @property string $serial
 * @property int $is_active
 * @property int $is_deleted
 * @property string $created_at
 * @property string $updated_at
 * @property Problem[] $problems
 */
class Hardware extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'descritpion', 'serial', 'is_active', 'is_deleted', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function problems()
    {
        return $this->belongsToMany(Problems::class, 'hardware_has_problems', 'hardware_id', 'problems_id');
    }
}
