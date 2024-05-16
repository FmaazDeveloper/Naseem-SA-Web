<?php

namespace App\Http\Controllers;

use App\Mail\Welcome\WelcomeUserMail;
use App\Models\Profile;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index']]);
        $this->middleware('permission:add user', ['only' => ['create', 'store']]);
        $this->middleware('permission:update user', ['only' => ['update', 'edit']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }


    public function index()
    {
        $roles = Role::all();
        $all_users = User::all();

        $usersRolesActive[] = '';
        $usersRolesUnactive[] = '';
        foreach ($roles as $role) {
            $usersRolesActive[$role->id] = User::where('is_active', '=', 1)->with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();
            $usersRolesUnactive[$role->id] = User::where('is_active', '=', 0)->with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();
        }
        $users = User::paginate(10);
        $admin = User::with('roles')->get()->filter(fn ($user) => $user->roles->where('name', 'admin')->toArray())->count();
        $guide = User::with('roles')->get()->filter(fn ($user) => $user->roles->where('name', 'guide')->toArray())->count();
        $tourist = User::with('roles')->get()->filter(fn ($user) => $user->roles->where('name', 'tourist')->toArray())->count();
        return view('admins.users.index', [
            'users' => $users,
            'admin' => $admin,
            'guide' => $guide,
            'tourist' => $tourist,
            'roles' => $roles,
            'all_users' => $all_users,
            'usersRolesActive' => $usersRolesActive,
            'usersRolesUnactive' => $usersRolesUnactive,
        ]);
    }


    public function create()
    {
        $roles = Role::all();
        $all_users = User::all();

        $usersRolesActive[] = '';
        $usersRolesUnactive[] = '';
        foreach ($roles as $role) {
            $usersRolesActive[$role->id] = User::where('is_active', '=', 1)->with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();
            $usersRolesUnactive[$role->id] = User::where('is_active', '=', 0)->with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();
        }
        $permissions = Permission::all();
        return view('admins.users.create', [
            'roles' => $roles,
            'permissions' => $permissions,
            'usersRolesActive' => $usersRolesActive,
            'usersRolesUnactive' => $usersRolesUnactive,
            'all_users' => $all_users
        ]);
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

            Mail::to($user->email)->send(new WelcomeUserMail([
                'name' => $user->name,'email' => $user->email,'role' => $user->role,'password' => $request->password,
            ]));

            return to_route('users.index')->with('msg', 'User has created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('msg', 'User not registered!\nError:' . $e->getMessage());
        }
    }


    public function show(String $user_id)
    {
        $roles = Role::all();
        $all_users = User::all();

        $usersRolesActive[] = '';
        $usersRolesUnactive[] = '';
        foreach ($roles as $role) {
            $usersRolesActive[$role->id] = User::where('is_active', '=', 1)->with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();
            $usersRolesUnactive[$role->id] = User::where('is_active', '=', 0)->with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();
        }
        $profile = Profile::where('user_id', '=', $user_id)->first();
        $orders = $profile->user->guide_orders ?? $profile->user->tourist_orders;
        return view('admins.users.show', [
            'profile' => $profile, 'orders' => $orders,
            'roles' => $roles,
            'usersRolesActive' => $usersRolesActive,
            'usersRolesUnactive' => $usersRolesUnactive,
            'all_users' => $all_users
        ]);
    }


    public function edit_profile(String $user_id)
    {
        $roles = Role::all();
        $all_users = User::all();

        $usersRolesActive[] = '';
        $usersRolesUnactive[] = '';
        foreach ($roles as $role) {
            $usersRolesActive[$role->id] = User::where('is_active', '=', 1)->with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();
            $usersRolesUnactive[$role->id] = User::where('is_active', '=', 0)->with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();
        }
        $profile = Profile::where('user_id', '=', $user_id)->first();
        $regions = Region::where('is_active', true)->get();
        return view('admins.users.edit_profile', [
            'profile' => $profile, 'regions' => $regions,
            'roles' => $roles,
            'usersRolesActive' => $usersRolesActive,
            'usersRolesUnactive' => $usersRolesUnactive,
            'all_users' => $all_users
        ]);
    }


    public function update_profile(Request $request, String $user_id)
    {

        $profile = Profile::where('user_id', '=', $user_id)->first();

        $request->validate([
            'region_id' => ['nullable', 'exists:regions,id'],
            'photo' => ['nullable', 'mimes:png,jpeg,jpg,webp'],
            'certificate' => ['nullable', 'mimes:pdf'],
            'phone_number' => ['nullable', 'numeric', 'digits:9', 'regex:/^5[1-9]\d*$/', 'unique:profiles,phone_number,' . $user_id . ',user_id'],
            'age' => ['nullable', 'Integer', 'max:99', 'min:18'],
            'gender' => ['nullable', 'in:Male,Female'],
            'nationality' => ['nullable', 'String'],
            'language' => ['nullable', 'String'],
            'overview' => ['nullable', 'String', 'min:10', 'max:255'],
        ]);

        $update_photo = null;

        if ($request->has('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();

            $file_name = $request->name . time() . '.' . $extension;

            $path = 'images/profiles/';
            $file->move($path, $file_name);

            if (File::exists($profile->photo)) {
                File::delete($profile->photo);
            }
            $update_photo = $path . $file_name;
        }

        $update_certificate = null;

        if ($request->has('certificate')) {
            $file = $request->file('certificate');
            $extension = $file->getClientOriginalExtension();

            $file_name = $request->name . time() . '.' . $extension;

            $path = 'files/guides_certificates/';
            $file->move($path, $file_name);

            if (File::exists($profile->photo)) {
                File::delete($profile->photo);
            }
            $update_certificate = $path . $file_name;
        }

        $profile->update([
            'region_id' => $request->region_id ?? null,
            'photo' => $update_photo ?? $profile->photo,
            'certificate' => $update_certificate ?? $profile->certificate,
            'phone_number' => $request->phone_number,
            'age' => $request->age,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'language' => $request->language,
            'overview' => $request->overview,
        ]);

        return to_route('users.show', $user_id)->with('msg', 'Profile has updated successfully');
    }

    public function edit(string $id)
    {
        $roles = Role::all();
        $all_users = User::all();

        $usersRolesActive[] = '';
        $usersRolesUnactive[] = '';
        foreach ($roles as $role) {
            $usersRolesActive[$role->id] = User::where('is_active', '=', 1)->with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();
            $usersRolesUnactive[$role->id] = User::where('is_active', '=', 0)->with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();
        }
        $user = User::findOrFail($id);
        $permissions = Permission::all();
        return view('admins.users.edit', [
            'user' => $user, 'roles' => $roles, 'permissions' => $permissions,
            'usersRolesActive' => $usersRolesActive,
            'usersRolesUnactive' => $usersRolesUnactive,
            'all_users' => $all_users
        ]);
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
                'email_verified_at' => $user->email !== $request->email ? null : $user->email_verified_at,
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
