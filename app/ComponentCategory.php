<?php

namespace App;

use App\ComponentCategoryImage;
use Illuminate\Database\Eloquent\Model;

class ComponentCategory extends Model
{
    public static function getCategoryImage($slug)
    {
        $ComponentCategoryImage = ComponentCategoryImage::where('name', $slug)->first();
        return $ComponentCategoryImage->image_path;
    }

    public static function getCategorycontext($slug)
    {
        $ComponentCategoryImage = ComponentCategoryImage::where('name', $slug)->first();
        return $ComponentCategoryImage->context;
    }

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
