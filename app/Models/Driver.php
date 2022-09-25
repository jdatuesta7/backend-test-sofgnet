<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    const REMOVE = 0;
    const PUBLISH = 1;

    protected $guarded = ['id', 'active'];

    public $timestamps = false;

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class)
            ->using(DriverVehicle::class)
            ->withPivot('id', 'description', 'driver_id', 'vehicle_id', 'active');
    }
}
