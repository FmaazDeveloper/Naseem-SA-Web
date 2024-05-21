<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\Ticket\TicketRequestMail;
use App\Models\ContactReasons;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $contactReasons = ContactReasons::all();
        return response()->json($contactReasons);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,String $user_email)
    {
        $user = User::where('email',$user_email)->first();
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:50'],
            'message' => ['required', 'string', 'min:10', 'max:255'],
        ]);


        Ticket::create([
            'user_id' => $user->id,
            'contact_reason_id' => $request->contact_reason_id,
            'status' => 'New',
            'title' => $request->title,
            'message' => $request->message,
        ]);

        $add_file = null;
        
        Mail::to($user->email)->send(new TicketRequestMail([
            'name' => $user->name, 'email' => $user->email, 'contact_reason' => $user->ticket->contact_reason->name,
            'title' => $request->title, 'message' => $request->message, 'ticket_file' => $add_file
        ]));
        return response()->json(['Success send',200]);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
