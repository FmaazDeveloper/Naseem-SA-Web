<?php

namespace App\Http\Controllers;

use App\Models\ContactReasons;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class TicketController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $tickets = Ticket::paginate(10);
        return view('admins.tickets.index', ['tickets' => $tickets]);
    }


    public function create()
    {
        $user = User::find(Auth::user()->id);
        $contact_reasons = ContactReasons::all();
        return view('tickets.create', ['user' => $user, 'contact_reasons' => $contact_reasons]);
    }


    public function store(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $request->validate([
            'user_id' => ['exists:users,id'],
            'contact_reason_id' => ['required', 'exists:contact_reasons,id'],
            'status_id' => ['required', 'exists:status_types,id'],
            'title' => ['required', 'string', 'min:3', 'max:50'],
            'message' => ['required', 'string', 'min:10', 'max:255'],
            'file' => ['nullable', 'mimes:png,jpeg,pdf'],
        ]);

        $add_file = null;

        if ($request->has('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();

            $file_name = $user->name . time() . '.' . $extension;

            $path = 'files/tickets/';
            $file->move($path, $file_name);

            $add_file = $path . $file_name;
        }

        Ticket::create([
            'user_id' => $user->id,
            'contact_reason_id' => $request->contact_reason_id,
            'status_id' => $request->status_id,
            'title' => $request->title,
            'message' => $request->message,
            'file' => $add_file ? $add_file : null,
        ]);

        return to_route('tickets.create')->with('msg', 'Ticket has sent successfully');
    }


    public function show(Ticket $ticket)
    {
        //
    }



    public function edit(Ticket $ticket)
    {
        return view('admins.tickets.edit', ['ticket' => $ticket]);
    }



    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'admin_id' => ['exists:users,id'],
            'answer' => ['required', 'string', 'min:3', 'max:255'],
        ]);

        $ticket->update([
            'admin_id' => Auth::user()->id,
            'answer' => $request->answer,
            'status_id' =>  2,
        ]);

        return to_route('tickets.index')->with('msg', 'Ticket has updated successfully');
    }



    public function destroy(String $ticket)
    {
        $ticket = Ticket::findOrFail($ticket);
        if (File::exists($ticket->file)) {
            File::delete($ticket->file);
        }
        $ticket->delete();
        return to_route('tickets.index')->with('msg', 'Ticket has deleted successfully');
    }
}
