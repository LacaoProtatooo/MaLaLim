<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentUser = Auth::user();

        if ($currentUser) {
            $userinfo = User::with('role')->where('id', $currentUser->id)->first();

            if (in_array($userinfo->role->title, ['customer', 'customerplus'])) {
                return $next($request);
            } else {
                // Invalidate the current token
                // $token = $request->bearerToken();
                // if ($token) {
                //     $sanctumToken = PersonalAccessToken::findToken($token);
                //     if ($sanctumToken) {
                //         $sanctumToken->delete();
                //     }
                // }

                // Optional: Log out user and invalidate session
                // Auth::logout();
                // $request->session()->invalidate();
                // $request->session()->regenerateToken();

                return redirect()->back()->with('error', 'User not Authorized');
            }
        }

        return redirect()->route('login');
    }
}
