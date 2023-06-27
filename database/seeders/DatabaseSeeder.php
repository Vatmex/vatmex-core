<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // After this point is production, so individual Seeders from now on.
        $this->call([
            UsersSeeder::class,
            PermissionsSeeder::class,
            InstructorsSeeder::class,
            ATCsSeeder::class,
            StaffSeeder::class,
            DocumentsSeeder::class,
            FeedbackSeeder::class,
        ]);
    }
}
