<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\AdministrativeRegion;
use App\Models\Landmark;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class AdministrativeRegionController extends Controller
{


    public function index()
    {
        $administrative_regions = AdministrativeRegion::all();
        $regions = Region::all();
        $landmarks = Landmark::all();
        $activities = Activity::all();
        return view(
            'admins.administrative_regions.index',
            [
                'administrative_regions' => $administrative_regions,
                'regions' => $regions,
                'landmarks' => $landmarks,
                'activities' => $activities,
            ]
        );
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
        if(is_null($administrativeRegion)){
            $regions = Region::all();
        }else{
            $regions = Region::where('administrative_region_id', '=' ,$administrativeRegion)->get();
        }
        // return view('map',['regions' => $regions]);
        return view('admins.administrative_regions.show', ['administrativeRegions' => $administrativeRegion]);
    }


    public function edit(AdministrativeRegion $administrativeRegion)
    {
        return view('admins.administrative_regions.edit', ['administrativeRegion' => $administrativeRegion]);
    }


    public function update(Request $request, AdministrativeRegion $administrativeRegion)
    {
        $request->validate([
            'admin_id' => ['exists:users,id'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'photo' => ['nullable', 'mimes:png'],
            'is_active' => ['nullable', 'in:1,0'],
        ]);

        $update_photo = null;

        if ($request->has('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();

            $file_name = $request->name . time() . '.' . $extension;

            $path = 'images/administrative_regions/';
            $file->move($path, $file_name);

            if (File::exists($administrativeRegion->photo)) {
                File::delete($administrativeRegion->photo);
            }
            $update_photo = $path . $file_name;
        }

        $administrativeRegion->update([
            'admin_id' => Auth::user()->id,
            'name' => $request->name,
            'photo' => $update_photo ? $update_photo : $administrativeRegion->photo,
            'is_active' => $request->is_active ? $request->is_active : 0,
        ]);

        return to_route('administrative_regions.index')->with('msg', 'Administrative region has updated successfully');
    }


    // public function destroy(AdministrativeRegion $administrativeRegion)
    // {
    //     //
    // }

}
