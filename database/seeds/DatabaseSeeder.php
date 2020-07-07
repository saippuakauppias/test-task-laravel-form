<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $tariffs = [
            [
                'name' => 'First',
                'price' => 12.34,
                'week_days' => ['Wednesday',  'Thursday', 'Sunday'],
            ],
            [
                'name' => 'Second',
                'price' => 56.12,
                'week_days' => ['Monday'],
            ],
            [
                'name' => 'Third',
                'price' => 32.43,
                'week_days' => ['Friday', 'Monday'],
            ],
        ];

        foreach ($tariffs as $tariff) {
            DB::table('tariffs')->insert([
                'name' => $tariff['name'],
                'price' => $tariff['price'],
                'week_days' => implode(',', $tariff['week_days']),
                'created_at' => Carbon::now(),
            ]);
        }

    }
}
