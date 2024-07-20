<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use Auth;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function CartPop()
    {
        $userID = Auth::id();

        $cart = Cart::where('user_id', $userID)->first();
        $cartID = $cart->id;


    }
}
