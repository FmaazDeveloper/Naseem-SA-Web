<?php

namespace App\Http\Controllers;

use App\Models\AdministrativeRegion;
use App\Models\Order;
use App\Models\Region;
use Illuminate\Http\Request;


class DashboardController extends Controller
{


    public function index()
    {
        $administrative_regions = AdministrativeRegion::all();
        $orders = [];
        $complete_orders = [];
        $active_orders = [];
        $pending_orders = [];
        $cancel_orders = [];
        $reject_orders = [];
        foreach ($administrative_regions as $administrative_region) {
            $orders[$administrative_region->id] = Order::whereIn('region_id', Region::where('administrative_region_id', $administrative_region->id)->pluck('id'))->count();
            $complete_orders[$administrative_region->id] = Order::whereIn('region_id', Region::where('administrative_region_id', $administrative_region->id)->pluck('id'))->where('status', 'completed')->count();
            $active_orders[$administrative_region->id] = Order::whereIn('region_id', Region::where('administrative_region_id', $administrative_region->id)->pluck('id'))->where('status', 'actived')->count();
            $pending_orders[$administrative_region->id] = Order::whereIn('region_id', Region::where('administrative_region_id', $administrative_region->id)->pluck('id'))->where('status', 'pending')->count();
            $cancel_orders[$administrative_region->id] = Order::whereIn('region_id', Region::where('administrative_region_id', $administrative_region->id)->pluck('id'))->where('status', 'cancelled')->count();
            $reject_orders[$administrative_region->id] = Order::whereIn('region_id', Region::where('administrative_region_id', $administrative_region->id)->pluck('id'))->where('status', 'rejected')->count();
        }
        return view('admins.dashboards.index', [
            'administrative_regions' => $administrative_regions,
            'orders' => $orders,
            'complete_orders' => $complete_orders,
            'active_orders' => $active_orders,
            'pending_orders' => $pending_orders,
            'cancel_orders' => $cancel_orders,
            'reject_orders' => $reject_orders,
        ]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
