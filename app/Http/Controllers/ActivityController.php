<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Landmark;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Landmark $landmark)
    {
        $activities = Activity::all();
        return view('admins.activities.index', ['activities' => $activities,'landmark'=>$landmark]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Landmark $landmark_id)
    {
        $landmarks = Landmark::all();
        return view('admins.activities.create', ['landmarks' => $landmarks, 'landmark_activity' => $landmark_id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $landmark = Landmark::findOrFail($request->landmark_id);

        request()->validate([
            // 'region_id' => ['required', 'exists:regions,id'],
            'landmark_id' => ['required', 'exists:landmarks,id'],
            'description' => ['required', 'string', 'min:10'],
        ]);

        Activity::create([
            'region_id' => $landmark->region_id,
            'landmark_id' => $request->landmark_id,
            'description' => $request->description,
        ]);

        return to_route('activities.index',$request->landmark_id);
    }

    /**
     * Display the specified resource.
     */
    // public function show(Activity $activity)
    // {
    //     return view('activities.show', ['activity' => $activity]);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        $landmarks = Landmark::all();
        return view('admins.activities.edit', ['activity' => $activity, 'landmarks' => $landmarks]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        $landmark = Landmark::findOrFail($request->landmark_id);

        request()->validate([
            'landmark_id' => ['required', 'exists:landmarks,id'],
            'description' => ['required', 'string', 'min:10'],
        ]);

        $activity->update([
            'region_id' => $landmark->region_id,
            'landmark_id' => $request->landmark_id,
            'description' => $request->description,
        ]);

        return to_route('activities.index',$request->landmark_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $activity_id)
    {
        $activity = Activity::findOrFail($activity_id);
        $landmark = $activity->landmark_id;
        $activity->delete();
        return to_route('activities.index', ['landmark' => $landmark]);
    }
}
