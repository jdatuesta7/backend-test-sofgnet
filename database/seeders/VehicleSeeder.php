<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vehicles = [
            1 => ["transportes masivos de personas", 2018, 4, 120],
            2 => ["transportes de maquinaria pesada", 2014, 3, 3],
            3 => ["transportes VIP", 2022, 8, 12]
        ];

        foreach ($vehicles as $vehicle) {
            Vehicle::create([
                'description' => $vehicle[0],
                'year' => $vehicle[1],
                'make' => $vehicle[2],
                'capacity' => $vehicle[3],
            ]);
        }
    }
}
