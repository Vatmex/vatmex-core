<?php

namespace Database\Seeders;

use App\Models\ATC;
use App\Models\User;
use Illuminate\Database\Seeder;

class ATCsSeeder extends Seeder
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
        | Create ATC profiles for default users
        |--------------------------------------------------------------------------
        */
        $devATC = new ATC;
        $devATC->initials = 'XX';
        $devATC->rank = 8;
        $devATC->inactive = false;
        $devATC->visitor = false;
        $devATC->delivery = true;
        $devATC->ground = true;
        $devATC->tower = true;
        $devATC->approach = true;
        $devATC->center = true;
        $devATC->oceanic = true;
        $devATC->management = true;
        $devATC->instructor_id = 2;
        $devATC->is_training = true;
        $devUser = User::where('cid', 10000001)->firstOrFail();
        $devUser->atc()->save($devATC);

        $liveATC = new ATC;
        $liveATC->initials = 'GV';
        $liveATC->rank = 8;
        $liveATC->inactive = false;
        $liveATC->visitor = false;
        $liveATC->delivery = true;
        $liveATC->ground = true;
        $liveATC->tower = true;
        $liveATC->approach = true;
        $liveATC->center = true;
        $liveATC->oceanic = true;
        $liveATC->management = true;
        $liveATC->instructor_id = 2;
        $liveATC->is_training = true;
        $liveUser = User::where('cid', 1303345)->firstOrFail();
        $liveUser->atc()->save($liveATC);
    }
}
