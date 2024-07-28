<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class LoginController extends Controller
{
    public function index(){
        return view('home.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            $request->session()->put('auth_token', $token);

            $isAdmin = $user->role && $user->role->title === 'admin';

            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'token' => $token,
                'isAdmin' => $isAdmin,
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid Credentials'
        ], 401);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'No User Found'], 401);
        }

        // $request->user()->currentAccessToken()->delete();
        $user->tokens()->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logout successful']);
    }

}
