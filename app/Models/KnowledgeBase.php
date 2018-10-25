<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Category;
use \Conner\Tagging\Taggable;
use Overtrue\LaravelFollow\Traits\CanBeLiked;

/**
 * @property int $id
 * @property int $category_id
 * @property int $score
 * @property string $name
 * @property string $solution
 * @property int $sw_faq
 * @property string $created_at
 * @property string $updated_at
 * @property Category $category
 * @property User[] $users
 */
class KnowledgeBase extends Model
{
    
    use Taggable,CanBeLiked;
    
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'knowledgebase';

    /**
     * @var array
     */
    protected $fillable = ['view', 'name', 'solution', 'sw_faq', 'description', 'category_id', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_has_knowledgebase','knowledgebase_id','user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Scope

    public function scopeName($query, $name)
    {
        if($name)
        return $query->where('name', 'LIKE', "%$name%");
    }
}
