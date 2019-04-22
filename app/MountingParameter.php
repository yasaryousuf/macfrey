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
    ];
}
