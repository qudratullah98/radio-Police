<?php

namespace Database\Seeders;

use App\Models\DayOfWeek;
use Illuminate\Database\Seeder;

class DayOfWeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DayOfWeek::create(['en_name' => 'Saturday', 'da_name' => 'شنبه', 'pa_name' => 'شنبه', 'status' => '1', 'created_by' => 1]);
        DayOfWeek::create(['en_name' => 'Sunday', 'da_name' => 'یکشنبه', 'pa_name' => 'یکشنبه', 'status' => '1', 'created_by' => 1]);
        DayOfWeek::create(['en_name' => 'Monday', 'da_name' => 'دوشنبه', 'pa_name' => 'دوشنبه', 'status' => '1', 'created_by' => 1]);
        DayOfWeek::create(['en_name' => 'Tuesday', 'da_name' => 'سه شنبه', 'pa_name' => 'سه شنبه', 'status' => '1', 'created_by' => 1]);
        DayOfWeek::create(['en_name' => 'Wednsday', 'da_name' => 'چهارشنبه', 'pa_name' => 'چهارشنبه', 'status' => '1', 'created_by' => 1]);
        DayOfWeek::create(['en_name' => 'Thursday', 'da_name' => 'پنج شنبه', 'pa_name' => 'پنج شنبه', 'status' => '1', 'created_by' => 1]);
        DayOfWeek::create(['en_name' => 'Friday', 'da_name' => 'جمعه', 'pa_name' => 'جمعه', 'status' => '1', 'created_by' => 1]);
    }
}