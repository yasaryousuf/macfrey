<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriveSystemCategory extends Model
{
    public function drive_systems()
    {
        return $this->hasMany('App\DriveSystem');
    }
}
