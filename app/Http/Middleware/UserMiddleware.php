<?php

namespace App\Http\Middleware;

use app\Models\User;
use app\Models\Role;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $currentUser = Auth::user();

        if ($currentUser) {
            $userinfo = User::with('role')->where('id', $currentUser->id)->first();
            // $userinfo = User::leftJoin('roles', 'roles.user_id', '=', 'users.id')
            //     ->where('users.id', $currentUser->id)
            //     ->first(['users.*', 'roles.*']);

            if ($userinfo->role->title == 'customer') {
                return $next($request);
            } 
            elseif ($userinfo->role->title == 'customerplus') {
                    return $next($request);
            } 
            else {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('login');
                // return response()->json(['error' => 'Unauthorized'], 403);
            }
        }

        return redirect()->route('login');
    }

}
