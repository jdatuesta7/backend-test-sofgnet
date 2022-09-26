<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DriverVehicle extends Pivot
{
    const REMOVE = 0;
    const PUBLISH = 1;

    protected $with = ['driver', 'vehicle'];

    public $incrementing = true;

    public $timestamps = false;

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
    
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
