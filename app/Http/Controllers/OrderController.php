<?php

namespace App\Http\Controllers;

use App\Models\AdministrativeRegion;
use App\Models\Landmark;
use App\Models\Order;
use App\Models\Profile;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{


    public function index(String $region_id = null)
    {
        if (is_null($region_id)) {
            // $guides = Profile::whereIn('user_id', User::where('is_active', true)->where('role', '=', 'guide')->pluck('id'))
            // ->whereIn('region_id', Region::where('is_active', true)->pluck('id'))
            // ->orWhereIn('user_id', Order::where('status_id', '!=', 3)->pluck('guide_id'))
            // ->get();
            $regions = Region::where('is_active', true)
                ->whereIn('id', Landmark::where('is_active', true)->pluck('region_id'))
                ->whereIn('id', Profile::whereNotNull('region_id')->pluck('region_id'))
                ->paginate(5);
        } else {
            // $guides = Profile::whereIn('user_id', User::where('is_active', true)->where('role', '=', 'guide')->pluck('id'))
            // ->whereIn('region_id', Region::where('is_active', true)->where('id', '=', $region_id)->pluck('id'))
            // ->orWhereIn('user_id', Order::where('status_id', '!=', 3)->pluck('guide_id'))
            // ->get();
            $regions = Region::where('is_active', true)->where('id', '=', $region_id)
                ->whereIn('id', Landmark::where('is_active', true)->pluck('region_id'))
                ->whereIn('id', Profile::where('region_id', '=', $region_id)->pluck('region_id'))
                ->paginate(5);
        }
        return view('orders.index', ['regions' => $regions]);
    }


    public function create(AdministrativeRegion $region_id = null)
    {
        if (is_null($region_id)) {
            $regions = AdministrativeRegion::where('is_active', true)->get();
            $guides = null;
        } else {
            $guides = Profile::whereIn('user_id', User::where('is_active', true)->where('role', '=', 'guide')->pluck('id'))
                ->whereIn('region_id', AdministrativeRegion::where('is_active', true)->where('id', '=', $region_id->id)->pluck('id'))
                ->orWhereIn('user_id', Order::where('status_id', '!=', 3)->pluck('guide_id'))
                ->get();
        }
        $tourist = Order::where('tourist_id', '=', Auth::user()->id)->whereIn('status_id', [4, 3])->first();
        $regions = AdministrativeRegion::where('is_active', true)->get();

        return view('orders.create', ['regions' => $regions, 'guides' => $guides, 'region_id' => $region_id, 'tourist' => $tourist]);
    }


    public function store(Request $request, String $profile_id)
    {
        $profile = Profile::findOrFail($profile_id);
        $request->validate([
            'tourist_id' => ['exists:users,id'],
            'guide_id' => ['exists:users,id'],
            'region_id' => ['exists:administrative_regions,id'],
            'status_id' => ['exists:status_types,id'],
            'number_of_people' => ['required', 'numeric', 'min:1'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        Order::create([
            'tourist_id' => Auth::user()->id,
            'guide_id' => $profile->user_id,
            'region_id' => $profile->region_id,
            'status_id' => 4,
            'number_of_people' => $request->number_of_people,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return to_route('orders.tourist', $profile->user_id)->with('msg', 'Order has sent successfully');
    }


    public function tourist(String $user_id)
    {
        $guide = Profile::where('user_id', '=', $user_id)->first();
        $tourist = Order::where('tourist_id', '=', Auth::user()->id)->where('status_id', '=', 3)->orWhere('status_id', '=', 4)->first();
        return view('orders.tourist', ['guide' => $guide, 'tourist' => $tourist]);
    }


    public function guide()
    {
        $orders = Order::where('guide_id', '=', Auth::user()->id)->where('status_id', '=', 3)->orWhere('status_id', '=', 4)->get();
        return view('orders.guide', ['orders' => $orders]);
    }


    public function edit(Order $order)
    {
        //
    }


    public function update(Request $request, Order $order_id)
    {
        $request->validate([
            'status_id' => ['required', 'exists:status_types,id'],
        ]);

        $order_id->update([
            'status_id' => $request->status_id,
            'closed_at' => now(),
        ]);

        if ($request->status_id == 6) {
            return to_route('orders.tourist', $order_id->guide_id)->with('msg', 'Order has canceled successfully');
        } elseif ($request->status_id == 5) {
            return to_route('orders.tourist', $order_id->guide_id)->with('msg', 'Trip has complated successfully');
        } elseif ($request->status_id == 3) {
            return to_route('orders.guide', $order_id->guide_id)->with('msg', 'Trip has actived successfully');
        } elseif ($request->status_id == 7) {
            return to_route('orders.guide', $order_id->guide_id)->with('msg', 'Trip has rejected successfully');
        } else {
            return to_route('orders.tourist', $order_id->guide_id)->with('msg', 'Order has updated successfully');
        }
    }


    public function destroy(Order $order)
    {
        //
    }
}
