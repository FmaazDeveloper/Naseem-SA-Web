<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\AdministrativeRegion;
use App\Models\Landmark;
use App\Models\Profile;
use App\Models\Region;
use App\Models\User;
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


    public function regions(String $administrative_region_id = null)
    {
        if (is_null($administrative_region_id)) {
            $administrative_regions = AdministrativeRegion::all();
            $regions = Region::where('is_active', true)->whereIn('id', Landmark::where('is_active', true)->pluck('region_id'))->paginate(5);
            $guides = null;
        } else {
            $administrative_regions = AdministrativeRegion::where('id', '=', $administrative_region_id)->get();
            $regions = Region::where('administrative_region_id', '=', $administrative_region_id)->where('is_active', true)
                ->whereIn('id', Landmark::where('is_active', true)->pluck('region_id'))
                ->paginate(5);
            $guides = Profile::whereIn('region_id', Region::where('administrative_region_id', '=', $administrative_region_id)
                ->where('is_active', true)->pluck('id'))
                ->whereIn('user_id', User::where('role','=','guide')->where('is_active', true)->pluck('id'))
                ->get();
                // ->whereIn('id', Landmark::where('is_active', true)->pluck('region_id'))
                // ->whereIn('id', Activity::where('is_active', true)->pluck('region_id'))
        }
        return view('contents.regions', ['administrative_regions' => $administrative_regions, 'regions' => $regions, 'guides' => $guides]);
    }


    public function landmarks(String $region_id = null)
    {
        if (is_null($region_id)) {
            $landmarks = Landmark::where('is_active', true)->paginate(10);
            $regions = Region::where('is_active', true)->get();
            $guides = null;
        } else {
            $landmarks = Landmark::where('is_active', true)->where('region_id', '=', $region_id)
                ->whereIn('id', Activity::where('is_active', true)->pluck('landmark_id'))
                ->paginate(10);
            $regions = Region::where('is_active', true)->where('id', '=', $region_id)->get();
            $guides = Profile::whereIn('region_id', Region::where('id', '=', $region_id)
                ->where('is_active', true)
                ->whereIn('id', Landmark::where('is_active', true)->pluck('region_id'))
                ->whereIn('id', Activity::where('is_active', true)->pluck('region_id'))
                ->pluck('id'))->get();
        }
        return view('contents.landmarks', ['regions' => $regions, 'landmarks' => $landmarks, 'guides' => $guides]);
    }
}
