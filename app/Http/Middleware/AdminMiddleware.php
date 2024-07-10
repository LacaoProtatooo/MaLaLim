<?php

namespace App\Http\Middleware;

use app\Models\User;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

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
            }
            else
            {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        }

        return redirect()->route('home.login');
    }
}
