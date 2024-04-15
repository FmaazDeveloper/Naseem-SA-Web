<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Landmark;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LandmarkController extends Controller
{


    public function index(Region $region)
    {
        $landmarks = Landmark::where('region_id', '=' ,$region->id)->get();
        $activities = Activity::where('region_id', '=' ,$region->id)->count();
        return view('admins.landmarks.index', ['landmarks' => $landmarks, 'region' => $region, 'activities' => $activities]);
    }


    public function create(Region $region_id)
    {
        $regions = Region::all();
        return view('admins.landmarks.create', ['regions' => $regions, 'region_landmark' => $region_id]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'region_id' => ['required', 'exists:regions,id'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:10', 'max:255'],
            'location' => ['required', 'string', 'min:3', 'max:255'],
            'photo' => ['required', 'mimes:png'],
            'is_active' => ['nullable', 'in:1,0'],
        ]);

        if ($request->has('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();

            $file_name = $request->name . time() .'.' . $extension;

            $path = 'images/landmarks/';
            $file->move($path, $file_name);
        }

        Landmark::create([
            'region_id' => $request->region_id,
            'name' => $request->name,
            'description' => $request->description,
            'location' => $request->location,
            'photo' => $path . $file_name,
            'is_active' => $request->is_active ? $request->is_active : 0,
        ]);

        return to_route('landmarks.index', $request->region_id)->with('msg', 'Landmark has created successfully');
    }


    // public function show(Landmark $landmark)
    // {
    //     return view('landmarks.show', ['landmark' => $landmark]);
    // }


    public function edit(Landmark $landmark)
    {
        $regions = Region::all();
        return view('admins.landmarks.edit', ['landmark' => $landmark, 'regions' => $regions]);
    }


    public function update(Request $request, Landmark $landmark)
    {
        $request->validate([
            'region_id' => ['required', 'exists:regions,id'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'description' => ['required', 'string', 'min:10', 'max:255'],
            'location' => ['required', 'string', 'min:3', 'max:255'],
            'photo' => ['nullable', 'mimes:png'],
            'is_active' => ['nullable', 'in:1,0'],
        ]);

        $update_photo = null;

        if ($request->has('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();

            $file_name = $request->name . time() .'.' . $extension;

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
            'is_active' => $request->is_active ? $request->is_active : 0,
        ]);

        return to_route('landmarks.index', $request->region_id)->with('msg', 'Landmark has updated successfully');
    }


    public function destroy(String $landmark_id)
    {
        $landmark = Landmark::findOrFail($landmark_id);
        if (File::exists($landmark->photo)) {
            File::delete($landmark->photo);
        }
        $landmark->delete();
        $region = $landmark->region_id;
        return to_route('landmarks.index',['region'=>$region])->with('msg', 'Landmark has deleted successfully');
    }
}

