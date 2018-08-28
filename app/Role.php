<?php

namespace App;

use Caffeinated\Shinobi\Traits\ShinobiTrait;

class Role extends EntrustRole
{
    protected $fillable=['name','display_name','description']; 
}
