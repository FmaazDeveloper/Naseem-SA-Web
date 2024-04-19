<?php

namespace App\Http\Controllers;

use App\Models\AdministrativeRegion;
use App\Models\Landmark;
use App\Models\Region;
use Illuminate\Http\Request;

class ContentController extends Controller
{


    public function index(String $administrativeRegion = null)
    {
        if (is_null($administrativeRegion)) {
            $regions = Region::where('is_active', true)->whereNotNull('id')->paginate(10);
        } else {
            $regions = Region::where('administrative_region_id', '=', $administrativeRegion)->where('is_active', true)->whereNotNull('id')->paginate(10);
        }
        return view('contents.index', ['regions' => $regions, 'administrative_region_id' => $administrativeRegion]);
    }


    // public function create()
    // {
    //     //
    // }


    // public function store(Request $request)
    // {
    //     //
    // }


    public function show(String $administrativeRegion = null)
    {
        if (is_null($administrativeRegion)) {
            $regions = Region::where('is_active', true)->paginate(10);
            $landmarks = Landmark::whereIn('region_id', $regions->pluck('id'))
                ->where('is_active', true)
                ->paginate(4);
        } else {
            $regions = Region::where('administrative_region_id', '=', $administrativeRegion)->where('is_active', true)->paginate(10);

            $landmarks = Landmark::whereIn('region_id', $regions->pluck('id'))
                ->where('is_active', true)
                ->paginate(4);
        }
        return view('contents.show', ['regions' => $regions, 'landmarks' => $landmarks]);
    }


    // public function edit(string $id)
    // {
    //     //
    // }


    // public function update(Request $request, string $id)
    // {
    //     //
    // }


    // public function destroy(string $id)
    // {
    //     //
    // }
}
