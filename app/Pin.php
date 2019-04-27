<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pin extends Model
{
    protected $fillable = [
        'component_id',
        'image',
        'A',
        'B',


    ];
}
