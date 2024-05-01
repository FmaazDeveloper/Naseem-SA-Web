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
        // Permission::create(['name' => 'update permissions role']);
        Permission::create(['name' => 'delete role']);

        // create permissions permissions
        Permission::create(['name' => 'view permission']);
        Permission::create(['name' => 'add permission']);
        Permission::create(['name' => 'update permission']);
        Permission::create(['name' => 'delete permission']);

        // create administrative region permissions
        Permission::create(['name' => 'view administrative region']);
        Permission::create(['name' => 'add administrative region']);
        Permission::create(['name' => 'update administrative region']);
        Permission::create(['name' => 'delete administrative region']);

        // create regions permissions
        Permission::create(['name' => 'view region']);
        Permission::create(['name' => 'add region']);
        Permission::create(['name' => 'update region']);
        Permission::create(['name' => 'delete region']);

        // create landmarks permissions
        Permission::create(['name' => 'view landmark']);
        Permission::create(['name' => 'add landmark']);
        Permission::create(['name' => 'update landmark']);
        Permission::create(['name' => 'delete landmark']);

        // create activities permissions
        Permission::create(['name' => 'view activity']);
        Permission::create(['name' => 'add activity']);
        Permission::create(['name' => 'update activity']);
        Permission::create(['name' => 'delete activity']);

        // create users permissions
        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'add user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        // create users roles
        Role::create(['name' => 'manager'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'super-admin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'guide']);
        Role::create(['name' => 'tourist']);

    }
}
