<?php

namespace App\Http\Controllers;

use App\Mail\Order\OrderAcceptMail;
use App\Mail\Order\OrderCancelMail;
use App\Mail\Order\OrderCompleteMail;
use App\Mail\Order\OrderRejectMail;
use App\Mail\Order\OrderRequestMail;
use App\Models\Landmark;
use App\Models\Order;
use App\Models\Profile;
use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RequestOrderController extends Controller
{

    private function checkAccountActivation()
    {
        $user = Auth::user();

        if (!$user->is_active) {
            abort(403, 'Your account is not activated');
        }
    }
    public function index(String $region_id = null)
    {
        $this->checkAccountActivation();

        if (is_null($region_id)) {
            $regions = Region::where('is_active', true)
                ->whereIn('id', Landmark::where('is_active', true)->pluck('region_id'))
                ->whereIn('id', Profile::whereNotNull('region_id')
                    ->whereIn('user_id', User::where('is_active', true)
                        ->where('role', '=', 'guide')->pluck('id'))
                    ->pluck('region_id'))
                ->whereIn('id', Profile::whereNotNull('certificate')
                    ->whereIn('user_id', User::where('is_active', true)
                        ->where('role', '=', 'guide')->whereNotNull('email_verified_at')->pluck('id'))
                    ->pluck('region_id'))
                ->paginate(5);
        } else {
            $regions = Region::where('is_active', true)->where('id', '=', $region_id)
                ->whereIn('id', Landmark::where('is_active', true)->pluck('region_id'))
                ->whereIn('id', Profile::where('region_id','=', $region_id)
                    ->whereIn('user_id', User::where('is_active', true)
                        ->where('role', '=', 'guide')->whereNotNull('email_verified_at')->pluck('id'))
                    ->pluck('region_id'))
                ->paginate(5);
        }
        return view('orders.index', ['regions' => $regions]);
    }


    public function create(String $user_id)
    {
        $this->checkAccountActivation();
        $guide = Profile::where('user_id', '=', $user_id)->first();
        $actived_order = Order::where('tourist_id', '=', Auth::user()->id)->where('status', '=', 'Actived')->first();
        $pending_order = Order::where('tourist_id', '=', Auth::user()->id)->where('status', '=', 'Pending')->first();
        return view('orders.create', ['guide' => $guide, 'actived_order' => $actived_order, 'pending_order' => $pending_order]);
    }


    public function store(Request $request, String $profile_id)
    {
        $this->checkAccountActivation();
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

        $order = Order::create([
            'tourist_id' => Auth::user()->id,
            'guide_id' => $profile->user_id,
            'region_id' => $profile->region_id,
            'status' => 'Pending',
            'number_of_people' => $request->number_of_people,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        Mail::to($order->tourist->email)->send(new OrderRequestMail([
            'id' => $order->id, 'name' => $order->tourist->name, 'start_date' => $request->start_date, 'end_date' => $request->end_date,
            'region' => $order->region->name, 'number_of_people' => $request->number_of_people, 'role' => 'tourist',
        ]));
        Mail::to($order->guide->email)->send(new OrderRequestMail([
            'id' => $order->id, 'name' => $order->tourist->name, 'start_date' => $request->start_date, 'end_date' => $request->end_date,
            'region' => $order->region->name, 'number_of_people' => $request->number_of_people, 'role' => 'guide',
        ]));
        return to_route('request_orders.create', $profile->user_id)->with('msg', 'Order has sent successfully');
    }


    public function show()
    {
        $this->checkAccountActivation();
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
        $this->checkAccountActivation();
        $request->validate([
            'status' => ['required', 'in:Actived,Pending,Completed,Canceled,Rejected'],
        ]);

        $order_id->update([
            'status' => $request->status,
            'closed_at' => now(),
        ]);

        switch ($request->status) {
            case 'Canceled':
                Mail::to($order_id->tourist->email)->send(new OrderCancelMail([
                    'id' => $order_id->id, 'name' => $order_id->tourist->name, 'start_date' => $request->start_date, 'end_date' => $request->end_date,
                    'region' => $order_id->region->name, 'number_of_people' => $request->number_of_people, 'role' => 'tourist',
                ]));
                Mail::to($order_id->guide->email)->send(new OrderCancelMail([
                    'id' => $order_id->id, 'name' => $order_id->tourist->name, 'start_date' => $request->start_date, 'end_date' => $request->end_date,
                    'region' => $order_id->region->name, 'number_of_people' => $request->number_of_people, 'role' => 'guide',
                ]));
                return to_route('request_orders.create', $order_id->guide_id)->with('msg', 'Order has canceled successfully');
            case 'Completed':
                Mail::to($order_id->tourist->email)->send(new OrderCompleteMail([
                    'id' => $order_id->id, 'name' => $order_id->tourist->name, 'start_date' => $request->start_date, 'end_date' => $request->end_date,
                    'region' => $order_id->region->name, 'number_of_people' => $request->number_of_people, 'role' => 'tourist', 'guide_name' => $order_id->guide->name,
                ]));
                Mail::to($order_id->guide->email)->send(new OrderCompleteMail([
                    'id' => $order_id->id, 'name' => $order_id->tourist->name, 'start_date' => $request->start_date, 'end_date' => $request->end_date,
                    'region' => $order_id->region->name, 'number_of_people' => $request->number_of_people, 'role' => 'guide',
                ]));
                return to_route('request_orders.create', $order_id->guide_id)->with('msg', 'Trip has complated successfully');
            case 'Actived':
                Mail::to($order_id->tourist->email)->send(new OrderAcceptMail([
                    'id' => $order_id->id, 'name' => $order_id->tourist->name, 'start_date' => $request->start_date, 'end_date' => $request->end_date,
                    'region' => $order_id->region->name, 'number_of_people' => $request->number_of_people, 'role' => 'tourist',
                ]));
                Mail::to($order_id->guide->email)->send(new OrderAcceptMail([
                    'id' => $order_id->id, 'name' => $order_id->tourist->name, 'start_date' => $request->start_date, 'end_date' => $request->end_date,
                    'region' => $order_id->region->name, 'number_of_people' => $request->number_of_people, 'role' => 'guide',
                ]));
                return to_route('request_orders.show', $order_id->guide_id)->with('msg', 'Trip has actived successfully');
            case 'Rejected':
                Mail::to($order_id->tourist->email)->send(new OrderRejectMail([
                    'id' => $order_id->id, 'name' => $order_id->tourist->name, 'start_date' => $request->start_date, 'end_date' => $request->end_date,
                    'region' => $order_id->region->name, 'number_of_people' => $request->number_of_people, 'role' => 'tourist',
                ]));
                Mail::to($order_id->guide->email)->send(new OrderRejectMail([
                    'id' => $order_id->id, 'name' => $order_id->tourist->name, 'start_date' => $request->start_date, 'end_date' => $request->end_date,
                    'region' => $order_id->region->name, 'number_of_people' => $request->number_of_people, 'role' => 'guide',
                ]));
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
