<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(String $user_id)
    {
        $profile = Profile::where('user_id', '=', $user_id)->first();
        $profileKeys = Profile::where('user_id', '=', $user_id)->select(['phone_number', 'age', 'gender', 'nationality', 'language'])->first();
        $keys = $profileKeys ? array_keys($profileKeys->toArray()) : ['phone_number', 'age', 'gender', 'nationality', 'language'];
        return view('profiles.index', ['profile' => $profile, 'keys' => $keys]);
    }


    public function create()
    {
        return view('profiles.create');
    }


    public function store(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        $request->validate([
            'photo' => ['nullable', 'mimes:png,jpeg'],
            'phone_number' => ['nullable', 'string', 'max:10', 'min:10', 'unique:profiles'],
            'age' => ['nullable', 'Integer', 'max:99', 'min:18'],
            'gender' => ['nullable', 'in:Male,Female'],
            'nationality' => ['nullable', 'String'],
            'language' => ['nullable', 'String'],
        ]);

        $update_photo = null;

        if ($request->has('photo')) {
            $file = $request->file('photo');
            $extension = $file->getClientOriginalExtension();

            $file_name = $request->name . time() . '.' . $extension;

            $path = 'images/profiles/';
            $file->move($path, $file_name);

            if (File::exists($user->profile->photo)) {
                File::delete($user->profile->photo);
            }
            $update_photo = $path . $file_name;
        }

        Profile::create([
            'user_id' => $user->id,
            'photo' => $update_photo ? $update_photo : null,
            'phone_number' => $request->phone_number,
            'age' => $request->age,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'language' => $request->language,
        ]);

        return to_route('profiles.index', $user->id)->with('msg', 'Profile has updated successfully');
    }

    public function edit(String $user_id)
    {
        $profile = Profile::where('user_id','=', $user_id)->first();
        return view('profiles.edit', ['profile' => $profile, 'user_id' => $user_id]);
    }


    public function update(Request $request,String $user_id)
    {
        $profile = Profile::where('user_id','=',$user_id)->first();

        $request->validate([
            'photo' => ['nullable', 'mimes:png,jpeg'],
            'phone_number' => ['nullable', 'string', 'max:10', 'min:10',],
            'age' => ['nullable', 'Integer', 'max:99', 'min:18'],
            'gender' => ['nullable', 'in:Male,Female'],
            'nationality' => ['nullable', 'String'],
            'language' => ['nullable', 'String'],
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

        $profile->update([
            'photo' => $update_photo ? $update_photo : $profile->photo,
            'phone_number' => $request->phone_number,
            'age' => $request->age,
            'gender' => $request->gender,
            'nationality' => $request->nationality,
            'language' => $request->language,
        ]);

        return to_route('profiles.index', $profile->user_id)->with('msg', 'Profile has updated successfully');
    }
}
