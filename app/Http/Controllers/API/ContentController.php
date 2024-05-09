<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\AdministrativeRegion;
use App\Models\Landmark;
use App\Models\Region;
use Illuminate\Http\Request;

class ContentController extends Controller
{

    public function administrative_regions()
    {
        $administrative_regions = AdministrativeRegion::where('is_active', true)->get();
        return response()->json($administrative_regions);
    }

    public function regions()
    {
        $regions = Region::where('is_active', true)
        ->whereIn('id', Landmark::where('is_active', true)->pluck('region_id'))
        ->get();
        return response()->json($regions);
    }



    public function landmarks(String $region_id)
    {
        $landmarks = Landmark::where('is_active', true)->where('region_id', '=', $region_id)->get();
        return response()->json($landmarks);
    }


    // public function activities()
    // {
    //     $activities = Activity::where('is_active', true)->get();
    //     return response()->json($activities);
    // }
}
