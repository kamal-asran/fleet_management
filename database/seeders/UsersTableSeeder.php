<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'kamal asran',
            'email' => 'prog.kamal.asran@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
    }
}

