<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Models\Permission;
use App\User;

/**
 * @property Roles[] $roles
 */
class Permissions extends Permission
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'permission_role', 'permission_id', 'role_id');
    }
}
