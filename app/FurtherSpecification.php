<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FurtherSpecification extends Model
{
    protected $fillable = [
        'component_id',
        'speed_detection_signal',
        'reduction_ratio',
        'magnet_poles',

    ];
}
