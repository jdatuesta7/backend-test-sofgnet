<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Seeder;

class DriverVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $drivers = Driver::all();

        foreach ($drivers as $driver) {
            $driver->vehicles()->attach([
                1 => ['description' => "se ha realizado una ruta de transporte 1"],
                2 => ['description' => "se ha realizado una ruta de transporte 2"],
                3 => ['description' => "se ha realizado una ruta de transporte 3"],
            ]);
        }
    }
}
