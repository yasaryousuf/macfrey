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
        'bluetooth',
        'usb_charge',
        'usb_communication',
        'number_of_cells',
        'lighting_output_voltage',
        'walk_assistance',
        'speed_limit',
        'gearshift',
        'charging_time',
        'charging_cycles',
        'throttle_voltage_input',
        'pas_mode',
        'pin_surface_treatment',
        'minimum_distance',
        'maximum_distance',

    ];
}
