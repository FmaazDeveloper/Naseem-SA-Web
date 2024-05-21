<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\Welcome\WelcomeGuideMail;
use App\Mail\Welcome\WelcomeTouristMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'exists:roles,name'],
            'is_active' => ['in:1,0'],
        ]);

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

        $token = $user->createToken('auth_token')->plainTextToken;

        if ($user->role == 'tourist') {
            Mail::to($user->email)->send(new WelcomeTouristMail(['name' => $request->name]));
        } elseif ($user->role == 'guide') {
            Mail::to($user->email)->send(new WelcomeGuideMail(['name' => $request->name]));
        }
        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }
    public function login(Request $request)
    {

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user = User::where('email', '=', $request->email)->first();


        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Unauthorized'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
