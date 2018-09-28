<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $visible
 * @property int $order
 * @property string $name
 * @property string $prefix
 * @property string $created_at
 * @property string $updated_at
 * @property State[] $states
 */
class Country extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'country';

    /**
     * @var array
     */
    protected $fillable = ['visible', 'order', 'name', 'prefix'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function states()
    {
        return $this->hasMany(State::class, 'country_ud');
    }
}
