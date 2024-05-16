<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\AdministrativeRegion;
use App\Models\Landmark;
use App\Models\Region;

class ContentController extends Controller
{
    public function administrative_regions()
    {
        $administrative_regions = AdministrativeRegion::where('is_active', true)->get();
        return response()->json($administrative_regions);
    }
    public function regions(String $administrative_region_id)
    {
        $regions = Region::where('is_active', true)->where('administrative_region_id', '=', $administrative_region_id)->get();
        return response()->json($regions);
    }
    public function landmarks(String $region_id)
    {
        $landmarks = Landmark::where('is_active', true)->where('region_id', '=', $region_id)->get();
        return response()->json($landmarks);
    }
    public function activities(String $landmark_id)
    {
        $activities = Activity::where('is_active', true)->where('landmark_id', '=', $landmark_id)->get();
        return response()->json($activities);
    }
}
