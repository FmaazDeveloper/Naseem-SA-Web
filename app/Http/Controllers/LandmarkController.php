<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\AdministrativeRegion;
use App\Models\Landmark;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LandmarkController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view landmark',['only'=> ['index']]);
        $this->middleware('permission:add landmark',['only'=> ['create','store']]);
        $this->middleware('permission:update landmark',['only'=> ['update','edit']]);
        $this->middleware('permission:delete landmark',['only'=> ['destroy']]);
    }

    public function index(Region $region)
    {
        $landmarks = Landmark::where('region_id', '=' ,$region->id)->paginate(10);
        $activities = Activity::where('region_id', '=' ,$region->id)->get();
        return view('admins.landmarks.index', ['region' => $region, 'landmarks' => $landmarks , 'activities' => $activities]);
    }


    public function create(String $administrative_region_id)
    {
        $administrative_region = AdministrativeRegion::find($administrative_region_id);
        return view('admins.landmarks.create', ['administrative_region' => $administrative_region]);
    }


    public function store(Request $request)
    {
        $region = Region::findOrFail($request->region_id);

        $request->validate([
            'administrative_region_id' => ['exists:administrative_regions,id'],
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
            'administrative_region_id' => $region->administrative_region_id,
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
        $region = Region::findOrFail($request->region_id);

        $request->validate([
            'administrative_region_id' => ['exists:administrative_regions,id'],
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
            'administrative_region_id' => $region->administrative_region_id,
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

