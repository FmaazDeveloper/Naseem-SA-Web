<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view role', ['only' => ['index']]);
        $this->middleware('permission:add role', ['only' => ['create', 'store']]);
        $this->middleware('permission:update role', ['only' => ['update', 'edit']]);
        $this->middleware('permission:add permission', ['only' => ['updatePermissionToRole', 'editPermissionToRole']]);
        $this->middleware('permission:delete role', ['only' => ['destroy']]);
    }


    public function index()
    {
        $all_roles = Role::all();
        $usersRolesActive[] = '';
        $usersRolesUnactive[] = '';
        foreach ($all_roles as $role) {
            $usersRolesActive[$role->id] = User::where('is_active', '=', 1)->with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();
            $usersRolesUnactive[$role->id] = User::where('is_active', '=', 0)->with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();
        }
        $roles = Role::paginate(10);
        return view('admins.roles.index', [
            'roles' => $roles,
            'all_roles' => $all_roles,
            'usersRolesActive' => $usersRolesActive,
            'usersRolesUnactive' => $usersRolesUnactive,
        ]);
    }


    public function create()
    {
        $all_roles = Role::all();
        $usersRolesActive[] = '';
        $usersRolesUnactive[] = '';
        foreach ($all_roles as $role) {
            $usersRolesActive[$role->id] = User::where('is_active', '=', 1)->with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();
            $usersRolesUnactive[$role->id] = User::where('is_active', '=', 0)->with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();
        }
        return view('admins.roles.create', [
            'all_roles' => $all_roles,
            'usersRolesActive' => $usersRolesActive,
            'usersRolesUnactive' => $usersRolesUnactive,
        ]);
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
        $all_roles = Role::all();
        $usersRolesActive[] = '';
        $usersRolesUnactive[] = '';
        foreach ($all_roles as $role) {
            $usersRolesActive[$role->id] = User::where('is_active', '=', 1)->with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();
            $usersRolesUnactive[$role->id] = User::where('is_active', '=', 0)->with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();
        }
        return view('admins.roles.edit', [
            'role' => $role,
            'all_roles' => $all_roles,
            'usersRolesActive' => $usersRolesActive,
            'usersRolesUnactive' => $usersRolesUnactive,
        ]);
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
        $all_roles = Role::all();
        $usersRolesActive[] = '';
        $usersRolesUnactive[] = '';
        foreach ($all_roles as $role) {
            $usersRolesActive[$role->id] = User::where('is_active', '=', 1)->with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();
            $usersRolesUnactive[$role->id] = User::where('is_active', '=', 0)->with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();
        }
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('admins.roles.editPermissionToRole', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
            'all_roles' => $all_roles,
            'usersRolesActive' => $usersRolesActive,
            'usersRolesUnactive' => $usersRolesUnactive,
        ]);
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
