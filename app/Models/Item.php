<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $descritpion
 * @property int $is_active
 * @property int $is_deleted
 * @property string $created_at
 * @property string $updated_at
 * @property Problem[] $problems
 */
class Item extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'item';

    /**
     * @var array
     */
    protected $fillable = ['name', 'descritpion', 'is_active', 'is_deleted', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function problems()
    {
        return $this->belongsToMany(Problems::class, 'item_has_problems', 'item_id', 'problems_id');
    }
}
