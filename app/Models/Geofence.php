<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Geofence extends Model
{
    protected $fillable = [
        'imeiNumber',
        'type',
        'center_latitude',
        'center_longitude',
        'radius',
        'coordinates',
    ];

    protected $casts = [
        'coordinates' => 'array',
    ];
}

