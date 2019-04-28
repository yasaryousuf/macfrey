<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComponentCategory extends Model
{

    public function parent()
    {
        return $this->belongsTo('App\ComponentCategory', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\ComponentCategory', 'parent_id');
    }

    public function components()
    {
        return $this->hasMany('App\Component', 'component_category_id');
    }
}
