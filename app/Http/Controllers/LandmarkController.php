<?php

namespace App\Http\Controllers;

use App\Models\Landmark;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LandmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Region $region)
    {
        $landmarks = Landmark::all();
        return view('admins.landmarks.index', ['landmarks' => $landmarks, 'region' => $region]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Region $region_id)
    {
        $regions = Region::all();
        return view('admins.landmarks.create', ['regions' => $regions, 'region_landmark' => $region_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'region_id' => ['required', 'exists:regions,id'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:10', 'max:255'],
            'location' => ['required', 'string', 'min:3', 'max:255'],
            'photo' => ['required', 'mimes:png'],
        ]);

        if ($request->has('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();

            $file_name = $request->name . '.' . $extension;

            $path = 'images/landmarks/';
            $file->move($path, $file_name);
        }

        Landmark::create([
            'region_id' => $request->region_id,
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'photo' => $request->photo,
        ]);

        return to_route('landmarks.store',$request->region_id);
    }

    /**
     * Display the specified resource.
     */
    // public function show(Landmark $landmark)
    // {
    //     return view('landmarks.show', ['landmark' => $landmark]);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Landmark $landmark)
    {
        $regions = Region::all();
        return view('admins.landmarks.edit', ['landmark' => $landmark, 'regions' => $regions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Landmark $landmark)
    {
        request()->validate([
            'region_id' => ['required', 'exists:regions,id'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:10', 'max:255'],
            'location' => ['required', 'string', 'min:3', 'max:255'],
            'photo' => ['nullable', 'mimes:png'],
        ]);

        $update_photo = null;

        if ($request->has('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();

            $file_name = $request->name . '.' . $extension;

            $path = 'images/landmarks/';
            $file->move($path, $file_name);

            if (File::exists($landmark->photo)) {
                File::delete($landmark->photo);
            }

            $update_photo = $path . $file_name;
        }

        $landmark->update([
            'region_id' => $request->region_id,
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'photo' => $update_photo ? $update_photo : $landmark->photo,
        ]);

        return to_route('landmarks.store',$request->region_id);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $landmark_id)
    {
        $landmark = Landmark::findOrFail($landmark_id);
        if (File::exists($landmark->photo)) {
            File::delete($landmark->photo);
        }
        $landmark->delete();
        return to_route('landmarks.index');
    }
}
