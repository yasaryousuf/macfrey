<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriveSystem extends Model
{    
    protected $fillable = [
        'drive_system_category_id',
        'thumbnail_image',
        'image',
        'name',
        'slug',

    ];
    public function components()
    {
        return $this->belongsToMany('App\Component');
    }
    public function category()
    {
        return $this->belongsTo('App\ComponentCategory', 'component_category_id');
    }
}
