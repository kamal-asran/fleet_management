<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use App\Models\Station;
use App\Models\Trip;
use App\Models\City;

class StationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();
        
            $stations = [
                
                //seed trip 1 stations
                
                [
                    'name' => $faker->streetName . ' Station',
                    'trip_id' => 1,
                    'city_id' => 1,
                    'sequence_number' => 1,
                ],
                [
                    'name' => $faker->streetName . ' Station',
                    'trip_id' => 1,
                    'city_id' => 1,
                    'sequence_number' => 2, 
                ],
                [
                    'name' => $faker->streetName . ' Station',
                    'trip_id' => 1,
                    'city_id' => 2,
                    'sequence_number' => 3, 
                ],
                [
                    'name' => $faker->streetName . ' Station',
                    'trip_id' => 1,
                    'city_id' => 3,
                    'sequence_number' => 4, 
                ],
                [
                    'name' => $faker->streetName . ' Station',
                    'trip_id' => 1,
                    'city_id' => 4,
                    'sequence_number' => 5, 
                ],
                [
                    'name' => $faker->streetName . ' Station',
                    'trip_id' => 1,
                    'city_id' => 4,
                    'sequence_number' => 6, 
                ],

                //seed trip 2 stations
                [
                    'name' => $faker->streetName . ' Station',
                    'trip_id' => 2,
                    'city_id' => 2,
                    'sequence_number' => 1,
                ],
                [
                    'name' => $faker->streetName . ' Station',
                    'trip_id' => 2,
                    'city_id' => 2,
                    'sequence_number' => 2, 
                ],
                [
                    'name' => $faker->streetName . ' Station',
                    'trip_id' => 2,
                    'city_id' => 3,
                    'sequence_number' => 3, 
                ],
                [
                    'name' => $faker->streetName . ' Station',
                    'trip_id' => 2,
                    'city_id' => 3,
                    'sequence_number' => 4, 
                ],
                [
                    'name' => $faker->streetName . ' Station',
                    'trip_id' => 2,
                    'city_id' => 3,
                    'sequence_number' => 5, 
                ]
                
            ];

            Station::insert($stations);
    }
}
