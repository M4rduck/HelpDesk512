<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $business_name
 * @property boolean $sw_active
 * @property string $created_at
 * @property string $updated_at
 * @property Area[] $areas
 * @property City[] $cities
 * @property Phone[] $phones
 */
class Enterprise extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'enterprise';

    /**
     * @var array
     */
    protected $fillable = ['business_name', 'address', 'legal_representative', 'sw_active'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function areas()
    {
        return $this->belongsToMany(Area::class, 'enterprise_has_area');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function city()
    {
        return $this->belongsToMany(City::class, 'city_has_enterprise');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phones()
    {
        return $this->hasMany(Phone::class);
    }
}
