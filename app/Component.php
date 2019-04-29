<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{

    public static function boldName($name)
    {
        $first_word = explode(' ',trim($name))[0];
        $new_str =  str_replace($first_word,"",$name);
        $new_str = '<span class="producttitle-bold">'.$first_word.'</span>' . $new_str;
        return $new_str;
    }

    public function category()
    {
        return $this->belongsTo('App\ComponentCategory', 'component_category_id');
    }
    public function certification()
    {
        return $this->hasOne('App\Certification');
    }

    public function images()
    {
        return $this->hasMany('App\ComponentImage');
    }

    public function core_data()
    {
        return $this->hasOne('App\CoreData');
    }

    public function dimention()
    {
        return $this->hasOne('App\Dimention');
    }

    public function pin()
    {
        return $this->hasOne('App\Pin');
    }

    public function further_specification()
    {
        return $this->hasOne('App\FurtherSpecification');
    }

    public function mounting_parameter()
    {
        return $this->hasOne('App\MountingParameter');
    }

    public function drive_systems()
    {
        return $this->belongsToMany('App\DriveSystem');
    }

}

