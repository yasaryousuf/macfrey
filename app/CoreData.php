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
        'suitability',
        'com_protocol',
        'display_type',
        'display',
        'support_modes',
        'nominal_capacity',
        'resolution',
        'input_voltage',
        'output_voltage',
        'type',
        'signals',
        'current_limit',
        'low_voltage_protection',
        'wire_specification',
        'teeth_number',
        'chain_line',
        'thickness',
        'chain_wheel_material',
        'frame_materail',
        'cover_material',
        'energy_content',
        'e_brake',
        'gearsensor_function',
        'light_drive_capacity',
    ];
}
