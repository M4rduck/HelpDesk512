<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $country_ud
 * @property int $visible
 * @property int $order
 * @property string $name
 * @property string $prefix
 * @property string $created_at
 * @property string $updated_at
 * @property Country $country
 * @property City[] $cities
 */
class State extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'state';

    /**
     * @var array
     */
    protected $fillable = ['country_ud', 'visible', 'order', 'name', 'prefix'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_ud');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class, 'state_id');
    }
}
