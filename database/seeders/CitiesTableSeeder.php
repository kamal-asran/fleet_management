<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            [
                'name' => 'Cairo',
            ],
            [
                'name' => 'AlFayyum',
            ],
            [
                'name' => 'AlMinya',
            ],
            [
                'name' => 'Asyut',
            ],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
