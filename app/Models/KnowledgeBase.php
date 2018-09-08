<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

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
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'knowledgebase';

    /**
     * @var array
     */
    protected $fillable = ['category_id', 'score', 'name', 'solution', 'sw_faq', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_has_knowledgebase');
    }
}
