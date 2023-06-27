<?php

namespace Database\Seeders;

use App\Models\Instructor;
use App\Models\User;
use Illuminate\Database\Seeder;

class InstructorsSeeder extends Seeder
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
        | Create Instructor profiles for default users
        |--------------------------------------------------------------------------
        */
        $devInstructor = new Instructor;
        $devInstructor->tower = true;
        $devInstructor->approach = true;
        $devInstructor->center = true;
        $devInstructor->oceanic = true;
        $devInstructor->management = true;
        $devUser = User::where('cid', 10000001)->firstOrFail();
        $devUser->instructor_profile()->save($devInstructor);

        $liveInstructor = new Instructor;
        $liveInstructor->tower = true;
        $liveInstructor->approach = false;
        $liveInstructor->center = false;
        $liveInstructor->oceanic = false;
        $liveInstructor->management = false;
        $liveUser = User::where('cid', 1303345)->firstOrFail();
        $liveUser->instructor_profile()->save($liveInstructor);
    }
}
