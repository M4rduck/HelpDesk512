<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $enterprise_id
 * @property int $visible
 * @property string $number
 * @property string $type
 * @property string $created_at
 * @property string $updated_at
 * @property Enterprise $enterprise
 */
class Phone extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'phone';

    /**
     * @var array
     */
    protected $fillable = ['enterprise_id', 'visible', 'number', 'type', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }
}
