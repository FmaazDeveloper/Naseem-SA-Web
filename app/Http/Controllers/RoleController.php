<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{


    public function index()
    {
        $roles = Role::all();
        return view('admins.roles.index', ['roles' => $roles]);
    }


    public function create()
    {
        return view('admins.roles.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name'],
        ]);

        Role::create([
            'name' => $request->name,
        ]);

        return redirect()->route('roles.index')->with('msg', 'Role created successfully');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(Role $role)
    {
        return view('admins.roles.edit', ['role' => $role]);
    }


    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:roles,name,' . $role->id],
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        return redirect()->route('roles.index')->with('msg', 'Role updated successfully');
    }


    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index')->with('msg', 'Role deleted successfully');
    }

    public function editPermissionToRole(String $id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('admins.roles.editPermissionToRole', ['role' => $role, 'permissions' => $permissions, 'rolePermissions' => $rolePermissions]);
    }

    public function updatePermissionToRole(Request $request, String $id)
    {
        $users = User::all();
        $request->validate([
            'permission' => ['nullable', 'exists:permissions,name'],
        ]);
        $role = Role::findOrFail($id);
        $role->syncPermissions($request->permission);
        foreach ($users as $user) {
            $user->syncPermissions($user->getPermissionsViaRoles());
        }
        return redirect()->route('roles.index')->with('msg', 'Permissions updated to role successfully');
    }
}
