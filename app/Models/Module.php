<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $software_id
 * @property string $name
 * @property string $descritpion
 * @property string $created_at
 * @property string $updated_at
 * @property Software $software
 */
class Module extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'module';

    /**
     * @var array
     */
    protected $fillable = ['software_id', 'name', 'descritpion', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function software()
    {
        return $this->belongsTo(Software::class);
    }
}
