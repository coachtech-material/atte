<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AttendancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($id = 1; $id <= 10; $id++) {
            for ($num = -5; $num <= 5; $num++) {
                $start_time = '10:23:45';
                $end_time = '20:23:45';

                $dt = new Carbon();

                if ($num < 0) {
                    $fixed_date = $dt->subDays(-$num);
                } else {
                    $fixed_date = $dt->addDays($num);
                }
                $date = $fixed_date->toDateString();

                $param = [
                    'user_id' => $id,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'date' => $date
                ];
                Attendance::create($param);
            }
        }
    }
}
