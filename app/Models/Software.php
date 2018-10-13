<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $descritpion
 * @property string $serial
 * @property int $has_license
 * @property int $has_module
 * @property int $is_active
 * @property int $is_deleted
 * @property string $created_at
 * @property string $updated_at
 * @property Module[] $modules
 * @property Problem[] $problems
 */
class Software extends Model
{
    /**
     * @var array
     */
    protected $table = 'software';
    protected $fillable = ['name', 'descritpion', 'serial', 'has_license', 'has_module', 'is_active', 'is_deleted', 'created_at','updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function modules()
    {
        return $this->hasMany(Module::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function problems()
    {
        return $this->belongsToMany(Problems::class, 'software_has_problems', 'software_id', 'problems_id');
    }
}
