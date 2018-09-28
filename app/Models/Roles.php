<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Caffeinated\Shinobi\Models\Role;
use App\User;

/**
 * @property Permissions[] $permissions
 * @property Users[] $users
 */
class Roles extends Role
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permissions::class, 'permission_role', 'role_id', 'permission_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'role_id', 'user_id');
    }
}
