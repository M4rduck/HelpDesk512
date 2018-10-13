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
 * @property Collection $fieldSubSections
 * @property Collection $sectionSubSections
 */
class SubSection extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'sub_section';

    /**
     * @var array
     */
    protected $fillable = ['name', 'description', 'is_deleted', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fieldSubSections()
    {
        return $this->belongsToMany(Field::class, 'field_sub_section')->withPivot('order', 'value', 'options');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function sectionSubSections()
    {
        return $this->belongsToMany(Section::class, 'section_sub_section');
    }
}
