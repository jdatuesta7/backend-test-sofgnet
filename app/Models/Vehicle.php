<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = ['description', 'year', 'make', 'capacity', 'active'];

    public function drivers()
    {
        return $this->belongsToMany(Driver::class)
            ->withPivot('id', 'description', 'driver_id', 'vehicle_id', 'active');;
    }
}
