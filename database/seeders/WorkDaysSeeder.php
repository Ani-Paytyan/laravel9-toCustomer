<?php

namespace Database\Seeders;

use App\Models\WorkDays;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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

            WorkDays::updateOrCreate([
                'day_of_week' => $i,
                'company_id' => null,
                'workplace_id' => null,
            ], [
                'uuid' => Str::uuid()->toString(),
                'from' => '9:00',
                'to' => '18:00',
                'is_active' => $is_active,
            ]);
        }
    }
}
