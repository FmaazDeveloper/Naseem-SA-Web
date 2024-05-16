<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view permission', ['only' => ['index']]);
        $this->middleware('permission:add permission', ['only' => ['create', 'store']]);
        $this->middleware('permission:update permission', ['only' => ['update', 'edit']]);
        $this->middleware('permission:delete permission', ['only' => ['destroy']]);
    }

    public function index()
    {
        $all_permissions = Permission::all();
        $usersPermissions[] = '';
        foreach ($all_permissions as $permission) {
            $usersPermissions[$permission->id] = User::with('permissions')->get()->filter(fn ($user) => $user->permissions->where('name', $permission->name)->toArray())->count();
        }
        $permissions = Permission::paginate(10);
        return view('admins.permissions.index', [
            'permissions' => $permissions,
            'all_permissions' => $all_permissions,
            'usersPermissions' => $usersPermissions,
        ]);
    }


    public function create()
    {

        $all_permissions = Permission::all();
        $usersPermissions[] = '';
        foreach ($all_permissions as $permission) {
            $usersPermissions[$permission->id] = User::with('permissions')->get()->filter(fn ($user) => $user->permissions->where('name', $permission->name)->toArray())->count();
        }
        return view('admins.permissions.create', [
            'all_permissions' => $all_permissions,
            'usersPermissions' => $usersPermissions,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:permissions,name'],
        ]);

        Permission::create([
            'name' => $request->name,
        ]);

        return redirect()->route('permissions.index')->with('msg', 'Permission created successfully');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(Permission $permission)
    {
        $all_permissions = Permission::all();
        $usersPermissions[] = '';
        foreach ($all_permissions as $permission) {
            $usersPermissions[$permission->id] = User::with('permissions')->get()->filter(fn ($user) => $user->permissions->where('name', $permission->name)->toArray())->count();
        }
        return view('admins.permissions.edit', [
            'permission' => $permission,
            'all_permissions' => $all_permissions,
            'usersPermissions' => $usersPermissions,
        ]);
    }


    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:permissions,name,' . $permission->id],
        ]);

        $permission->update([
            'name' => $request->name,
        ]);

        return redirect()->route('permissions.index')->with('msg', 'Permission updated successfully');
    }


    public function destroy(string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->route('permissions.index')->with('msg', 'Permission deleted successfully');
    }
}
