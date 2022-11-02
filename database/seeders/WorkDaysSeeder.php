<?php

namespace Database\Seeders;

use App\Models\WorkDays;
use Illuminate\Database\Seeder;

class WorkDaysSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 7; $i++) {
            $is_active = true;
            if ($i === 6 || $i === 7) {
                $is_active = false;
            }

            WorkDays::factory()->create([
                'day_of_week' => $i,
                'from' => '9:00',
                'to' => '18:00',
                'is_active' => $is_active,
            ]);
        }
    }
}
