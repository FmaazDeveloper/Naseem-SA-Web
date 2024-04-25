<?php

namespace App\Http\Controllers;

use App\Models\AdministrativeRegion;
use App\Models\Order;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{


    public function index()
    {
        //
    }


    public function create(AdministrativeRegion $region_id = null)
    {
        if (is_null($region_id)) {
            $regions = AdministrativeRegion::where('is_active', true)->get();
            $guides = null;
        } else {
            $regions = AdministrativeRegion::where('is_active', true)->where('id', '=', $region_id->id)->get();
            $users = User::where('is_active', true)->where('role', '=', 'guide')->get();
            $guides = Profile::whereIn('user_id', $users->pluck('id'))
                ->whereIn('region_id', $regions->pluck('id'))
                ->get();
        }
        $tourist = Order::where('tourist_id', '=', Auth::user()->id)->where('status_id', '=', 4)->first();
        $regions = AdministrativeRegion::where('is_active', true)->get();

        return view('orders.create', ['regions' => $regions, 'guides' => $guides, 'region_id' => $region_id, 'tourist' => $tourist]);
    }


    public function store(Request $request)
    {
        $region = Profile::where('user_id', '=', $request->guide_id)->first();
        $request->validate([
            'tourist_id' => ['exists:users,id'],
            'guide_id' => ['required', 'exists:users,id'],
            'region_id' => ['exists:administrative_regions,id'],
            'status_id' => ['exists:status_types,id'],
        ]);

        Order::create([
            'tourist_id' => Auth::user()->id,
            'guide_id' => $request->guide_id,
            'region_id' => $region->region_id,
            'status_id' => 4,
        ]);

        return to_route('orders.create')->with('msg', 'Order has sent successfully');
    }


    public function show(Order $order)
    {
        //
    }


    public function edit(Order $order)
    {
        //
    }


    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status_id' => ['required','exists:status_types,id'],
        ]);

        $order->update([
            'status_id' => $request->status_id,
            'closed_at' => now(),
        ]);

        return to_route('orders.create')->with('msg', 'Order has canceled successfully');
    }


    public function destroy(Order $order)
    {
        //
    }
}
