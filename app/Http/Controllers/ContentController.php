<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\AdministrativeRegion;
use App\Models\Landmark;
use App\Models\Region;
use Illuminate\Http\Request;

class ContentController extends Controller
{


    public function index(String $administrativeRegion = null)
    {
        if (is_null($administrativeRegion)) {
            $regions = Region::where('is_active', true)->paginate(10);
        } else {
            $regions = Region::where('administrative_region_id', '=', $administrativeRegion)->where('is_active', true)->paginate(10);
            $administrativeRegion = AdministrativeRegion::find($administrativeRegion);
        }
        return view('contents.index', ['regions' => $regions, 'administrative_region_id' => $administrativeRegion]);
    }


    public function regions(String $region_id = null, String $administrative_region_id = null)
    {
        if (is_null($region_id) && is_null($administrative_region_id)) {
            $region = Region::where('is_active', true)
                ->orWhere('administrative_region_id', '=', $administrative_region_id)
                ->orWhere('id', '=', $region_id)
                ->get();

                $landmarks = Landmark::whereIn('region_id', $region->pluck('id'))
                ->where('is_active', true)
                ->paginate(4);

            $regions = Region::whereIn('id', $region->pluck('id'))->paginate(5);
        } else {
            $region = Region::where('id', '=', $region_id)
                ->orWhere('administrative_region_id', '=', $administrative_region_id)
                ->where('is_active', true)
                ->paginate(5);

            $landmarks = Landmark::whereIn('region_id', $region->pluck('id'))
                ->where('is_active', true)
                ->paginate(4);

            $regions = Region::whereIn('id', $region->pluck('id'))->paginate(5);
        }
        $administrative_regions = AdministrativeRegion::where('is_active', true)->get();
        return view('contents.regions', ['administrative_regions' => $administrative_regions, 'regions' => $regions, 'landmarks' => $landmarks]);
    }


    public function landmarks(String $landmark_id = null, String $region_id = null)
    {
        if (is_null($landmark_id)) {
            $landmark = Landmark::where('is_active', true)->orWhere('region_id', '=', $region_id)->paginate(15);

            $activities = Activity::whereIn('landmark_id', $landmark->pluck('id'))
                ->where('is_active', true)
                ->paginate(4);

            $landmarks = Landmark::whereIn('id', $landmark->pluck('id'))->paginate(5);
        } else {
            $landmark = Landmark::where('region_id', '=', $landmark_id)->orWhere('region_id', '=', $region_id)->where('is_active', true)->paginate(15);

            $activities = Activity::whereIn('landmark_id', $landmark->pluck('id'))
                ->where('is_active', true)
                ->paginate(4);

            $landmarks = Landmark::whereIn('id', $landmark->pluck('id'))->paginate(5);
        }
        $regions = Region::where('is_active', true)->get();
        return view('contents.landmarks', ['regions' => $regions, 'landmarks' => $landmarks, 'activities' => $activities]);
    }
}
