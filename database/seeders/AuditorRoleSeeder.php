<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AuditorRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $auditorRole = Role::create(['name' => 'auditor']);

        $auditorRole->givePermissionTo('access dashboard');
        $auditorRole->givePermissionTo('view staff');
        $auditorRole->givePermissionTo('view applications');
        $auditorRole->givePermissionTo('view events');
        $auditorRole->givePermissionTo('view atcs');
    }
}
