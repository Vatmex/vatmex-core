<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuditPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $viewLogsPermission = Permission::create(['name' => 'view logs']);
        $viewRecordsPermission = Permission::create(['name' => 'view records']);
        $viewTrashedPermission = Permission::create(['name' => 'view trashed']);

        $administratorRole = Role::where('name', 'administrator')->firstOrFail();
        $administratorRole->givePermissionTo($viewLogsPermission);
        $administratorRole->givePermissionTo($viewRecordsPermission);
        $administratorRole->givePermissionTo($viewTrashedPermission);
        $administratorRole->save();

        $superAdminRole = Role::where('name', 'Super-Admin')->firstOrFail();
        $superAdminRole->givePermissionTo($viewLogsPermission);
        $superAdminRole->givePermissionTo($viewRecordsPermission);
        $superAdminRole->givePermissionTo($viewTrashedPermission);
        $superAdminRole->save();
    }
}
