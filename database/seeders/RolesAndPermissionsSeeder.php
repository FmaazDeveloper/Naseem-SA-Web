<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles permissions
        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'add role']);
        Permission::create(['name' => 'update role']);
        Permission::create(['name' => 'delete role']);

        // create regions permissions
        Permission::create(['name' => 'view region']);
        Permission::create(['name' => 'add region']);
        Permission::create(['name' => 'update region']);
        Permission::create(['name' => 'delete region']);

        // create users permissions
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'add user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        // create users roles
        Role::create(['name' => 'manager']);
        Role::create(['name' => 'guide']);
        Role::create(['name' => 'tourist']);

    }
}
