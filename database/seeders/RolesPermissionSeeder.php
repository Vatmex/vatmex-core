<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createRolesPermission = Permission::create(['name' => 'create roles']);
        $viewRolesPermission = Permission::create(['name' => 'view roles']);
        $editRolesPermission = Permission::create(['name' => 'edit roles']);
        $deleteRolesPermission = Permission::create(['name' => 'delete roles']);
    }
}
