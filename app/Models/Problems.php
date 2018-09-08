<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $descritpion
 * @property int $is_active
 * @property int $is_deleted
 * @property string $created_at
 * @property string $updated_at
 * @property Hardware[] $hardware
 * @property Item[] $items
 * @property Software[] $software
 * @property Solicitude[] $solicitudes
 */
class Problems extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'descritpion', 'is_active', 'is_deleted', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function hardware()
    {
        return $this->belongsToMany(Hardware::class, 'hardware_has_problems', 'problems_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items()
    {
        return $this->belongsToMany(Item::class, 'item_has_problems', 'problems_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function software()
    {
        return $this->belongsToMany(Software::class, 'software_has_problems', 'problems_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function solicitudes()
    {
        return $this->belongsToMany(Solicitude::class, 'solicitude_has_problems', 'problems_id');
    }
}
