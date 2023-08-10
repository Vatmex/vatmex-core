<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class TrainingRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $viewInstructorPermission = Permission::create(['name' => 'view instructors']);
        $createInstructorPermission = Permission::create(['name' => 'create instructors']);
        $assignInstructorPermission = Permission::create(['name' => 'assign instructors']);
        $editInstructorPermission = Permission::create(['name' => 'edit instructors']);
        $deleteInstructorPermission = Permission::create(['name' => 'delete instructors']);

        $administratorRole = Role::where('name', 'administrator')->first();
        $trainingCoordinator = Role::where('name', 'training-coordinator')->first();
        $instructorRole = Role::where('name', 'instructor')->first();

        $administratorRole->givePermissionTo($viewInstructorPermission);
        $administratorRole->givePermissionTo($createInstructorPermission);
        $administratorRole->givePermissionTo($assignInstructorPermission);
        $administratorRole->givePermissionTo($editInstructorPermission);
        $administratorRole->givePermissionTo($deleteInstructorPermission);

        $trainingCoordinator->givePermissionTo($viewInstructorPermission);
        $trainingCoordinator->givePermissionTo($createInstructorPermission);
        $trainingCoordinator->givePermissionTo($assignInstructorPermission);
        $trainingCoordinator->givePermissionTo($editInstructorPermission);
        $trainingCoordinator->givePermissionTo($deleteInstructorPermission);

        $instructorRole->givePermissionTo($viewInstructorPermission);
    }
}
