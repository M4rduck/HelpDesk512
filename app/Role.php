<?php

namespace App;

use Caffeinated\Shinobi\Traits\ShinobiTrait;

class Role 
{
    use  ShinobiTrait;
    
    protected $fillable=['name','display_name','description']; 
}
