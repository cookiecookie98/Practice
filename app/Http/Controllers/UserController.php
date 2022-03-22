<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => Str::random(80),
            'role_id' => 1
        ]);

        $token = $user->createToken(Str::random(80))->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response,201);
    }

    public function login(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        $credentials = $request->only('email', 'password');

        if(!Auth::attempt($credentials)){
            return response()->json(['message' => 'Unauthorized']);
        }

        return response()->json([
            'access_token' => $user->createToken('api_token')->plainTextToken,
            'type' => 'bearer',
        ]);
    }

    public function logout(Request $request)
    {
        // $request->user()->currentAccessToken()->delete();
        // return "Logout success";
        return Auth::user();
    }

    public function getUserFromToken()
    {
            // $user = Auth::user();
            // return response()->json([
            //     'name' => $user->name,
            //     'email' => $user->email
            // ]);
        return Auth::user();
    }
}
