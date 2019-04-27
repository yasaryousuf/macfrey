<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MountingParameter extends Model
{
    protected $fillable = [
        'component_id',
        'brake',
        'installation_widths',
        'max_housing_diameter',
        'cabling_route',
        'cable_length',
        'gearshift',
        'spoke_specification',

        'tire_specification',
        'induction_distance',
        'mounting_position',
        'connector_size',
        'dimensions',
        'com_protocol',
        'e_brake_level',
        'bb_width',
        'holder',

    ];
}
