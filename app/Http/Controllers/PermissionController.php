<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{


    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('admins.permissions.index', ['permissions' => $permissions]);
    }


    public function create()
    {
        return view('admins.permissions.create');
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
        return view('admins.permissions.edit', ['permission' => $permission]);
    }


    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => ['required', 'string', 'unique:permissions,name,'.$permission->id],
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
