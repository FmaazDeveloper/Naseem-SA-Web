<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Welcome\WelcomeGuideMail;
use App\Mail\Welcome\WelcomeTouristMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'exists:roles,name'],
            'is_active' => ['in:1,0'],
        ]);
        try {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'is_active' => $request->role == 'tourist' ? 1 : 0,
            ]);

            $user->profile()->create([
                'user_id' => $user->id,
            ]);

            $user->assignRole($request->role);
            $user->givePermissionTo($user->getPermissionsViaRoles());

            if ($user->role == 'tourist') {
                Mail::to($user->email)->send(new WelcomeTouristMail(['name' => $request->name]));
            } elseif ($user->role == 'guide') {
                Mail::to($user->email)->send(new WelcomeGuideMail(['name' => $request->name]));
            }
            Auth::login($user);
            return to_route('contents.index')->with('msg', 'User has created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('msg', 'User not registered!\nError:' . $e->getMessage());
        }
    }
}
