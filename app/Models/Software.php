<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $descritpion
 * @property string $serial
 * @property string $license
 * @property string $editor
 * @property string $versions
 * @property int $is_active
 * @property int $is_deleted
 * @property string $created_at
 * @property string $update_at
 * @property int $category_id
 * @property Category[] $category
 */
class Software extends Model
{
    /**
     * @var array
     */
    protected $table = 'software';
    protected $fillable = ['name', 'descritpion', 'serial', 'license', 'editor', 'versions', 'is_active', 'is_deleted','created_at'. 'update_at','category_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    

   

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
  

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'id');
    }
}
