<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        |--------------------------------------------------------------------------
        | Create Default Users
        |--------------------------------------------------------------------------
        */
        $devUser = User::create([
            'name' => 'Web One',
            'email' => 'auth.dev1@vatsim.net',
            'cid' => 10000001,
            'first_name' => 'Web',
            'last_name' => 'One',
        ]);
        $liveUser = User::create([
            'name' => 'Gustavo Valdez',
            'email' => 'gustavo@vatmex.com.mx',
            'cid' => 1303345,
            'first_name' => 'Gustavo',
            'last_name' => 'Valdez',
        ]);
    }
}
