<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoreData extends Model
{
    protected $fillable = [
        'component_id',
        'position',
        'wheel_diameter',
        'construction',
        'rated_voltage',
        'n0',
        'rated_power',
        'nT',
        'max_torque',
        'efficiency',
        'color',
        'weight',
        'noise_grade',
        'operating_temperature',
    ];
}
