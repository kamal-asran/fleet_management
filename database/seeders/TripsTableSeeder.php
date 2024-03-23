<?php

namespace Database\Seeders;

use App\Models\Bus;
use App\Models\City;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use App\Models\Trip;

class TripsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();
        //first trip from cairo to Asyut 
        $departureTime = $faker->dateTimeBetween('+1 day', '+7 days');
        $arrivalTime = $departureTime->modify('+ ' . rand(4, 8) . ' hours');
        $fromCityID=1;
        $toCityID=4;

        $trip = [
            'bus_id' =>1,
            'from_city_id' =>$fromCityID,
            'to_city_id' => $toCityID,
            'departure_time' => $departureTime,
            'arrival_time' => $arrivalTime,
        ];
        Trip::create($trip);

        //second trip from AlFayyum to AlMinya 

        $departureTime = $faker->dateTimeBetween('+1 day', '+7 days');
        $arrivalTime = $departureTime->modify('+ ' . rand(4, 8) . ' hours');
        $fromCityID=2;
        $toCityID=3;

        $trip = [
            'bus_id' =>2,
            'from_city_id' =>$fromCityID,
            'to_city_id' => $toCityID,
            'departure_time' => $departureTime,
            'arrival_time' => $arrivalTime,
        ];
        Trip::create($trip);
        
    }
}
