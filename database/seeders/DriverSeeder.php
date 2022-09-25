<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $drivers = [
            1 => ["Lopez", "Juan", "31588364", "1985-03-08", "Calle 10 - 5", "Barranquilla",
             "100453", "3106246128"],

            2 => ["Perez", "Jorge", "453135431", "1990-03-08", "Calle 40 - 5", "Bogotá",
             "42134", "3145213456"],

            3 => ["Rodriguez", "Maria", "143413413", "1995-03-08", "Calle 30 - 5", "Medellin",
             "23453", "3412465142"],
        ];

        foreach ($drivers as $driver) {
            Driver::create([
                'last_name' => $driver[0],
                'first_name' => $driver[1],
                'ssd' => $driver[2],
                'dob' => $driver[3],
                'address' => $driver[4],
                'city' => $driver[5],
                'zip' => $driver[6],
                'phone' => $driver[7]
            ]);
        }
    }
}
