<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

use Barryvdh\Debugbar\Facade as Debugbar;

class LoginController extends Controller
{
    public function index(){
        return view('home.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::check()) {
            $user = Auth::user();
            $user->tokens()->delete(); 
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $user->tokens()->delete();
            $token = $user->createToken('auth_token')->plainTextToken;

            $isAdmin = $user->role && $user->role->title === 'admin';

            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'auth_token' => $token,
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

        $user->tokens()->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logout successful']);
    }

}
