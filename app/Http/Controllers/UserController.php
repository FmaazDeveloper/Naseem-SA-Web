<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view user',['only'=> ['index']]);
        $this->middleware('permission:add user',['only'=> ['create','store']]);
        $this->middleware('permission:update user',['only'=> ['update','edit']]);
        $this->middleware('permission:delete user',['only'=> ['destroy']]);
    }

    
    public function index()
    {
        $users = User::paginate(10);
        $admin = User::with('roles')->get()->filter(fn ($user) => $user->roles->where('name', 'admin')->toArray())->count();
        $guide = User::with('roles')->get()->filter(fn ($user) => $user->roles->where('name', 'guide')->toArray())->count();
        $tourist = User::with('roles')->get()->filter(fn ($user) => $user->roles->where('name', 'tourist')->toArray())->count();
        return view('admins.users.index', ['users' => $users, 'admin' => $admin, 'guide' => $guide, 'tourist' => $tourist]);
    }


    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admins.users.create', ['roles' => $roles, 'permissions' => $permissions]);
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'exists:roles,name'],
            'is_active' => ['nullable', 'in:1,0'],
        ]);
        try {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'is_active' => $request->is_active ? $request->is_active : 0,
            ]);

            $user->profile()->create([
                'user_id' => $user->id,
            ]);

            $user->assignRole($request->role);
            $user->givePermissionTo($user->getPermissionsViaRoles());

            return to_route('users.index')->with('msg', 'User has created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('msg', 'User not registered!\nError:' . $e->getMessage());
        }
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        $permissions = Permission::all();
        return view('admins.users.edit', ['user' => $user, 'roles' => $roles, 'permissions' => $permissions]);
    }


    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'is_active' => ['nullable', 'in:1,0'],
            'role' => ['required', 'exists:roles,name'],
        ]);
        try {

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'is_active' => $request->is_active ? $request->is_active : 0,
            ]);

            $user->syncRoles($request->role);
            $user->syncPermissions($user->getPermissionsViaRoles());

            return to_route('users.index')->with('msg', 'User has updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('msg', 'User not updated! | Error:' . $e->getMessage());
        }
    }


    public function destroy(string $id)
    {
        try {

            $user = User::findOrFail($id);
            $user->delete();
            $user->revokePermissionTo($user->permissions);
            $user->syncRoles([]);

            return to_route('users.index')->with('msg', 'User has deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('msg', 'User not deleted! | Error:' . $e->getMessage());
        }
    }
}
