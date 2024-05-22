<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Landmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ActivityController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view activity',['only'=> ['index']]);
        $this->middleware('permission:add activity',['only'=> ['create','store']]);
        $this->middleware('permission:update activity',['only'=> ['update','edit']]);
        $this->middleware('permission:delete activity',['only'=> ['destroy']]);
    }
    public function index(Landmark $landmark)
    {
        $activities = Activity::where('landmark_id', '=' , $landmark)->paginate(10);
        return view('admins.activities.index', ['activities' => $activities,'landmark'=>$landmark]);
    }


    public function create(Landmark $landmark_id)
    {
        $landmarks = Landmark::all();
        return view('admins.activities.create', ['landmarks' => $landmarks, 'landmark_activity' => $landmark_id]);
    }


    public function store(Request $request)
    {
        $landmark = Landmark::findOrFail($request->landmark_id);

        $request->validate([
            'administrative_region_id' => ['exists:administrative_regions,id'],
            'region_id' => ['exists:regions,id'],
            'landmark_id' => ['required', 'exists:landmarks,id'],
            'description' => ['required', 'string', 'min:10'],
            'photo' => ['required', 'mimes:png,jpeg,jpg,webp'],
            'is_active' => ['nullable', 'in:1,0'],
        ]);

        if ($request->has('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();

            $file_name = $request->name . time() .'.' . $extension;

            $path = 'images/activities/';
            $file->move($path, $file_name);
        }

        Activity::create([
            'administrative_region_id' => $landmark->region->administrative_region_id,
            'region_id' => $landmark->region_id,
            'landmark_id' => $request->landmark_id,
            'description' => $request->description,
            'photo' => $path . $file_name,
            'is_active' => $request->is_active ? $request->is_active : 0,
        ]);

        return to_route('activities.index',$request->landmark_id)->with('msg', 'Activity has created successfully');
    }


    // public function show(Activity $activity)
    // {
    //     return view('activities.show', ['activity' => $activity]);
    // }


    public function edit(Activity $activity)
    {
        $landmarks = Landmark::all();
        return view('admins.activities.edit', ['activity' => $activity, 'landmarks' => $landmarks]);
    }


    public function update(Request $request, Activity $activity)
    {
        $landmark = Landmark::findOrFail($request->landmark_id);

        $request->validate([
            'administrative_region_id' => ['exists:administrative_regions,id'],
            'region_id' => ['exists:regions,id'],
            'landmark_id' => ['required', 'exists:landmarks,id'],
            'description' => ['required', 'string', 'min:10'],
            'photo' => ['nullable', 'mimes:png,jpeg,jpg,webp'],
            'is_active' => ['nullable', 'in:1,0'],
        ]);

        $update_photo = null;

        if ($request->has('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();

            $file_name = $request->name . time() .'.' . $extension;

            $path = 'images/activities/';
            $file->move($path, $file_name);

            if (File::exists($activity->photo)) {
                File::delete($activity->photo);
            }

            $update_photo = $path . $file_name;
        }

        $activity->update([
            'administrative_region_id' => $landmark->region->administrative_region_id,
            'region_id' => $landmark->region_id,
            'landmark_id' => $request->landmark_id,
            'description' => $request->description,
            'photo' => $update_photo ? $update_photo : $activity->photo,
            'is_active' => $request->is_active ? $request->is_active : 0,
        ]);

        return to_route('activities.index',$request->landmark_id)->with('msg', 'Activity has updated successfully');
    }


    public function destroy(String $activity_id)
    {
        $activity = Activity::findOrFail($activity_id);
        if (File::exists($activity->photo)) {
            File::delete($activity->photo);
        }
        $landmark = $activity->landmark_id;
        $activity->delete();
        return to_route('activities.index', ['landmark' => $landmark])->with('msg', 'Activity has deleted successfully');
    }
}
