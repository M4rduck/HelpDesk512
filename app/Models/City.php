<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $state_id
 * @property int $visible
 * @property int $order
 * @property string $name
 * @property string $prefix
 * @property string $created_at
 * @property string $updated_at
 * @property State $state
 * @property Enterprise[] $enterprises
 */
class City extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'city';

    /**
     * @var array
     */
    protected $fillable = ['state_id', 'visible', 'order', 'name', 'prefix'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function enterprises()
    {
        return $this->belongsToMany(Enterprise::class, 'city_has_enterprise');
    }
}
