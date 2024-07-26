<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AdminMiddleware
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
            if ($userinfo->role->title == 'admin') {
                return $next($request);
            } else {
                $token = $request->bearerToken();
                if ($token) {
                    $sanctumToken = PersonalAccessToken::findToken($token);
                    if ($sanctumToken) {
                        $sanctumToken->delete();
                    }
                }

                // Auth::logout();
                // $request->session()->invalidate();
                // $request->session()->regenerateToken();

                // return redirect()->route('login');
                return redirect()->back()->with('error','User not Authorized');
            }
        }

        return redirect()->route('login');
    }
}
