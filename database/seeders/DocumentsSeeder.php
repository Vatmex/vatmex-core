<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $viewDocumentsPermission = Permission::create(['name' => 'view documents']);
        $createDocumentsPermission = Permission::create(['name' => 'create documents']);
        $editDocumentsPermission = Permission::create(['name' => 'edit documents']);
        $deleteDocumentsPermission = Permission::create(['name' => 'delete documents']);

        $administratorRole = Role::where('name', 'administrator')->firstOrFail();
        $administratorRole->givePermissionTo($viewDocumentsPermission);
        $administratorRole->givePermissionTo($createDocumentsPermission);
        $administratorRole->givePermissionTo($editDocumentsPermission);
        $administratorRole->givePermissionTo($deleteDocumentsPermission);
        $administratorRole->save();

        $policiesCategory = Category::create(['name' => 'Políticas', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce massa magna, tristique et tempus ut, ullamcorper quis urna. Nullam in quam vitae est rutrum fringilla. Aliquam ultrices bibendum augue, sit amet blandit arcu hendrerit nec. Donec ac est sed enim ultricies gravida.']);
        $SOPCategory = Category::create(['name' => 'Procedimientos Estandard (SOPs)', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce massa magna, tristique et tempus ut, ullamcorper quis urna. Nullam in quam vitae est rutrum fringilla. Aliquam ultrices bibendum augue, sit amet blandit arcu hendrerit nec. Donec ac est sed enim ultricies gravida.']);
        $LOA = Category::create(['name' => 'Cartas Acuerdo (LOAs)', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce massa magna, tristique et tempus ut, ullamcorper quis urna. Nullam in quam vitae est rutrum fringilla. Aliquam ultrices bibendum augue, sit amet blandit arcu hendrerit nec. Donec ac est sed enim ultricies gravida.']);
    }
}
