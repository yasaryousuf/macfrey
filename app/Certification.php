<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    protected $fillable = [
        'component_id',
        'ip',
        'certifications',
        'salt_spray_test_standard',

    ];

}
