<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'firstname', 
        'lastname', 
        'company', 
        'position',
        'email',
        'phone',
        'fax',
        'street',
        'zipcode',
        'city',
        'country',
        'comment',
        'type'
     ];
}
