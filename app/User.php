<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Speciality;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Overtrue\LaravelFollow\Traits\CanLike;

class User extends Authenticatable
{
    use Notifiable,ShinobiTrait,CanLike;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {   
    $this->attributes['password'] = bcrypt($password);
    }

    public function speciality()
    {
        return $this->belongsToMany(Speciality::class, 'user_has_speciality');
    }

}
