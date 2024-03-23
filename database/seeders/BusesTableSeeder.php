<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bus;

class BusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buses = [
            [
                'bus_number' => '55',
                'total_seats' => 20, 
            ],
            [
                'bus_number' => '77',
                'total_seats' => 20, 
            ],
        ];

        foreach ($buses as $bus) {
            Bus::create($bus);
        }
    }
}
