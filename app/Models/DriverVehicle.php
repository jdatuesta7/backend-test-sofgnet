<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class DriverVehicle extends Pivot
{
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
