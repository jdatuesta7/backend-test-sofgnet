<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $guarded = ['id', 'active'];

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class)
            ->withPivot('id', 'description', 'driver_id', 'vehicle_id', 'active');
    }

}
