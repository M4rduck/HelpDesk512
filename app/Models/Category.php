<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $level
 * @property string $created_at
 * @property string $updated_at
 * @property Knowledgebase[] $knowledgebases
 */
class Category extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var array
     */
    protected $fillable = ['name', 'category_id', 'created_at', 'updated_at','description','sw_main'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function knowledgebases()
    {
        return $this->hasMany(KnowledgeBase::class);
    }
}
