<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $extension
 * @property string $email
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property Enterprise[] $enterprises
 * @property Solicitude[] $solicitudes
 */
class Area extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'area';

    /**
     * @var array
     */
    protected $fillable = ['name', 'extension', 'email', 'description', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function eterprises()
    {
        return $this->belonsToMany(Enterprise::class, 'enterprise_has_area');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function solicitudes()
    {
        return $this->hasMany(Solicitude::class);
    }
}
