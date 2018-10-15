<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $is_deleted
 * @property string $created_at
 * @property string $updated_at
 * @property FormSection[] $formSections
 */
class Form extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'form';

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'is_deleted', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function formSections()
    {
        return $this->hasMany('App\FormSection');
    }
}
