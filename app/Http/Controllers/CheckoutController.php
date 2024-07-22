<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Cart;
use App\Models\Promo;
use App\Models\Jewelry;
use App\Models\Courier;
use App\Models\Payment;
class CheckoutController extends Controller
{
    public function CheckPop()
    {

        $user = Auth::user();
        $userId = $user->id;
        $userName = $user->fname . " " . $user->lname;
        $userAddress = $user->address;

        $courier = Courier::all();
        $paymentser = Payment::all();

        $Usercart = Cart::where('user_id', $userId)->first();
        if (!$Usercart)
        {
            return response()->json(['success' => false, 'message' => 'No cart found for user'], 404);
        }

        // Retrieve the color_jewelry records along with pivot data
        $colorJewelries = $Usercart->colorJewelry()->with(['jewelry.classification', 'colors', 'jewelry.prices'])->get();
        // return response()->json(['success' => true, 'data' => $colorJewelries]);
        $data = [];
        $subtot = 0;
        $totalDiscount = 0;
        foreach ($colorJewelries as $colorJewelry)
        {
            $jewelryname = $colorJewelry->jewelry->name;
            $color = $colorJewelry->colors->color;
            $classification = $colorJewelry->jewelry->classification->classification;
            $quan = $colorJewelry->pivot->quantity;
            $price = $colorJewelry->jewelry->prices->price;
            $id = $colorJewelry->id;

            $jewelryID = $colorJewelry->jewelry->id;
            $jewelry = Jewelry::with('promos')->find($jewelryID)->first();

            if ($jewelry && $jewelry->promos->isNotEmpty())
            {
                $promo = $jewelry->promos->first();
                $rate = $promo->discountRate ?? 0;
            }
            else
            {
                $rate = 0;

            }

            $discound = $rate * $price;
            $totalDiscount += $discound;

            $subtot = $quan * $price;
                $data[] = [
                    'quantity' => $quan,
                    'jewelry' => $jewelryname,
                    'color' => $color,
                    'classification' => $classification,
                    'price' => $subtot,
                    'pivotId' => $id,
                ];

        }
        $userinfo = [
            'name'=> $userName,
            'address'=> $userAddress,
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
            'user' => $userinfo,
            'totalDc' => $totalDiscount,
            'cour'=> $courier,
            'pay' => $paymentser,
        ]);
    }

}
