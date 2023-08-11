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

        $viewUsersPermission = Permission::create(['name' => 'view users']);
        $assignRolesPermission = Permission::create(['name' => 'assign roles']);
        $removeRolesPermission = Permission::create(['name' => 'remove roles']);

        $administratorRole = Role::where('name', 'administrator')->first();
        $trainingCoordinator = Role::where('name', 'training-coordinator')->first();
        $instructorRole = Role::where('name', 'instructor')->first();
        $auditorRole = Role::where('name', 'auditor')->first();

        $administratorRole->givePermissionTo($viewInstructorPermission);
        $administratorRole->givePermissionTo($createInstructorPermission);
        $administratorRole->givePermissionTo($assignInstructorPermission);
        $administratorRole->givePermissionTo($editInstructorPermission);
        $administratorRole->givePermissionTo($deleteInstructorPermission);
        $administratorRole->givePermissionTo($viewUsersPermission);
        $administratorRole->givePermissionTo($assignRolesPermission);
        $administratorRole->givePermissionTo($removeRolesPermission);

        $trainingCoordinator->givePermissionTo($viewInstructorPermission);
        $trainingCoordinator->givePermissionTo($createInstructorPermission);
        $trainingCoordinator->givePermissionTo($assignInstructorPermission);
        $trainingCoordinator->givePermissionTo($editInstructorPermission);
        $trainingCoordinator->givePermissionTo($deleteInstructorPermission);

        $administratorRole->givePermissionTo($viewInstructorPermission);
        $administratorRole->givePermissionTo($viewUsersPermission);

        $auditorRole->givePermissionTo($viewUsersPermission);
        $auditorRole->givePermissionTo($viewInstructorPermission);

        $instructorRole->givePermissionTo($viewInstructorPermission);
    }
}
