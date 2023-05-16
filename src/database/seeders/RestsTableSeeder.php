<?php

namespace Database\Seeders;

use App\Models\Rest;
use Illuminate\Database\Seeder;

class RestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($id = 1; $id <= 50; $id++) {
            $start_time = '15:23:45';
            $end_time = '16:23:45';

            $param = [
                'attendance_id' => $id,
                'start_time' => $start_time,
                'end_time' => $end_time,
            ];
            Rest::create($param);
        }
    }
}
