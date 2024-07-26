<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Jewelry;
use App\Models\Promo;

use Illuminate\Http\Request;



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
}
