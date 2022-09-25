<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(DriverSeeder::class);
        $this->call(VehicleSeeder::class);
        $this->call(DriverVehicleSeeder::class);
        $this->call(ScheduleSeeder::class);
    }
}
