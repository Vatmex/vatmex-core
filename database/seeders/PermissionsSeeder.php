<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsSeeder extends Seeder
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
        | Create Permissions
        |--------------------------------------------------------------------------
        */
        $accessDashboardPermission = Permission::create(['name' => 'access dashboard']);

        $viewStaffPermission = Permission::create(['name' => 'view staff']);
        $createStaffPermission = Permission::create(['name' => 'create staff']);
        $assignStaffPermission = Permission::create(['name' => 'assign staff']);
        $editStaffPermission = Permission::create(['name' => 'edit staff']);
        $deleteStaffPermission = Permission::create(['name' => 'delete staff']);

        $viewEventsPermission = Permission::create(['name' => 'view events']);
        $createEventsPermission = Permission::create(['name' => 'create events']);
        $editEventsPermission = Permission::create(['name' => 'edit events']);
        $deleteEventsPermission = Permission::create(['name' => 'delete events']);

        $viewApplicationsPermission = Permission::create(['name' => 'view applications']);
        $assignApplicationsPermission = Permission::create(['name' => 'assign applications']);
        $deleteApplicationsPermission = Permission::create(['name' => 'delete applications']);

        $viewATCsPermission = Permission::create(['name' => 'view atcs']);
        $editATCsPermission = Permission::create(['name' => 'edit atcs']);

        /*
        |--------------------------------------------------------------------------
        | Create Roles
        |--------------------------------------------------------------------------
        */
        $superAdminRole = Role::create(['name' => 'Super-Admin']);
        $administratorRole = Role::create(['name' => 'administrator']);
        $eventCoordinatorRole = Role::create(['name' => 'event-coordinator']);
        $eventSupportRole = Role::create(['name' => 'event-support']);
        $trainingCoordinator = Role::create(['name' => 'training-coordinator']);
        $instructorRole = Role::create(['name' => 'instructor']);

        /*
        |--------------------------------------------------------------------------
        | Assign Roles
        |--------------------------------------------------------------------------
        */
        // Administrator (Only VATMEX1 VATMEX2 VATMEX3)
        $administratorRole->givePermissionTo($accessDashboardPermission);
        $administratorRole->givePermissionTo($viewStaffPermission);
        $administratorRole->givePermissionTo($createStaffPermission);
        $administratorRole->givePermissionTo($assignStaffPermission);
        $administratorRole->givePermissionTo($editStaffPermission);
        $administratorRole->givePermissionTo($deleteStaffPermission);
        $administratorRole->givePermissionTo($viewApplicationsPermission);
        $administratorRole->givePermissionTo($assignApplicationsPermission);
        $administratorRole->givePermissionTo($deleteApplicationsPermission);
        $administratorRole->givePermissionTo($viewEventsPermission);
        $administratorRole->givePermissionTo($createEventsPermission);
        $administratorRole->givePermissionTo($editEventsPermission);
        $administratorRole->givePermissionTo($deleteEventsPermission);
        $administratorRole->givePermissionTo($viewATCsPermission);
        $administratorRole->givePermissionTo($editATCsPermission);

        // Event Coordinator
        $eventCoordinatorRole->givePermissionTo($accessDashboardPermission);
        $eventCoordinatorRole->givePermissionTo($viewEventsPermission);
        $eventCoordinatorRole->givePermissionTo($createEventsPermission);
        $eventCoordinatorRole->givePermissionTo($viewEventsPermission);
        $eventCoordinatorRole->givePermissionTo($deleteEventsPermission);

        // Event support staff
        $eventSupportRole->givePermissionTo($accessDashboardPermission);
        $eventSupportRole->givePermissionTo($viewEventsPermission);
        $eventSupportRole->givePermissionTo($createEventsPermission);
        $eventSupportRole->givePermissionTo($editEventsPermission);

        // Training Director
        $trainingCoordinator->givePermissionTo($accessDashboardPermission);
        $trainingCoordinator->givePermissionTo($viewApplicationsPermission);
        $trainingCoordinator->givePermissionTo($assignApplicationsPermission);
        $trainingCoordinator->givePermissionTo($deleteApplicationsPermission);
        $trainingCoordinator->givePermissionTo($viewATCsPermission);
        $trainingCoordinator->givePermissionTo($editATCsPermission);

        // Instructors
        $instructorRole->givePermissionTo($accessDashboardPermission);
        $instructorRole->givePermissionTo($viewApplicationsPermission);
        $instructorRole->givePermissionTo($viewATCsPermission);

        /*
        |--------------------------------------------------------------------------
        | Register Super-Admins
        |--------------------------------------------------------------------------
        */
        $devUser = User::where('cid', 10000001)->firstOrFail();
        $devUser->assignRole($superAdminRole);

        $liveUser = User::where('cid', 1303345)->firstOrFail();
        $liveUser->assignRole($superAdminRole);
    }
}
