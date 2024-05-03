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

class RequestOrderController extends Controller
{

    public function index(String $region_id = null)
    {
        if (is_null($region_id)) {
            $regions = Region::where('is_active', true)
                ->whereIn('id', Landmark::where('is_active', true)->pluck('region_id'))
                ->whereIn('id', Profile::whereNotNull('region_id')
                    ->whereIn('user_id', User::where('is_active', true)
                        ->where('role', '=', 'guide')->pluck('id'))
                    ->pluck('region_id'))
                ->paginate(5);
            $guides = Profile::whereNotNull('region_id')
                ->whereIn('user_id', User::where('is_active', true)
                    ->where('role', '=', 'guide')->pluck('id'))
                ->get();

            // $regions = Profile::whereIn('user_id', User::where('is_active', true)->where('role', '=', 'guide')->pluck('id'))
            //     ->whereIn('region_id', Region::where('is_active', true)
            //         ->whereIn('id', Landmark::where('is_active', true)->pluck('region_id'))->pluck('id'))
            //     ->paginate(5);
        } else {
            $regions = Region::where('is_active', true)->where('id', '=', $region_id)
                ->whereIn('id', Landmark::where('is_active', true)->pluck('region_id'))
                ->paginate(5);
            $guides = Profile::where('region_id', '=', $region_id)
                ->whereIn('region_id', User::where('is_active', true)
                    ->where('role', '=', 'guide')->pluck('id'))->get();
        }
        return view('orders.index', ['regions' => $regions, 'guides' => $guides]);
    }


    public function create(String $user_id)
    {
        $guide = Profile::where('user_id', '=', $user_id)->first();
        $actived_order = Order::where('tourist_id', '=', Auth::user()->id)->where('status', '=', 'Actived')->first();
        $pending_order = Order::where('tourist_id', '=', Auth::user()->id)->where('status', '=', 'Pending')->first();
        return view('orders.create', ['guide' => $guide, 'actived_order' => $actived_order, 'pending_order' => $pending_order]);
    }


    public function store(Request $request, String $profile_id)
    {
        $profile = Profile::findOrFail($profile_id);
        $request->validate([
            'tourist_id' => ['exists:users,id'],
            'guide_id' => ['exists:users,id'],
            'region_id' => ['exists:regions,id'],
            'status' => ['required', 'in:Actived,Pending,Completed,Canceled,Rejected'],
            'number_of_people' => ['required', 'numeric', 'min:1'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        Order::create([
            'tourist_id' => Auth::user()->id,
            'guide_id' => $profile->user_id,
            'region_id' => $profile->region_id,
            'status' => 'Pending',
            'number_of_people' => $request->number_of_people,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return to_route('request_orders.create', $profile->user_id)->with('msg', 'Order has sent successfully');
    }


    public function show()
    {
        $actived_orders = Order::where('guide_id', '=', Auth::user()->id)->where('status', '=', 'Actived')->get();
        $pending_orders = Order::where('guide_id', '=', Auth::user()->id)->where('status', '=', 'Pending')->get();
        return view('orders.show', ['actived_orders' => $actived_orders, 'pending_orders' => $pending_orders]);
    }


    public function edit(Order $order)
    {
        //
    }


    public function update(Request $request, Order $order_id)
    {
        $request->validate([
            'status' => ['required', 'in:Actived,Pending,Completed,Canceled,Rejected'],
        ]);

        $order_id->update([
            'status' => $request->status,
            'closed_at' => now(),
        ]);

        switch ($request->status) {
            case 'Canceled':
                return to_route('request_orders.create', $order_id->guide_id)->with('msg', 'Order has canceled successfully');
            case 'Completed':
                return to_route('request_orders.create', $order_id->guide_id)->with('msg', 'Trip has complated successfully');
            case 'Actived':
                return to_route('request_orders.show', $order_id->guide_id)->with('msg', 'Trip has actived successfully');
            case 'Rejected':
                return to_route('request_orders.show', $order_id->guide_id)->with('msg', 'Trip has rejected successfully');
            default:
                return to_route('request_orders.create', $order_id->guide_id)->with('msg', 'Order has updated successfully');
        }

    }


    public function destroy(Order $order)
    {
        //
    }
}
