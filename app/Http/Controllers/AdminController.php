<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Jewelry;
use App\Models\Promo;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        $admininfo = auth()->user();

        $usercount = User::count();
        $usercountall = User::withTrashed()->count();
        $soldjewelry = Order::where('status', 'sold')->count();
        $pendingjewelry = Order::where('status', 'pending')->count();
        $jewelrycount = Jewelry::count();
        $promocount = Promo::count();

        return view('admin.home', 
        compact('admininfo','usercount','usercountall',
        'soldjewelry','pendingjewelry','jewelrycount','promocount'));
    }

    public function sidebar(){
        // Ensure the request is authenticated
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $promocount = Promo::count();
        $pendingjewelry = Order::where('status', 'pending')->count();

        return response()->json([
            'promocount' => $promocount,
            'pendingjewelry' => $pendingjewelry,
        ]);
    }
}
