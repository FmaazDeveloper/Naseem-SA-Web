<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admins.dashboards.users.index',['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admins.dashboards.users.create',['permissions' => $permissions]);
    }

    public function store(Request $request)
    {

        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'is_active' => ['nullable', 'in:1,0'],
        ]);
        try{

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_active' => $request->is_active ? $request->is_active : 0,
            ]);
            $user->syncPermissions($request->permissions,[]);
            return to_route('users.index')->with('msg', 'User has created successfully');
        }
        catch (\Exception $e){
            return redirect()->back()->with('msg', 'User not registered!\nError:'.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $permissions = Permission::all();
        return view('admins.dashboards.users.edit',['user' => $user, 'permissions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'is_active' => ['nullable', 'in:1,0'],
        ]);
        try{

            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_active' => $request->is_active ? $request->is_active : 0,
            ]);
            $user->syncPermissions($request->permissions,[]);
            return to_route('users.index')->with('msg', 'User has updated successfully');
        }
        catch (\Exception $e){
            return redirect()->back()->with('msg', 'User not updated!\nError:'.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $user = User::findOrFail($id);
            $user->delete();
            $user->revokePermissionTo($user->permissions);
            return to_route('users.index')->with('msg', 'User has deleted successfully');
        }catch (\Exception $e){
            return redirect()->back()->with('msg', 'User not deleted!\nError:'.$e->getMessage());
        }
    }
}
