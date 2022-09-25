<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    const REMOVE = 0;
    const PUBLISH = 1;

    protected $fillable = ['route_id', 'week_num', 'from', 'to'];

    public $timestamps = false;

    public function route()
    {
        return $this->belongsTo(DriverVehicle::class);
    }
}
