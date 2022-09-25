<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['route_id', 'week_num', 'from', 'to'];

    public function route()
    {
        return $this->belongsTo(DriverVehicle::class);
    }
}
