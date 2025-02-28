<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class StudentPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $viewStudentsPermission = Permission::create(['name' => 'view students']);
        $editStudentsPermission = Permission::create(['name' => 'edit students']);
        $assignStudentsPermission = Permission::create(['name' => 'assign students']);
        $deleteStudentsPermission = Permission::create(['name' => 'remove students']);

        $administratorRole = Role::where('name', 'administrator')->first();
        $trainingCoordinator = Role::where('name', 'training-coordinator')->first();
        $instructorRole = Role::where('name', 'instructor')->first();
        $auditorRole = Role::where('name', 'auditor')->first();

        $administratorRole->givePermissionTo($viewStudentsPermission);
        $administratorRole->givePermissionTo($editStudentsPermission);
        $administratorRole->givePermissionTo($assignStudentsPermission);
        $administratorRole->givePermissionTo($deleteStudentsPermission);

        $trainingCoordinator->givePermissionTo($viewStudentsPermission);
        $trainingCoordinator->givePermissionTo($editStudentsPermission);
        $trainingCoordinator->givePermissionTo($assignStudentsPermission);
        $trainingCoordinator->givePermissionTo($deleteStudentsPermission);

        $instructorRole->givePermissionTo($viewStudentsPermission);
        $instructorRole->givePermissionTo($editStudentsPermission);

        $auditorRole->givePermissionTo($viewStudentsPermission);
    }
}
