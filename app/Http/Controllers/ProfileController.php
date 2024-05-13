<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Profile;
use App\Models\Region;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $profile = Profile::where('user_id', '=', Auth::user()->id)->first();
        $tickets = Ticket::where('user_id', '=', Auth::user()->id)->paginate(4);
        $orders = Order::where('tourist_id', '=', Auth::user()->id)->orWhere('guide_id', '=', Auth::user()->id)->paginate(4);
        return view('profiles.index', ['profile' => $profile, 'tickets' => $tickets, 'orders' => $orders]);
    }


    // public function create()
    // {
    //     return view('profiles.create');
    // }


    // public function store(Request $request)
    // {
    //     $user = User::findOrFail(Auth::user()->id);

    //     $request->validate([
    //         'photo' => ['nullable', 'mimes:png,jpeg'],
    //         'phone_number' => ['nullable', 'string', 'max:10', 'min:10', 'unique:profiles'],
    //         'age' => ['nullable', 'Integer', 'max:99', 'min:18'],
    //         'gender' => ['nullable', 'in:Male,Female'],
    //         'nationality' => ['nullable', 'String'],
    //         'language' => ['nullable', 'String'],
    //     ]);

    //     $update_photo = null;

    //     if ($request->has('photo')) {
    //         $file = $request->file('photo');
    //         $extension = $file->getClientOriginalExtension();

    //         $file_name = $request->name . time() . '.' . $extension;

    //         $path = 'images/profiles/';
    //         $file->move($path, $file_name);

    //         if (File::exists($user->profile->photo)) {
    //             File::delete($user->profile->photo);
    //         }
    //         $update_photo = $path . $file_name;
    //     }

    //     Profile::create([
    //         'user_id' => $user->id,
    //         'photo' => $update_photo ? $update_photo : null,
    //         'phone_number' => $request->phone_number,
    //         'age' => $request->age,
    //         'gender' => $request->gender,
    //         'nationality' => $request->nationality,
    //         'language' => $request->language,
    //     ]);

    //     return to_route('profiles.index', $user->id)->with('msg', 'Profile has updated successfully');
    // }

    public function edit()
    {
        $profile = Profile::where('user_id', '=', Auth::user()->id)->first();
        $regions = Region::where('is_active', true)->get();
        return view('profiles.edit', ['profile' => $profile, 'regions' => $regions]);
    }


    public function update(Request $request)
    {
        $profile = Profile::where('user_id', '=', Auth::user()->id)->first();

        $request->validate([
            'region_id' => ['required', 'exists:regions,id'],
            'name' => ['required', 'string', 'max:255'],
            'photo' => ['nullable', 'mimes:png,jpeg,jpg,webp'],
            'certificate' => ['nullable', 'mimes:pdf'],
            'phone_number' => ['required', 'numeric', 'digits:9', 'regex:/^5[1-9]\d*$/', 'unique:profiles,phone_number,' . Auth::user()->id . ',user_id'],
            'age' => ['required', 'Integer', 'max:99', 'min:18'],
            'gender' => ['required', 'in:Male,Female'],
            'nationality' => ['required', 'String'],
            'language' => ['required', 'String'],
            'overview' => ['nullable', 'String', 'min:10', 'max:255'],
        ]);

        $update_photo = null;

        if ($request->has('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();

            $file_name = $request->name . time() . '.' . $extension;

            $path = 'images/profiles/';
            $file->move($path, $file_name);

            if (File::exists($profile->photo)) {
                File::delete($profile->photo);
            }
            $update_photo = $path . $file_name;
        }

        $update_certificate = null;

        if ($request->has('certificate')) {
            $file = $request->file('certificate');
            $extension = $file->getClientOriginalExtension();

            $file_name = $request->name . time() . '.' . $extension;

            $path = 'files/guides_certificates/';
            $file->move($path, $file_name);

            if (File::exists($profile->photo)) {
                File::delete($profile->photo);
            }
            $update_certificate = $path . $file_name;
        }

        $profile->update([
            'region_id' => $request->region_id ?? null,
            'photo' => $update_photo ?? $profile->photo,
            'certificate' => $update_certificate ?? $profile->certificate,
            'phone_number' => $request->phone_number,
            'age' => $request->age,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'language' => $request->language,
            'overview' => $request->overview,
        ]);

        $profile->user->update([
            'name' => $request->name,
        ]);

        return to_route('profiles.index', Auth::user()->id)->with('msg', 'Profile has updated successfully');
    }
}
