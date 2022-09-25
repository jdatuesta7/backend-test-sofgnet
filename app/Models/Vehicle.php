<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    const REMOVE = 0;
    const PUBLISH = 1;
    
    protected $fillable = ['description', 'year', 'make', 'capacity', 'active'];

    public $timestamps = false;

    public function drivers()
    {
        return $this->belongsToMany(Driver::class)
            ->withPivot('id', 'description', 'driver_id', 'vehicle_id', 'active');;
    }
}
