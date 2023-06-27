<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $viewFeedbackPermission = Permission::create(['name' => 'view feedback']);

        $administratorRole = Role::where('name', 'administrator')->firstOrFail();
        $administratorRole->givePermissionTo($viewFeedbackPermission);
        $administratorRole->save();

        $trainingCoordinatorRole = Role::where('name', 'training-coordinator')->firstOrFail();
        $trainingCoordinatorRole->givePermissionTo($viewFeedbackPermission);
        $trainingCoordinatorRole->save();

        $instructorRole = Role::where('name', 'instructor')->firstOrFail();
        $instructorRole->givePermissionTo($viewFeedbackPermission);
        $instructorRole->save();
    }
}
