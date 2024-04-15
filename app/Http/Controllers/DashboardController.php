<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Region;
use App\Models\Landmark;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{


    public function index()
    {
        $roles = Role::all();

        $permissions = Permission::all();

        $users = User::all();

        $usersRolesActive[] = '';
        $usersRolesUnactive[] = '';
        foreach ($roles as $role) {
            $usersRolesActive[$role->id] = User::where('is_active', '=', 1)->with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();
            $usersRolesUnactive[$role->id] = User::where('is_active', '=', 0)->with('roles')->get()->filter(fn ($user) => $user->roles->where('name', $role->name)->toArray())->count();
        }

        $usersPermissions[] = '';
        foreach ($permissions as $permission) {
            $usersPermissions[$permission->id] = User::with('permissions')->get()->filter(fn ($user) => $user->permissions->where('name', $permission->name)->toArray())->count();
        }

        $regionsActive = Region::where('is_active', '=', 1)->count();
        $regionsUnactive = Region::where('is_active', '=', 0)->count();

        $landmarksActive = Landmark::where('is_active', '=', 1)->count();
        $landmarksUnactive = Landmark::where('is_active', '=', 0)->count();

        $activitiesActive = Activity::where('is_active', '=', 1)->count();
        $activitiesUnactive = Activity::where('is_active', '=', 0)->count();

        $contentCount = $regionsActive + $regionsUnactive + $landmarksActive + $landmarksUnactive + $activitiesActive + $activitiesUnactive ;
        return view('admins.dashboards.index', [
            'roles' => $roles,
            'permissions' => $permissions,
            'users' => $users,
            'usersRolesActive' => $usersRolesActive,
            'usersRolesUnactive' => $usersRolesUnactive,
            'usersPermissions' => $usersPermissions,
            'regionsActive' => $regionsActive,
            'regionsUnactive' => $regionsUnactive,
            'landmarksActive' => $landmarksActive,
            'landmarksUnactive' => $landmarksUnactive,
            'activitiesActive' => $activitiesActive,
            'activitiesUnactive' => $activitiesUnactive,
            'contentCount' => $contentCount,
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
