<?php

namespace App\Http\Controllers;

use App\Models\AdministrativeRegion;
use App\Models\Landmark;
use App\Models\Profile;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;

class ContentController extends Controller
{


    public function index()
    {
        return view('contents.index');
    }


    public function administrative_regions(String $administrative_region_id = null)
    {
        if (is_null($administrative_region_id)) {
            $administrative_regions = AdministrativeRegion::all();
            $guides = null;
        } else {
            $administrative_regions = AdministrativeRegion::where('id', '=', $administrative_region_id)->get();
            $guides = Profile::whereIn('region_id', Region::where('administrative_region_id', '=', $administrative_region_id)
                ->where('is_active', true)->pluck('id'))
                ->whereIn('user_id', User::where('role', '=', 'guide')->where('is_active', true)->pluck('id'))
                ->get();
        }
        return view('contents.administrative_regions', ['administrative_regions' => $administrative_regions, 'guides' => $guides]);
    }


    public function regions(String $administrative_region_id = null)
    {
        if (is_null($administrative_region_id)) {
            $regions_sliders = Region::where('is_active', true)->get();
            $regions = Region::where('is_active', true)->paginate(5);
            $guides = null;
        } else {
            $regions_sliders = Region::where('is_active', true)->where('administrative_region_id', '=', $administrative_region_id)->get();
            $regions = Region::where('is_active', true)->where('administrative_region_id', '=', $administrative_region_id)->paginate(5);
            $guides = Profile::whereIn('region_id', Region::where('administrative_region_id', '=', $administrative_region_id)
                ->where('is_active', true)
                ->whereIn('id', Landmark::where('is_active', true)->pluck('region_id'))
                ->pluck('id'))->get();
        }
        return view('contents.regions', ['regions' => $regions, 'regions_sliders' => $regions_sliders, 'guides' => $guides]);
    }

    public function landmarks(String $region_id = null, String $landmrk_id = null)
    {
        if (is_null($region_id)) {
            $landmarks_sliders = Landmark::where('is_active', true)->get();
            $landmarks = Landmark::where('is_active', true)->paginate(5);
            $guides = null;
        } else {
            if (is_null($landmrk_id)) {
                $landmarks_sliders = Landmark::where('is_active', true)->where('region_id', '=', $region_id)->get();
                $landmarks = Landmark::where('is_active', true)->where('region_id', '=', $region_id)->paginate(5);
            } else {
                $landmarks_sliders = Landmark::where('id', '=', $landmrk_id)->where('is_active', true)->where('region_id', '=', $region_id)->get();
                $landmarks = Landmark::where('id', '=', $landmrk_id)->where('is_active', true)->where('region_id', '=', $region_id)->get();
            }
            $guides = Profile::whereIn('region_id', Region::where('id', '=', $region_id)
                ->where('is_active', true)
                ->whereIn('id', Landmark::where('is_active', true)->pluck('region_id'))
                ->pluck('id'))->get();
        }
        return view('contents.landmarks', ['landmarks' => $landmarks, 'landmarks_sliders' => $landmarks_sliders, 'guides' => $guides]);
    }
}
