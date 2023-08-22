<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        $administratorRole = Role::where('name', 'administrator')->firstOrFail();
        $administratorRole->givePermissionTo($viewLogsPermission);
        $administratorRole->givePermissionTo($viewRecordsPermission);
        $administratorRole->save();
    }
}
