<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->call(BusesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(SeatsTableSeeder::class);
        $this->call(TripsTableSeeder::class);
        $this->call(StationsTableSeeder::class);
    }
}
