<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $input_type_id
 * @property int $is_deleted
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property TypeInput $typeInput
 * @property Collection $fieldSubSections
 */
class Field extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'field';

    /**
     * @var array
     */
    protected $fillable = ['input_type_id', 'is_deleted', 'name', 'description', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function typeInput()
    {
        return $this->belongsTo(TypeInput::class, 'input_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function fieldSubSections()
    {
        return $this->belongsToMany(SubSection::class, 'field_sub_section')->withPivot('order', 'value', 'options');
    }
}
