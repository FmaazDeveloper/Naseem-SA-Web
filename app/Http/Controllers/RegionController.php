<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\AdministrativeRegion;
use App\Models\Landmark;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RegionController extends Controller
{


    public function index(AdministrativeRegion $administrative_region)
    {
        $regions = Region::where('administrative_region_id', '=' ,$administrative_region->id)->paginate(10);
        $landmarks = Landmark::where('administrative_region_id', '=' ,$administrative_region->id)->get();
        $activities = Activity::where('administrative_region_id', '=' ,$administrative_region->id)->get();
        return view('admins.regions.index', ['administrative_region' => $administrative_region, 'regions' => $regions, 'landmarks' => $landmarks, 'activities' => $activities]);
    }


    public function create(AdministrativeRegion $administrative_region_id)
    {
        $administrative_regions = AdministrativeRegion::all();
        return view('admins.regions.create', ['administrative_regions' => $administrative_regions, 'administrative_region_region' => $administrative_region_id]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'administrative_region_id' => ['required', 'exists:administrative_regions,id'],
            'type' => ['required', 'string'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'main_description' => ['required', 'string', 'min:30'],
            'weather_description' => ['required', 'string', 'min:10', 'max:255'],
            'card_description' => ['required', 'string', 'min:10', 'max:255'],
            'card_photo' => ['required', 'mimes:png'],
            'is_active' => ['nullable', 'in:1,0'],
        ]);

        if ($request->has('card_photo')) {
            $file = $request->file('card_photo');
            $extension = $file->getClientOriginalExtension();

            $file_name = $request->name . time() . '.' . $extension;

            $path = '/images/regions/';
            $file->move($path, $file_name);
        }

        Region::create([
            'administrative_region_id' => $request->administrative_region_id,
            'type' => $request->type,
            'name' => $request->name,
            'main_description' => $request->main_description,
            'weather_description' => $request->weather_description,
            'card_description' => $request->card_description,
            'card_photo' => $path . $file_name,
            'is_active' => $request->is_active ? $request->is_active : 0,
        ]);

        return to_route('regions.index',$request->administrative_region_id)->with('msg', 'Region has created successfully');
    }


    public function show(Region $region)
    {
        return view('regions.show', ['region' => $region]);
    }


    public function edit(Region $region)
    {
        $administrative_regions = AdministrativeRegion::all();
        return view('admins.regions.edit', ['region' => $region, 'administrative_regions' => $administrative_regions]);
    }


    public function update(Request $request, Region $region)
    {

        $request->validate([
            'administrative_region_id' => ['required', 'exists:administrative_regions,id'],
            'type' => ['required', 'string', 'in:City,Island'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'main_description' => ['required', 'string', 'min:30'],
            'weather_description' => ['required', 'string', 'min:10', 'max:255'],
            'card_description' => ['required', 'string', 'min:10', 'max:255'],
            'card_photo' => ['nullable', 'mimes:png'],
            'is_active' => ['nullable', 'in:1,0'],
        ]);

        $update_card_photo = null;

        if ($request->has('card_photo')) {
            $file = $request->file('card_photo');
            $extension = $file->getClientOriginalExtension();

            $file_name = $request->name . time() . '.' . $extension;

            $path = '/images/regions/';
            $file->move($path, $file_name);

            if (File::exists($region->card_photo)) {
                File::delete($region->card_photo);
            }
            $update_card_photo = $path . $file_name;
        }

        $region->update([
            'administrative_region_id' => $request->administrative_region_id,
            'type' => $request->type,
            'name' => $request->name,
            'main_description' => $request->main_description,
            'weather_description' => $request->weather_description,
            'card_description' => $request->card_description,
            'card_photo' => $update_card_photo ? $update_card_photo : $region->card_photo,
            'is_active' => $request->is_active ? $request->is_active : 0,
        ]);

        return to_route('regions.index',$request->administrative_region_id)->with('msg', 'Region has updated successfully');
    }


    public function destroy(String $id)
    {
        $region = Region::findOrFail($id);
        if (File::exists($region->card_photo)) {
            File::delete($region->card_photo);
        }
        $region->delete();
        return to_route('regions.index',$region->administrative_region->id)->with('msg', 'Region has deleted successfully');
    }
}
