<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schedules = [
            1 => [1, 1, "2022-08-09 08:00:00", "2022-08-09 12:00:00"],
            2 => [1, 1, "2022-08-09 13:00:00", "2022-08-09 18:00:00"],
            3 => [2, 2, "2022-08-10 08:00:00", "2022-08-09 12:00:00"],
            4 => [2, 2, "2022-08-10 13:00:00", "2022-08-09 18:00:00"],
        ];

        foreach ($schedules as $schedule) {
            Schedule::create([
                'route_id' => $schedule[0],
                'week_num' => $schedule[1],
                'from' => $schedule[2],
                'to' => $schedule[3],
            ]);
        }
    }
}
