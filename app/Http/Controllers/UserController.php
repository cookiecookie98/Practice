<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $request->validate();


    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:8|max:32',
        ]);

        $credentials = $request->only('email', 'password');

        if(!Auth::attempt($credentials)){
            return response()->json(['message' => 'Unauthorized'],401);
        }

        $user = User::where('email', $request->email)->first();

        $accessToken = $user->createToken('api_token')->plainTextToken;
        $type = 'bearer';

        return response()->json([
            'accessToken' => $accessToken,
            'type' => $type
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->user()->currentAccessToken()->delete();
        return response()->json('Logout successfully');
    }

    public function getUserFromToken()
    {
        $user = Auth::user();
            return response()->json([
                'name' => $user->name,
                'email' => $user->email
            ]);
    }
}
