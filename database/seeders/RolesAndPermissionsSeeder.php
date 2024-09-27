<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'role-create']);
        Permission::create(['name' => 'role-edit']);
        Permission::create(['name' => 'role-list']);
        Permission::create(['name' => 'role-delete']);

        // Create roles and assign existing permissions
        $admin = Role::create(['name' => 'admin']);
        $viewer = Role::create(['name' => 'viewer']);
        $editor = Role::create(['name' => 'editor']);

        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_id' => 1,
            'model_type' => 'App\Models\User'
        ]);

        // Assign permissions to roles
        $admin->givePermissionTo(['role-create', 'role-edit', 'role-list', 'role-delete']);
        $viewer->givePermissionTo(['role-list']);
        $editor->givePermissionTo(['role-list', 'role-edit']);
    }
}
