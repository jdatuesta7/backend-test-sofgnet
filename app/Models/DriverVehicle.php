<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DriverVehicle extends Pivot
{
    const REMOVE = 0;
    const PUBLISH = 1;
    
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
