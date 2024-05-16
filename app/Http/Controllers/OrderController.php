<?php

namespace App\Http\Controllers;

use App\Mail\Order\OrderUserMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::paginate(10);
        return view('admins.orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('admins.orders.edit', ['order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'in:Actived,Pending,Completed,Canceled,Rejected'],
            'number_of_people' => ['required', 'numeric', 'min:1'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        $order->update([
            'admin_id' => Auth::user()->id,
            'status' => $request->status,
            'number_of_people' => $request->number_of_people,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        Mail::to($order->tourist->email)->send(new OrderUserMail([
            'id' => $order->id, 'name' => $order->tourist->name, 'start_date' => $request->start_date, 'end_date' => $request->end_date,
            'region' => $order->region->name, 'number_of_people' => $request->number_of_people, 'status' => $request->status,
            'tourist_name' => $order->tourist->name, 'guide_name' => $order->guide->name,
        ]));
        Mail::to($order->guide->email)->send(new OrderUserMail([
            'id' => $order->id, 'name' => $order->tourist->name, 'start_date' => $request->start_date, 'end_date' => $request->end_date,
            'region' => $order->region->name, 'number_of_people' => $request->number_of_people, 'status' => $request->status,
            'guide_name' => $order->guide->name, 'tourist_name' => $order->tourist->name,
        ]));
        return to_route('orders.index')->with('msg', 'Order has updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
