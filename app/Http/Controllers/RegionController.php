<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_edit()
    {
        $regions = Region::all();
        return view('admins.regions.index', ['regions' => $regions]);
    }
    public function index()
    {
        $regions = Region::all();
        // return view('admins.regions.index', ['regions' => $regions]);
        return view('regions.index', ['regions' => $regions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.regions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'type' => ['required', 'string'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'main_description' => ['required', 'string', 'min:30'],
            'weather_description' => ['required', 'string', 'min:10', 'max:255'],
            'card_description' => ['required', 'string', 'min:10', 'max:255'],
            'card_photo' => ['required', 'mimes:png'],
            'is_active' => ['nullable', 'in:1,0'],
        ]);

        if ($request->has('card_photo')) {
            $file = $request->file('card_photo');
            $extension = $file->getClientOriginalExtension();

            $file_name = $request->name . '.' . $extension;

            $path = 'images/regions/';
            $file->move($path, $file_name);
        }

        Region::create([
            'admin_id' => 1,
            'type' => $request->type,
            'name' => $request->name,
            'main_description' => $request->main_description,
            'weather_description' => $request->weather_description,
            'card_description' => $request->card_description,
            'card_photo' => $path . $file_name,
            'is_active' => $request->is_active ? $request->is_active : 0,
        ]);

        return to_route('regions.index_edit');
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region)
    {
        return view('regions.show', ['region' => $region]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region)
    {
        return view('admins.regions.edit', ['region' => $region]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Region $region)
    {

        request()->validate([
            'type' => ['required', 'string', 'in:City,Island'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'main_description' => ['required', 'string', 'min:30'],
            'weather_description' => ['required', 'string', 'min:10', 'max:255'],
            'card_description' => ['required', 'string', 'min:10', 'max:255'],
            'card_photo' => ['nullable', 'mimes:png'],
            'is_active' => ['nullable', 'in:1,0'],
        ]);

        $update_card_photo = null;

        if ($request->has('card_photo')) {
            $file = $request->file('card_photo');
            $extension = $file->getClientOriginalExtension();

            $file_name = $request->name . '.' . $extension;

            $path = 'images/regions/';
            $file->move($path, $file_name);

            if (File::exists($region->card_photo)) {
                File::delete($region->card_photo);
            }
            $update_card_photo = $path . $file_name;
        }

        $region->update([
            'type' => $request->type,
            'name' => $request->name,
            'main_description' => $request->main_description,
            'weather_description' => $request->weather_description,
            'card_description' => $request->card_description,
            'card_photo' => $update_card_photo ? $update_card_photo : $region->card_photo,
            'is_active' => $request->is_active ? $request->is_active : 0,
        ]);

        return to_route('regions.index_edit');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $region_id)
    {
        $region = Region::findOrFail($region_id);
        if (File::exists($region->card_photo)) {
            File::delete($region->card_photo);
        }
        $region->delete();
        return to_route('regions.index');
    }
}
