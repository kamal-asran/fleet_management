<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seat;

class SeatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seats = [];
        //seed 20 seats for each bus
        for ($i = 1; $i <= 20; $i++) {
            $seats[] = [
                'number' => $i,
                'bus_id'=>1,
            ];
        }
        for ($i = 1; $i <= 20; $i++) { 
            $seats[] = [
                'number' => $i,
                'bus_id'=>2,
            ];
        }

        foreach ($seats as $seat) {
            Seat::create($seat);
        }
    }
}
